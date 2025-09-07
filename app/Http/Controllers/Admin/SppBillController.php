<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SppBill;
use App\Models\Student;
use App\Exports\SppBillsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SppBillController extends Controller
{
    public function index(Request $request)
    {
        $query = SppBill::with('student');

        // Filter bulan
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        // Filter tahun
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $bills = $query->orderBy('year', 'desc')
            ->orderBy('month', 'asc')
            ->paginate(15);

        // Ambil daftar tahun & bulan unik buat dropdown filter
        $years = SppBill::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $months = SppBill::select('month')->distinct()->orderBy('month', 'asc')->pluck('month');

        return view('admin.spp-bills.index', compact('bills', 'years', 'months'));
    }


    public function create()
    {
        $classes = Student::select('class')->distinct()->orderBy('class')->get()->pluck('class');
        return view('admin.spp-bills.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|string',
            'year' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        // Check if bill already exists
        $existingBill = SppBill::where('student_id', $request->student_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->first();

        if ($existingBill) {
            return back()->withErrors(['month' => 'Tagihan untuk bulan dan tahun ini sudah ada.']);
        }

        SppBill::create($request->all());

        return redirect()->route('admin.spp-bills.index')
            ->with('success', 'Tagihan SPP berhasil dibuat.');
    }

    public function show(SppBill $sppBill)
    {
        $sppBill->load('student', 'payment');
        return view('admin.spp-bills.show', compact('sppBill'));
    }

    public function edit(SppBill $sppBill)
    {
        $students = Student::all();
        return view('admin.spp-bills.edit', compact('sppBill', 'students'));
    }

    public function update(Request $request, SppBill $sppBill)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|string',
            'year' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:unpaid,paid,pending',
        ]);

        // Check if bill already exists (except current)
        $existingBill = SppBill::where('student_id', $request->student_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->where('id', '!=', $sppBill->id)
            ->first();

        if ($existingBill) {
            return back()->withErrors(['month' => 'Tagihan untuk bulan dan tahun ini sudah ada.']);
        }

        $sppBill->update($request->all());

        return redirect()->route('admin.spp-bills.index')
            ->with('success', 'Tagihan SPP berhasil diupdate.');
    }

    public function destroy(SppBill $sppBill)
    {
        if ($sppBill->status === 'paid') {
            return back()->withErrors(['error' => 'Tidak dapat menghapus tagihan yang sudah dibayar.']);
        }

        $sppBill->delete();

        return redirect()->route('admin.spp-bills.index')
            ->with('success', 'Tagihan SPP berhasil dihapus.');
    }
    public function getStudentsByClass(Request $request)
    {
        $request->validate(['class' => 'required|string']);
        $students = Student::where('class', $request->class)->get(['id', 'name', 'nis']);
        return response()->json($students);
    }

    public function bulkExport(Request $request)
    {
        $request->validate([
            'bill_ids' => 'required|array',
            'bill_ids.*' => 'exists:spp_bills,id'
        ]);

        $bills = SppBill::with('student')->whereIn('id', $request->bill_ids)->get();

        // Use unified export class for both "selected" and "all" exports
        $export = new SppBillsExport($bills);

        return Excel::download($export, 'tagihan-spp-terpilih-' . date('Y-m-d') . '.xlsx');
    }
}
