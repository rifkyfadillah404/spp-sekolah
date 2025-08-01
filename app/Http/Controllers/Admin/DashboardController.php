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
            'total_revenue' => Payment::where('transaction_status', 'settlement')->sum('amount'),
            'pending_payments' => Payment::where('transaction_status', 'pending')->count(),
        ];

        $recent_payments = Payment::with(['user', 'sppBills.student'])
            ->latest()
            ->take(5)
            ->get();

        $overdue_bills = SppBill::with('student')
            ->where('status', 'unpaid')
            ->where('due_date', '<', now())
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_payments', 'overdue_bills'));
    }
}
