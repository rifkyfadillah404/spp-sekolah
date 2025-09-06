<?php

namespace App\Exports;

use App\Models\SppBill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SppBillsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;
    protected $month;
    protected $year;

    public function __construct($status = null, $month = null, $year = null)
    {
        $this->status = $status;
        $this->month  = $month;
        $this->year   = $year;
    }

    public function collection()
    {
        $query = SppBill::with('student.user'); 
        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->month) {
            $query->where('month', $this->month);
        }

        if ($this->year) {
            $query->where('year', $this->year);
        }

        return $query->get();
    }

    public function map($bill): array
    {
        return [
            $bill->id,
            $bill->student->user->name ?? '-',  
            $bill->month,
            $bill->year,
            number_format($bill->amount, 0, ',', '.'), 
            $bill->status === 'paid' ? 'Lunas' : 'Tidak Lunas',
            $bill->due_date ? \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d F Y') : '-', 
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Siswa',
            'Bulan',
            'Tahun',
            'Jumlah',
            'Status',
            'Jatuh Tempo',
        ];
    }
}
