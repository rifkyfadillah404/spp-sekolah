<?php

namespace App\Exports;

use App\Models\SppBill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SppBillsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SppBill::with('student.user')->get()->map(function ($bill) {
            return [
                'Nama Siswa' => $bill->student->user->name ?? '-',
                'Bulan'      => $bill->month,
                'Tahun'      => $bill->year,
                'Jumlah'     => $bill->amount,
                'Status'     => $bill->status === 'paid' ? 'Lunas' : 'Tidak Lunas',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Bulan',
            'Tahun',
            'Jumlah',
            'Status',
        ];
    }
}
