<?php

namespace App\Http\Controllers;

use App\Models\GymMember;
use Illuminate\Http\Request;

class GymMemberController extends Controller
{
    public function index()
    {
        $members = GymMember::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_code'      => 'required|unique:gym_members,member_code',
            'name'             => 'required|string|max:100',
            'email'            => 'nullable|email|unique:gym_members,email',
            'phone'            => 'required|string',
            'birth_date'       => 'nullable|date',
            'gender'           => 'nullable|in:M,F',
            'membership_type'  => 'required|in:monthly,quarterly,annual',
            'start_date'       => 'required|date',
            'expire_date'      => 'required|date|after:start_date',
        ]);

        GymMember::create($request->all());

        return redirect()->route('members.index')
                        ->with('success', 'Member baru berhasil ditambahkan!');
    }

    public function show(GymMember $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(GymMember $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, GymMember $member)
    {
        $request->validate([
            'member_code'     => 'required|unique:gym_members,member_code,' . $member->id,
            'name'            => 'required|string|max:100',
            'email'           => 'nullable|email|unique:gym_members,email,' . $member->id,
            'phone'           => 'required|string',
            'birth_date'      => 'nullable|date',
            'gender'          => 'nullable|in:M,F',
            'membership_type' => 'required|in:monthly,quarterly,annual',
            'start_date'      => 'required|date',
            'expire_date'     => 'required|date|after:start_date',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')
                        ->with('success', 'Data member berhasil diperbarui!');
    }

    public function destroy(GymMember $member)
    {
        $member->delete();
        return redirect()->route('members.index')
                        ->with('success', 'Member berhasil dihapus!');
    }
}