<?php

namespace App\Console\Commands;

use App\Models\SppBill;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateMonthlySppBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Usage examples:
     *  - php artisan spp:generate-bills
     *  - php artisan spp:generate-bills --month=9 --year=2025
     *  - php artisan spp:generate-bills --month=September --year=2025 --class="XII IPA 1"
     *  - php artisan spp:generate-bills --student=5
     *  - php artisan spp:generate-bills --force
     */
    protected $signature = 'spp:generate-bills
                            {--month= : Target month (1-12, or month name e.g. September/Januari)}
                            {--year= : Target year (e.g. 2025)}
                            {--class= : Only for specific class name}
                            {--student= : Only for specific student ID}
                            {--force : Update non-paid existing bill amount/due_date if present}';

    /**
     * The console command description.
     */
    protected $description = 'Generate SPP bills automatically for students (idempotent).';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $now = Carbon::now();

        $monthOpt = $this->option('month');
        $year     = (int)($this->option('year') ?: $now->year);
        $monthNum = $monthOpt ? $this->parseMonthToNumber($monthOpt) : $now->month;

        if ($monthNum < 1 || $monthNum > 12) {
            $this->error('Invalid --month provided. Use 1-12 or month name (e.g. 9, September, Januari).');
            return self::FAILURE;
        }

        $monthName = $this->indoMonthName($monthNum);

        $defaultAmount = (float) env('SPP_DEFAULT_AMOUNT', 500000);
        $dueDay        = (int) env('SPP_DUE_DAY', 10);

        // Compute due date (clamp to last day if dueDay overflows)
        $firstOfMonth = Carbon::create($year, $monthNum, 1);
        $lastDay      = $firstOfMonth->copy()->endOfMonth()->day;
        $day          = min(max($dueDay, 1), $lastDay);
        $dueDate      = Carbon::create($year, $monthNum, $day);

        $students = Student::query()
            ->when($this->option('class'), fn($q) => $q->where('class', $this->option('class')))
            ->when($this->option('student'), fn($q) => $q->where('id', $this->option('student')))
            ->get();

        if ($students->isEmpty()) {
            $this->info('No students matched the given filters. Nothing to do.');
            return self::SUCCESS;
        }

        $created = 0;
        $skipped = 0;
        $updated = 0;

        DB::beginTransaction();
        try {
            foreach ($students as $student) {
                $existing = SppBill::where('student_id', $student->id)
                    ->where('month', $monthName)
                    ->where('year', (string) $year)
                    ->first();

                if ($existing) {
                    if ($this->option('force') && $existing->status !== 'paid') {
                        $existing->update([
                            'amount'   => $existing->amount ?: $defaultAmount,
                            'due_date' => $existing->due_date ?: $dueDate->toDateString(),
                        ]);
                        $updated++;
                    } else {
                        $skipped++;
                    }
                    continue;
                }

                SppBill::create([
                    'student_id' => $student->id,
                    'month'      => $monthName,
                    'year'       => (string) $year,
                    'amount'     => $defaultAmount,
                    'status'     => 'unpaid',
                    'due_date'   => $dueDate->toDateString(),
                ]);
                $created++;
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error('Error generating bills: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info("SPP bills for {$monthName} {$year} - created: {$created}, skipped: {$skipped}, updated: {$updated}");
        return self::SUCCESS;
    }

    /**
     * Parse month option into 1-12.
     */
    protected function parseMonthToNumber($val): int
    {
        if (is_numeric($val)) {
            return (int) $val;
        }

        $valLower = mb_strtolower(trim($val));
        foreach ($this->indoMonthMap() as $num => $name) {
            if ($valLower === mb_strtolower($name)) {
                return $num;
            }
        }

        $eng = [
            1 => 'january',  2 => 'february', 3 => 'march',
            4 => 'april',    5 => 'may',      6 => 'june',
            7 => 'july',     8 => 'august',   9 => 'september',
            10 => 'october', 11 => 'november',12 => 'december',
        ];
        foreach ($eng as $num => $name) {
            if ($valLower === $name) {
                return $num;
            }
        }

        return 0;
    }

    /**
     * Month names in Indonesian consistent with existing data.
     */
    protected function indoMonthMap(): array
    {
        return [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    protected function indoMonthName(int $month): string
    {
        $map = $this->indoMonthMap();
        return $map[$month] ?? Carbon::create(null, $month)->translatedFormat('F');
    }
}
