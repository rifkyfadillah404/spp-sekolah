<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SppBillController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // User routes
    Route::get('/user/dashboard', [PaymentController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/bills', [PaymentController::class, 'userBills'])->name('user.bills');
    Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment/finish', [PaymentController::class, 'paymentFinish'])->name('payment.finish');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/students/by-class', [StudentController::class, 'byClass'])->name('students.by-class');
        Route::post('/students/export', [StudentController::class, 'export'])->name('students.export');
        Route::delete('/students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulk-delete');
        Route::resource('students', StudentController::class);
        Route::get('spp-bills/get-students-by-class', [SppBillController::class, 'getStudentsByClass'])->name('spp-bills.getStudentsByClass');
        Route::post('spp-bills/bulk-export', [SppBillController::class, 'bulkExport'])->name('spp-bills.bulk-export');
        Route::resource('spp-bills', SppBillController::class);
    });
});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/reports/students/pdf', [ReportController::class, 'studentsPdf'])->name('admin.reports.students.pdf');
    Route::get('/reports/students/excel', [ReportController::class, 'studentsExcel'])->name('admin.reports.students.excel');
    Route::get('/reports/spp/pdf', [ReportController::class, 'sppPdf'])->name('admin.reports.spp.pdf');
    Route::get('/reports/spp/excel', [ReportController::class, 'sppExcel'])->name('admin.reports.spp.excel');
});

// Midtrans notification (no auth required)
Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');

require __DIR__ . '/auth.php';
