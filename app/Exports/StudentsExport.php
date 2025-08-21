<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
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
}
