<?php

namespace App\Http\Controllers;

use App\Models\GymMember;
use App\Models\WorkoutSession;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = GymMember::count();
        $activeMembers = GymMember::where('status', 'active')->count();
        $totalSessions = WorkoutSession::count();
        $totalCalories = WorkoutSession::sum('calories_burned');

        return view('dashboard', compact(
            'totalMembers', 
            'activeMembers', 
            'totalSessions', 
            'totalCalories'
        ));
    }
    public function reports()
    {
        // Statistik Umum
        $totalMembers = GymMember::count();
        $activeMembers = GymMember::where('status', 'active')->count();
        $expiredMembers = GymMember::where('status', 'expired')->count();
        $totalSessions = WorkoutSession::count();
        $totalCalories = WorkoutSession::sum('calories_burned');
        $avgRating = WorkoutSession::avg('rating');

        // Member yang hampir expire (dalam 30 hari)
        $almostExpired = GymMember::where('status', 'active')
            ->where('expire_date', '<=', now()->addDays(30))
            ->orderBy('expire_date')
            ->get();

        // Top 5 Member dengan sesi terbanyak
        $topMembers = GymMember::withCount('workoutSessions')
            ->orderByDesc('workout_sessions_count')
            ->take(5)
            ->get();

        // Statistik per tipe sesi
        $sessionByType = WorkoutSession::selectRaw('session_type, count(*) as total')
            ->groupBy('session_type')
            ->orderByDesc('total')
            ->get();

        return view('reports.index', compact(
            'totalMembers',
            'activeMembers',
            'expiredMembers',
            'totalSessions',
            'totalCalories',
            'avgRating',
            'almostExpired',
            'topMembers',
            'sessionByType'
        ));
    }
}