<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Universal dashboard redirect — picks the right dashboard based on role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'medecin' => redirect()->route('medecin.dashboard'),
            default   => redirect()->route('patient.dashboard'),
        };
    })->name('dashboard');

    // Admins only routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        
        Route::resource('doctors', DoctorController::class)->except('show');
        Route::resource('invoices', InvoiceController::class)->except('show');
    });

    // Medecins only routes
    Route::middleware(['role:medecin'])->prefix('medecin')->name('medecin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'medecinDashboard'])->name('dashboard');
    });

    // Patient only routes
    Route::middleware(['role:patient'])->prefix('patient')->name('patient.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'patientDashboard'])->name('dashboard');
        Route::get('/appointments/create', [AppointmentController::class, 'patientCreateAppointment'])->name('appointments.create');
        Route::post('/appointments', [AppointmentController::class, 'patientStoreAppointment'])->name('appointments.store');
        Route::get('/medical-records', [DashboardController::class, 'patientMedicalRecords'])->name('medical_records');
    });

    // Shared routes (admin + medecin)
    Route::middleware(['role:admin,medecin'])->group(function () {
        Route::resource('patients', PatientController::class)->except('show');
        Route::resource('appointments', AppointmentController::class)->except('show');
        Route::resource('medical_records', MedicalRecordController::class)->except('show');
    });
});
