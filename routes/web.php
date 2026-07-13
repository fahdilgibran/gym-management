<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GymMemberController;
use App\Http\Controllers\WorkoutSessionController;
use App\Http\Controllers\BodyMeasurementController;
use App\Http\Controllers\NutritionLogController;
use App\Http\Controllers\AuthController;

// ==================== PUBLIC ROUTES (Landing Page) ====================
Route::get('/', function () {
    return view('welcome');                    // Halaman Welcome / Landing Page
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// ==================== PROTECTED ROUTES ====================
Route::middleware(['auth'])->group(function () {

    // Redirect otomatis berdasarkan role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if ($user->role === 'member') {
            return redirect()->route('my.dashboard');
        }
        
        // Admin & Staff
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    // ==================== ADMIN & STAFF DASHBOARD ====================
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Members
        Route::get('/members', [GymMemberController::class, 'index'])->name('members.index');

        // Hanya Admin
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/members/create', [GymMemberController::class, 'create'])->name('members.create');
            Route::post('/members', [GymMemberController::class, 'store'])->name('members.store');
            Route::get('/members/{member}', [GymMemberController::class, 'show'])->name('members.show');
            Route::get('/members/{member}/edit', [GymMemberController::class, 'edit'])->name('members.edit');
            Route::put('/members/{member}', [GymMemberController::class, 'update'])->name('members.update');
            Route::delete('/members/{member}', [GymMemberController::class, 'destroy'])->name('members.destroy');
            // Konfirmasi Membership
            Route::get('/members/{member}/confirm', [GymMemberController::class, 'confirmMembership'])->name('members.confirm');
        });

        // Admin + Staff
        Route::resource('sessions', WorkoutSessionController::class);
        
        // Body Measurements
        Route::get('/members/{member}/measurements/create', [BodyMeasurementController::class, 'create'])->name('measurements.create');
        Route::post('/members/{member}/measurements', [BodyMeasurementController::class, 'store'])->name('measurements.store');
        Route::get('/members/{member}/measurements', [BodyMeasurementController::class, 'index'])->name('measurements.index');
        Route::get('/measurements/{measurement}/edit', [BodyMeasurementController::class, 'edit'])->name('measurements.edit');
        Route::put('/measurements/{measurement}', [BodyMeasurementController::class, 'update'])->name('measurements.update');
        Route::delete('/measurements/{measurement}', [BodyMeasurementController::class, 'destroy'])->name('measurements.destroy');

        // Nutrition Logs
        Route::get('/members/{member}/nutrition/create', [NutritionLogController::class, 'create'])->name('nutrition.create');
        Route::post('/members/{member}/nutrition', [NutritionLogController::class, 'store'])->name('nutrition.store');
        Route::get('/members/{member}/nutrition', [NutritionLogController::class, 'index'])->name('nutrition.index');
        Route::get('/nutrition/{log}/edit', [NutritionLogController::class, 'edit'])->name('nutrition.edit');
        Route::put('/nutrition/{log}', [NutritionLogController::class, 'update'])->name('nutrition.update');
        Route::delete('/nutrition/{log}', [NutritionLogController::class, 'destroy'])->name('nutrition.destroy');
    });

    // ==================== MEMBER ONLY ====================
    Route::middleware(['role:member'])->group(function () {
        Route::get('/my-dashboard', [DashboardController::class, 'myDashboard'])->name('my.dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'profileUpdate'])->name('profile.update');
    });

    // Laporan (hanya Admin & Staff)
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::get('/reports', [DashboardController::class, 'reports'])->name('reports.index');
    });
});