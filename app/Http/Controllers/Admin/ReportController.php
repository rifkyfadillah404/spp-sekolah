<?php

namespace App\Http\Controllers\Admin;
use App\Models\SppBill;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\SppBillsExport;
use App\Exports\StudentsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    public function sppPdf(Request $request)
    {
        $query = SppBill::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->month) {
            $query->where('month', $request->month);
        }

        if ($request->year) {
            $query->where('year', $request->year);
        }

        $bills = $query->get();

        $pdf = PDF::loadView('admin.reports.spp-pdf', compact('bills'));
        return $pdf->download('laporan_spp.pdf');
    }

    public function sppExcel(Request $request)
    {
        return Excel::download(new SppBillsExport(
            $request->status,
            $request->month,
            $request->year
        ), 'laporan_spp.xlsx');
    }
    public function exportStudentsPdf(Request $request)
    {
        $query = Student::with('user');

        if ($request->has('class') && $request->class != '') {
            $query->where('class', $request->class);
        }

        $students = $query->get();

        $pdf = PDF::loadView('admin.reports.students-pdf', compact('students'));
        return $pdf->download('laporan-siswa.pdf');
    }

    public function exportStudentsExcel(Request $request)
    {
        $class = $request->get('class');
        return Excel::download(new StudentsExport($class), 'laporan_siswa.xlsx');
    }


}
