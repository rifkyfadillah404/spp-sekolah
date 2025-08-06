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

        // Get all bills for the student (both paid and unpaid)
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

        // Create payment record
        $payment = Payment::create([
            'order_id' => $orderId,
            'user_id' => $user->id,
            'amount' => $totalAmount,
            'description' => 'Pembayaran SPP ' . $student->name
        ]);

        // Update SPP bills status to pending
        $sppBills->each(function ($bill) use ($payment) {
            $bill->update([
                'status' => 'pending',
                'payment_id' => $payment->id
            ]);
        });

        // Prepare items for Midtrans
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

        try {
            $snapToken = $this->midtransService->createSnapToken($orderDetails);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $orderId
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;

        $payment = Payment::where('order_id', $orderId)->first();

        if (!$payment) {
            // For demo mode, create a mock payment and mark bills as paid
            $user = auth()->user() ?? User::first(); // Fallback for demo
            $transactionStatus = $request->transaction_status ?? 'settlement';

            $payment = Payment::create([
                'user_id' => $user->id,
                'order_id' => $orderId,
                'amount' => $grossAmount ?? 500000,
                'transaction_status' => $transactionStatus,
                'transaction_id' => 'DEMO-' . time(),
                'payment_type' => $request->payment_type ?? 'demo',
            ]);

            // Mark related bills as paid for demo
            $student = $user->student;
            if ($student && $transactionStatus === 'settlement') {
                $unpaidBills = $student->sppBills()->where('status', 'unpaid')->take(1)->get();
                foreach ($unpaidBills as $bill) {
                    $bill->update(['status' => 'paid']);
                }
            }

            return response()->json(['status' => 'success']);
        }

        try {
            $status = $this->midtransService->getTransactionStatus($orderId);

            $payment->update([
                'transaction_status' => $status->transaction_status,
                'transaction_id' => $status->transaction_id,
                'payment_type' => $status->payment_type,
                'fraud_status' => $status->fraud_status ?? null,
                'transaction_time' => $status->transaction_time,
                'midtrans_response' => $status
            ]);

            // Update SPP bills status based on payment status
            if ($status->transaction_status == 'settlement') {
                $payment->sppBills()->update(['status' => 'paid']);
            } elseif (in_array($status->transaction_status, ['cancel', 'deny', 'expire'])) {
                $payment->sppBills()->update(['status' => 'unpaid', 'payment_id' => null]);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error'], 500);
        }
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
