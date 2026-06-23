<?php

namespace App\Http\Controllers;

use App\Models\BodyMeasurement;
use App\Models\GymMember;
use Illuminate\Http\Request;

class BodyMeasurementController extends Controller
{
    public function create($member_id)
    {
        $member = GymMember::findOrFail($member_id);
        return view('body_measurements.create', compact('member'));
    }

    public function store(Request $request, $member_id)
    {
        $request->validate([
            'measurement_date' => 'required|date',
            'weight_kg' => 'required|numeric|min:20',
            'body_fat_percentage' => 'nullable|numeric|min:5|max:60',
            'muscle_mass_kg' => 'nullable|numeric',
            'chest_cm' => 'nullable|numeric',
            'waist_cm' => 'nullable|numeric',
            'arm_cm' => 'nullable|numeric',
        ]);

        BodyMeasurement::create([
            'member_id' => $member_id,
            'measurement_date' => $request->measurement_date,
            'weight_kg' => $request->weight_kg,
            'body_fat_percentage' => $request->body_fat_percentage,
            'muscle_mass_kg' => $request->muscle_mass_kg,
            'chest_cm' => $request->chest_cm,
            'waist_cm' => $request->waist_cm,
            'arm_cm' => $request->arm_cm,
            'notes' => $request->notes,
        ]);

        return redirect()->route('members.show', $member_id)
                         ->with('success', 'Pengukuran tubuh berhasil dicatat!');
    }

    public function index($member_id)
    {
        $member = GymMember::findOrFail($member_id);
        $measurements = BodyMeasurement::where('member_id', $member_id)
                        ->latest('measurement_date')
                        ->paginate(10);

        return view('body_measurements.index', compact('member', 'measurements'));
    }
}