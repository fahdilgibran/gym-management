<?php

namespace App\Http\Controllers;

use App\Models\WorkoutSession;
use App\Models\GymMember;
use Illuminate\Http\Request;

class WorkoutSessionController extends Controller
{
    public function index()
    {
        $sessions = WorkoutSession::with('member')
                    ->latest('session_date')
                    ->paginate(10);
        
        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        $members = GymMember::where('status', 'active')->get();
        return view('sessions.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:gym_members,id',
            'session_date' => 'required|date',
            'trainer_name' => 'nullable|string',
            'session_type' => 'required|string',
            'duration_minutes' => 'required|integer|min:1',
            'calories_burned' => 'nullable|integer',
            'weight_kg' => 'nullable|numeric',
            'rating' => 'nullable|integer|between:1,5',
        ]);

        WorkoutSession::create($request->all());

        return redirect()->route('sessions.index')
                         ->with('success', 'Sesi latihan berhasil dicatat!');
    }

    public function show(WorkoutSession $session)
    {
        $session->load('member'); // Eager loading
        return view('sessions.show', compact('session'));
    }

    public function edit(WorkoutSession $session)
    {
        $members = GymMember::where('status', 'active')->get();
        return view('sessions.edit', compact('session', 'members'));
    }

    public function update(Request $request, WorkoutSession $session)
    {
        $request->validate([
            'member_id'        => 'required|exists:gym_members,id',
            'session_date'     => 'required|date',
            'trainer_name'     => 'nullable|string',
            'session_type'     => 'required|string',
            'duration_minutes' => 'required|integer|min:1',
            'calories_burned'  => 'nullable|integer',
            'weight_kg'        => 'nullable|numeric',
            'rating'           => 'nullable|integer|between:1,5',
        ]);

        $session->update($request->all());

        return redirect()->route('sessions.index')
                        ->with('success', 'Sesi latihan berhasil diperbarui!');
    }

    public function destroy(WorkoutSession $session)
    {
        $session->delete();
        return redirect()->route('sessions.index')
                        ->with('success', 'Sesi latihan berhasil dihapus!');
    }
}