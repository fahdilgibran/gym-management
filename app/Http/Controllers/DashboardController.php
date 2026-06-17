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
}