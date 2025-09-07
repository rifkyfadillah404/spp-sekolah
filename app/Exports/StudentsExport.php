<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StudentsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;

    public function collection()
    {
        return Student::with('user')->get()->map(function ($student) {
            return [
                'NIS'   => $student->nis,
                'Nama'  => $student->user->name ?? '-',
                'Kelas' => $student->class,
                'HP'    => $student->phone,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Kelas',
            'HP',
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

                // Center align numeric-like columns (NIS)
                if ($highestRow > 1) {
                    $sheet->getStyle("A2:A{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("C2:C{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }
            },
        ];
    }
}
