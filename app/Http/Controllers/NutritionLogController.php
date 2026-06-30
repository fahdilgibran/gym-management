<?php

namespace App\Http\Controllers;

use App\Models\NutritionLog;
use App\Models\GymMember;
use Illuminate\Http\Request;

class NutritionLogController extends Controller
{
    public function create($member_id)
    {
        $member = GymMember::findOrFail($member_id);
        return view('nutrition.create', compact('member'));
    }

    public function store(Request $request, $member_id)
    {
        $request->validate([
            'log_date'           => 'required|date',
            'calories_intake'    => 'nullable|integer|min:0',
            'protein_grams'      => 'nullable|integer|min:0',
            'carbs_grams'        => 'nullable|integer|min:0',
            'fats_grams'         => 'nullable|integer|min:0',
            'meals_description'  => 'nullable|string',
            'notes'              => 'nullable|string',
        ]);

        NutritionLog::create([
            'member_id'          => $member_id,
            'log_date'           => $request->log_date,
            'calories_intake'    => $request->calories_intake,
            'protein_grams'      => $request->protein_grams,
            'carbs_grams'        => $request->carbs_grams,
            'fats_grams'         => $request->fats_grams,
            'meals_description'  => $request->meals_description,
            'notes'              => $request->notes,
        ]);

        return redirect()->route('members.show', $member_id)
                         ->with('success', 'Catatan nutrisi berhasil disimpan!');
    }

    public function index($member_id)
    {
        $member = GymMember::findOrFail($member_id);
        $logs = NutritionLog::where('member_id', $member_id)
                ->latest('log_date')
                ->paginate(10);

        return view('nutrition.index', compact('member', 'logs'));
    }

    public function edit(NutritionLog $log)
    {
        $member = $log->member;
        return view('nutrition.edit', compact('log', 'member'));
    }

    public function update(Request $request, NutritionLog $log)
    {
        $request->validate([
            'log_date' => 'required|date',
            'calories_intake' => 'nullable|integer',
            'protein_grams' => 'nullable|integer',
            'carbs_grams' => 'nullable|integer',
            'fats_grams' => 'nullable|integer',
            'meals_description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $log->update($request->all());

        return redirect()->route('nutrition.index', $log->member_id)
                        ->with('success', 'Catatan nutrisi berhasil diperbarui!');
    }

    public function destroy(NutritionLog $log)
    {
        $member_id = $log->member_id;
        $log->delete();

        return redirect()->route('nutrition.index', $member_id)
                        ->with('success', 'Catatan nutrisi berhasil dihapus!');
    }
}