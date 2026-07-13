<?php

namespace App\Http\Controllers;

use App\Models\GymMember;
use App\Models\User;
use App\Models\WorkoutSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = GymMember::count();
        $activeMembers = GymMember::where('status', 'active')->count();
        $totalSessions = WorkoutSession::count();
        $totalCalories = WorkoutSession::sum('calories_burned');

        $almostExpired = GymMember::where('status', 'active')
            ->where('expire_date', '<=', now()->addDays(30))
            ->orderBy('expire_date')
            ->get();

        $topMembers = GymMember::withCount('workoutSessions')
            ->orderByDesc('workout_sessions_count')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMembers', 
            'activeMembers', 
            'totalSessions', 
            'totalCalories',
            'almostExpired',
            'topMembers'
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
        $user = Auth::user();
        $member = $this->ensureGymMember($user);

        $totalSessions = $member->workoutSessions()->count();
        $totalCalories = $member->workoutSessions()->sum('calories_burned');
        $latestMeasurements = $member->bodyMeasurements()->latest()->take(5)->get();
        $latestNutrition = $member->nutritionLogs()->latest()->take(5)->get();

        return view('member.dashboard', compact(
            'member',
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
        $this->ensureGymMember($user);

        return view('member.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:M,F',
            'birth_date' => 'nullable|date',
            'membership_type' => 'nullable|in:monthly,quarterly,annual',
            'start_date' => 'nullable|date',
            'expire_date' => 'nullable|date|after_or_equal:start_date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

    $data = $request->only('name', 'email', 'phone');

    $userColumns = ['gender', 'birth_date', 'membership_type', 'start_date', 'expire_date'];
    foreach ($userColumns as $column) {
        if ($request->has($column)) {
            $data[$column] = $request->input($column);
        }
    }

    // Upload Foto
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $filename = time() . '_' . Str::slug(pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $photo->getClientOriginalExtension();

        Storage::disk('public')->makeDirectory('profile');
        $path = $photo->storeAs('profile', $filename, 'public');

        if ($path) {
            $data['photo'] = $path;

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
        }
    }

    try {
        $user->update($data);
    } catch (\Illuminate\Database\QueryException $e) {
        if (str_contains($e->getMessage(), 'Unknown column')) {
            return back()->withErrors([
                'database' => 'Kolom profil belum ada di tabel users. Jalankan php artisan migrate terlebih dahulu.'
            ])->withInput();
        }

        throw $e;
    }

    $member = $user->gymMember;

    if (!$member) {
        $member = GymMember::where('email', $user->email)
            ->orWhere('user_id', $user->id)
            ->first();
    }

    if (!$member) {
        $member = GymMember::create([
            'user_id' => $user->id,
            'member_code' => 'MEM-' . strtoupper(substr(uniqid(), -6)),
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'birth_date' => $user->birth_date,
            'membership_type' => $user->membership_type ?? 'monthly',
            'start_date' => $user->start_date ?? now()->toDateString(),
            'expire_date' => $user->expire_date ?? now()->addMonths(3)->toDateString(),
            'status' => 'active',
        ]);
    } else {
        $member->update([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'birth_date' => $user->birth_date,
            'membership_type' => $user->membership_type ?? 'monthly',
            'start_date' => $user->start_date ?? $member->start_date,
            'expire_date' => $user->expire_date ?? $member->expire_date,
        ]);
    }

    return redirect()->route('profile')
                     ->with('success', 'Profil berhasil diperbarui!');
}

    private function ensureGymMember(User $user): GymMember
    {
        $member = $user->gymMember;

        if ($member) {
            return $member;
        }

        $member = GymMember::where('email', $user->email)
            ->orWhere('user_id', $user->id)
            ->first();

        if ($member) {
            if (!$member->user_id) {
                $member->update(['user_id' => $user->id]);
            }

            return $member;
        }

        return GymMember::create([
            'user_id' => $user->id,
            'member_code' => 'MEM-' . strtoupper(substr(uniqid(), -6)),
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? '',
            'gender' => $user->gender ?? null,
            'birth_date' => $user->birth_date ?? null,
            'membership_type' => $user->membership_type ?? 'monthly',
            'start_date' => $user->start_date ?? now()->toDateString(),
            'expire_date' => $user->expire_date ?? now()->addMonths(3)->toDateString(),
            'status' => 'active',
        ]);
    }
}
