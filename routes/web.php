<?php

use App\Http\Controllers\BodyMeasurementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GymMemberController;
use App\Http\Controllers\WorkoutSessionController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/reports', [DashboardController::class, 'reports'])->name('reports.index');

// === GYM MEMBER ROUTES ===
Route::get('/members', [GymMemberController::class, 'index'])->name('members.index');
Route::get('/members/create', [GymMemberController::class, 'create'])->name('members.create');
Route::post('/members', [GymMemberController::class, 'store'])->name('members.store');
Route::get('/members/{member}', [GymMemberController::class, 'show'])->name('members.show');
Route::get('/members/{member}/edit', [GymMemberController::class, 'edit'])->name('members.edit');
Route::put('/members/{member}', [GymMemberController::class, 'update'])->name('members.update');
Route::delete('/members/{member}', [GymMemberController::class, 'destroy'])->name('members.destroy');

// === WORKOUT SESSION ROUTES ===
Route::get('/sessions', [WorkoutSessionController::class, 'index'])->name('sessions.index');
Route::get('/sessions/create', [WorkoutSessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions', [WorkoutSessionController::class, 'store'])->name('sessions.store');
Route::get('/sessions/{session}', [WorkoutSessionController::class, 'show'])->name('sessions.show');
Route::get('/sessions/{session}/edit', [WorkoutSessionController::class, 'edit'])->name('sessions.edit');
Route::put('/sessions/{session}', [WorkoutSessionController::class, 'update'])->name('sessions.update');
Route::delete('/sessions/{session}', [WorkoutSessionController::class, 'destroy'])->name('sessions.destroy');

// === BODY MEASUREMENT ROUTES ===
Route::get('/members/{member}/measurements', [BodyMeasurementController::class, 'index'])->name('measurements.index');
Route::get('/members/{member}/measurements/create', [BodyMeasurementController::class, 'create'])->name('measurements.create');
Route::post('/members/{member}/measurements', [BodyMeasurementController::class, 'store'])->name('measurements.store');