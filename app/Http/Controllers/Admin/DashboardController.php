<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SppBill;
use App\Models\Payment;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'total_unpaid_bills' => SppBill::where('status', 'unpaid')->count(),
            'total_paid_bills' => SppBill::where('status', 'paid')->count(),
            'total_revenue' => SppBill::where('status', 'paid')->sum('amount'),
            'pending_payments' => Payment::where('transaction_status', 'pending')->count(),
        ];

        // Get recent paid bills as "payments"
        $recent_payments = SppBill::with(['student.user'])
            ->where('status', 'paid')
            ->latest('updated_at')
            ->take(5)
            ->get()
            ->map(function ($bill) {
                return (object) [
                    'order_id' => 'SPP-' . $bill->id,
                    'user' => $bill->student->user,
                    'formatted_amount' => 'Rp ' . number_format($bill->amount, 0, ',', '.'),
                    'status_badge' => 'success',
                    'transaction_status' => 'paid',
                    'created_at' => $bill->updated_at,
                ];
            });

        $overdue_bills = SppBill::with('student')
            ->where('status', 'unpaid')
            ->where('due_date', '<', now())
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_payments', 'overdue_bills'));
    }
}
