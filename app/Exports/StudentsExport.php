<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $classFilter;

    public function __construct($classFilter = null)
    {
        $this->classFilter = $classFilter;
    }

    public function collection()
    {
        $query = Student::with('user');

        if ($this->classFilter) {
            $query->where('class', $this->classFilter);
        }

        return $query->get()->map(function ($student) {
            return [
                'NIS' => $student->nis,
                'Nama' => $student->name,
                'Kelas' => $student->class,
                'Email' => $student->user->email ?? '-',
                'Telepon' => $student->phone ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Kelas', 'Email', 'Telepon'];
    }
}
