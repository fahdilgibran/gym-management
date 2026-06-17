<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GymMemberController;
use App\Http\Controllers\WorkoutSessionController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// === GYM MEMBER ROUTES ===
Route::get('/members', [GymMemberController::class, 'index'])->name('members.index');
Route::get('/members/create', [GymMemberController::class, 'create'])->name('members.create');
Route::post('/members', [GymMemberController::class, 'store'])->name('members.store');
Route::get('/members/{member}', [GymMemberController::class, 'show'])->name('members.show');

// === WORKOUT SESSION ROUTES ===
Route::get('/sessions', [WorkoutSessionController::class, 'index'])->name('sessions.index');
Route::get('/sessions/create', [WorkoutSessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions', [WorkoutSessionController::class, 'store'])->name('sessions.store');