<?php

namespace App\Exports;

use App\Models\SppBill;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SppBillsExport implements FromCollection, WithHeadings
{
    use Exportable;

    /**
     * Optional pre-fetched bills collection for "selected export".
     * If null, exporter will fetch all bills for "export all".
     *
     * @var \Illuminate\Support\Collection|null
     */
    protected $bills;

    /**
     * @param \Illuminate\Support\Collection|null $bills
     */
    public function __construct($bills = null)
    {
        $this->bills = $bills;
    }

    public function collection()
    {
        $bills = $this->bills ?: SppBill::with('student')->get();

        return $bills->map(function ($bill) {
            return [
                'Nama Siswa'   => $bill->student->name ?? '-',
                'NIS'          => $bill->student->nis ?? '-',
                'Kelas'        => $bill->student->class ?? '-',
                'Bulan'        => $bill->month,
                'Tahun'        => $bill->year,
                'Jumlah'       => 'Rp ' . number_format($bill->amount, 0, ',', '.'),
                'Jatuh Tempo'  => $bill->due_date ? $bill->due_date->format('d/m/Y') : '-',
                'Status'       => $bill->status === 'paid' ? 'Lunas' : ($bill->status === 'pending' ? 'Pending' : 'Belum Bayar'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'NIS',
            'Kelas',
            'Bulan',
            'Tahun',
            'Jumlah',
            'Jatuh Tempo',
            'Status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestColumn = $sheet->getHighestColumn();
                $highestRow = $sheet->getHighestRow();

                // Header styles
                $headerRange = "A1:{$highestColumn}1";
                $sheet->getStyle($headerRange)->getFont()->setBold(true)->setSize(12);
                $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle($headerRange)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('E9EFFD');

                // Borders for all cells
                $tableRange = "A1:{$highestColumn}{$highestRow}";
                $sheet->getStyle($tableRange)->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->getColor()->setRGB('D3D3D3');

                // Freeze header and add autofilter
                $sheet->freezePane('A2');
                $sheet->setAutoFilter($tableRange);

                // Alignment for specific columns
                // A: Nama Siswa, B: NIS, C: Kelas, D: Bulan, E: Tahun, F: Jumlah, G: Jatuh Tempo, H: Status
                if ($highestRow > 1) {
                    $sheet->getStyle("B2:B{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("C2:C{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("E2:E{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("G2:G{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("H2:H{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }
            },
        ];
    }
}
