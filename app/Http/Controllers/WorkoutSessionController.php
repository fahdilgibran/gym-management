<?php

namespace App\Http\Controllers;

use App\Models\WorkoutSession;
use App\Models\GymMember;
use Illuminate\Http\Request;

class WorkoutSessionController extends Controller
{
    public function index(Request $request)
    {
        $query = WorkoutSession::with('member');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('member', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('member_code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('session_type')) {
            $query->where('session_type', $request->session_type);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('session_date', [$request->start_date, $request->end_date]);
        }

        $sessions = $query->latest('session_date')->paginate(10)->withQueryString();

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