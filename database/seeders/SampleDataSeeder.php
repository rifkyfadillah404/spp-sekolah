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
    }
}
