<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SppBill;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use App\Exports\SppBillsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{

    public function studentsExcel()
    {
        return Excel::download(new StudentsExport, 'laporan-daftar-siswa.xlsx');
    }

    public function sppExcel()
    {
        // Export all bills using unified exporter
        return Excel::download(new SppBillsExport, 'laporan-tagihan-spp.xlsx');
    }
}
