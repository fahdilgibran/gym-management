@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="mb-4">🏋️‍♂️ Dashboard Gym Management</h1>

    <div class="row g-4">
        <!-- Statistik Cards -->
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5>Total Member</h5>
                    <h2>{{ $totalMembers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5>Member Aktif</h5>
                    <h2>{{ $activeMembers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5>Total Sesi</h5>
                    <h2>{{ $totalSessions }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5>Kalori Terbakar</h5>
                    <h2>{{ number_format($totalCalories) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="{{ route('members.index') }}" class="btn btn-primary btn-lg me-3">
            👥 Kelola Member
        </a>
        <a href="{{ route('sessions.index') }}" class="btn btn-success btn-lg">
            💪 Catat Sesi Latihan
        </a>
    </div>
</div>
@endsection