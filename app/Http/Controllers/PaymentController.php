<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SppBill;
use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function userDashboard()
    {
        $user = auth()->user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your student profile first.');
        }

        $bills = $student->sppBills()->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $unpaidBills = $student->unpaidBills()->orderBy('due_date')->get();
        $recentPayments = Payment::where('user_id', $user->id)->latest()->take(5)->get();

        return view('user.dashboard', compact('student', 'bills', 'unpaidBills', 'recentPayments'));
    }

    public function userBills()
    {
        $user = auth()->user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your student profile first.');
        }

        $bills = $student->sppBills()->orderBy('year', 'desc')->orderBy('month', 'desc')->paginate(10);

        return view('user.bills', compact('bills'));
    }

    public function createPayment(Request $request)
    {
        $request->validate([
            'spp_bill_ids' => 'required|array',
            'spp_bill_ids.*' => 'exists:spp_bills,id'
        ]);

        $user = auth()->user();
        $student = $user->student;

        if (!$student) {
            return response()->json(['error' => 'Student profile not found'], 400);
        }

        $sppBills = SppBill::whereIn('id', $request->spp_bill_ids)
            ->where('student_id', $student->id)
            ->where('status', 'unpaid')
            ->get();

        if ($sppBills->isEmpty()) {
            return response()->json(['error' => 'No unpaid bills found'], 400);
        }

        $totalAmount = $sppBills->sum('amount');
        $orderId = 'SPP-' . time() . '-' . Str::random(5);

        $payment = Payment::create([
            'order_id' => $orderId,
            'user_id' => $user->id,
            'amount' => $totalAmount,
            'description' => 'Pembayaran SPP ' . $student->name
        ]);

        $sppBills->each(function ($bill) use ($payment) {
            $bill->update([
                'status' => 'pending',
                'payment_id' => $payment->id
            ]);
        });

        $items = $sppBills->map(function ($bill) {
            return [
                'id' => $bill->id,
                'price' => $bill->amount,
                'quantity' => 1,
                'name' => "SPP {$bill->month} {$bill->year}"
            ];
        })->toArray();

        $orderDetails = [
            'order_id' => $orderId,
            'amount' => $totalAmount,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $student->phone ?? '',
            'items' => $items
        ];

        $snapToken = $this->midtransService->createSnapToken($orderDetails);

        return response()->json([
            'snap_token' => $snapToken,
            'order_id' => $orderId
        ]);
    }

    public function handleNotification(Request $request)
    {
        // Verify Midtrans signature to ensure authenticity
        $serverKey = config('services.midtrans.server_key');
        $expectedSignature = hash('sha512', ($request->order_id ?? '') . ($request->status_code ?? '') . ($request->gross_amount ?? '') . $serverKey);

        if (!isset($request->signature_key) || $request->signature_key !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = $request->order_id;
        $grossAmount = $request->gross_amount;

        // Payment record must exist (created at /payment/create)
        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Confirm current transaction status from Midtrans
        $statusRaw = $this->midtransService->getTransactionStatus($orderId);
        $status = json_decode(json_encode($statusRaw), true); // normalize to array

        // Extract fields safely
        $transactionStatus = $status['transaction_status'] ?? $request->transaction_status ?? 'pending';
        $paymentType       = $status['payment_type'] ?? $request->payment_type ?? null;
        $fraudStatus       = $status['fraud_status'] ?? null;
        $transactionId     = $status['transaction_id'] ?? null;
        $transactionTime   = $status['transaction_time'] ?? now();

        // Handle credit card "capture" with fraud status
        $isPaid = false;
        if ($transactionStatus === 'settlement') {
            $isPaid = true;
        } elseif ($transactionStatus === 'capture') {
            // For credit card, settlement-like if fraud_status is accept
            $isPaid = ($fraudStatus === 'accept');
        }

        // Update payment row
        $payment->update([
            'amount'             => $payment->amount ?: $grossAmount, // keep original amount if set
            'transaction_status' => $transactionStatus,
            'transaction_id'     => $transactionId,
            'payment_type'       => $paymentType,
            'fraud_status'       => $fraudStatus,
            'transaction_time'   => $transactionTime,
            'midtrans_response'  => $status,
        ]);

        // Sync related bills based on status
        if ($isPaid) {
            $payment->sppBills()->update(['status' => 'paid']);
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire', 'failure'])) {
            $payment->sppBills()->update(['status' => 'unpaid', 'payment_id' => null]);
        } else {
            // keep pending for 'pending' or 'capture' with 'challenge'
            $payment->sppBills()->update(['status' => 'pending']);
        }

        return response()->json(['status' => 'ok']);
    }

    public function paymentFinish(Request $request)
    {
        $orderId = $request->order_id;
        $payment = Payment::where('order_id', $orderId)->first();

        if ($payment) {
            return view('payment.finish', compact('payment'));
        }

        return redirect()->route('user.dashboard')->with('error', 'Payment not found');
    }
}
