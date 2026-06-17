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
        // Untuk sementara kita kosongkan dulu, nanti kita lengkapi
        return redirect()->route('members.index')
                         ->with('success', 'Member berhasil ditambahkan!');
    }

    public function show(GymMember $member)
    {
        return view('members.show', compact('member'));
    }
}