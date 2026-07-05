<?php

namespace App\Http\Controllers;

use App\Models\GymMember;
use App\Models\User;
use App\Models\WorkoutSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // My Dashboard untuk Member
    public function myDashboard()
    {
        $member = Auth::user()->member; // asumsi relasi nanti
        $totalSessions = $member ? $member->workoutSessions()->count() : 0;
        $totalCalories = $member ? $member->workoutSessions()->sum('calories_burned') : 0;
        $latestMeasurements = $member ? $member->bodyMeasurements()->latest()->take(3)->get() : collect();
        $latestNutrition = $member ? $member->nutritionLogs()->latest()->take(3)->get() : collect();

        return view('member.dashboard', compact(
            'totalSessions', 
            'totalCalories', 
            'latestMeasurements', 
            'latestNutrition'
        ));
    }

    // Profile Member
        public function profile()
    {
        $user = Auth::user();
        return view('member.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();

        return redirect()->route('profile')
                         ->with('success', 'Profil berhasil diperbarui!');
    }
}