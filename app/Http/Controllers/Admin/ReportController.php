<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SppBill;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use App\Exports\SppBillsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function studentsPdf()
    {
        $students = Student::with('user')->get();
        $pdf = Pdf::loadView('admin.reports.students-pdf', compact('students'));
        return $pdf->download('laporan-daftar-siswa.pdf');
    }

    public function studentsExcel()
    {
        return Excel::download(new StudentsExport, 'laporan-daftar-siswa.xlsx');
    }

    public function sppPdf()
    {
        $bills = SppBill::with('student')->get();
        $pdf = Pdf::loadView('admin.reports.spp-pdf', compact('bills'));
        return $pdf->download('laporan-tagihan-spp.pdf');
    }

    public function sppExcel()
    {
        return Excel::download(new SppBillsExport, 'laporan-tagihan-spp.xlsx');
    }
}
