<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\SppBill;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample student user
        $studentUser = User::firstOrCreate(
            ['email' => 'student@spp.com'],
            [
                'name' => 'Ahmad Siswa',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $studentUser->assignRole('user');

        // Create student record
        $student = Student::firstOrCreate(
            ['nis' => '2024001'],
            [
                'name' => 'Ahmad Siswa',
                'class' => 'XII IPA 1',
                'phone' => '081234567890',
                'address' => 'Jl. Contoh No. 123, Jakarta',
                'user_id' => $studentUser->id,
            ]
        );

        // Create SPP bills for the student
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        $year = '2024';
        $amount = 500000; // Rp 500,000

        foreach ($months as $index => $month) {
            SppBill::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'month' => $month,
                    'year' => $year
                ],
                [
                    'amount' => $amount,
                    'status' => $index < 2 ? 'paid' : 'unpaid', // First 2 months paid
                    'due_date' => now()->addMonths($index)->endOfMonth(),
                ]
            );
        }

        // Create more sample students with different classes
        $sampleStudents = [
            ['name' => 'Budi Santoso', 'nis' => '2024002', 'class' => 'XII IPA 1', 'email' => 'budi@spp.com'],
            ['name' => 'Siti Nurhaliza', 'nis' => '2024003', 'class' => 'XII IPA 2', 'email' => 'siti@spp.com'],
            ['name' => 'Andi Wijaya', 'nis' => '2024004', 'class' => 'XII IPS 1', 'email' => 'andi@spp.com'],
            ['name' => 'Maya Sari', 'nis' => '2024005', 'class' => 'XII IPS 1', 'email' => 'maya@spp.com'],
            ['name' => 'Rizki Pratama', 'nis' => '2024006', 'class' => 'XI IPA 1', 'email' => 'rizki@spp.com'],
            ['name' => 'Dewi Lestari', 'nis' => '2024007', 'class' => 'XI IPA 2', 'email' => 'dewi@spp.com'],
            ['name' => 'Fajar Nugroho', 'nis' => '2024008', 'class' => 'XI IPS 1', 'email' => 'fajar@spp.com'],
        ];

        foreach ($sampleStudents as $studentData) {
            // Create user
            $user = User::firstOrCreate(
                ['email' => $studentData['email']],
                [
                    'name' => $studentData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole('user');

            // Create student
            $newStudent = Student::firstOrCreate(
                ['nis' => $studentData['nis']],
                [
                    'name' => $studentData['name'],
                    'class' => $studentData['class'],
                    'phone' => '081' . rand(100000000, 999999999),
                    'address' => 'Jl. Sample No. ' . rand(1, 100) . ', Jakarta',
                    'user_id' => $user->id,
                ]
            );

            // Create some SPP bills for each student
            $billMonths = array_slice($months, 0, rand(3, 6)); // Random 3-6 months
            foreach ($billMonths as $index => $month) {
                SppBill::firstOrCreate(
                    [
                        'student_id' => $newStudent->id,
                        'month' => $month,
                        'year' => $year
                    ],
                    [
                        'amount' => $amount,
                        'status' => $index < rand(1, 3) ? 'paid' : 'unpaid', // Random paid status
                        'due_date' => now()->addMonths($index)->endOfMonth(),
                    ]
                );
            }
        }
    }
}
