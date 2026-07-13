@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="mb-1">Dashboard Admin</h1>
            <p class="text-muted mb-0">Ringkasan statistik member, sesi, dan performa gym secara cepat.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('members.index') }}" class="btn btn-outline-primary">Kelola Member</a>
            <a href="{{ route('sessions.index') }}" class="btn btn-outline-success">Catat Sesi</a>
            <a href="{{ route('reports.index') }}" class="btn btn-outline-info">Laporan</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-top border-4 border-primary">
                <div class="card-body">
                    <p class="text-uppercase text-muted mb-2 small">Total Member</p>
                    <h2 class="mb-0">{{ $totalMembers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-top border-4 border-success">
                <div class="card-body">
                    <p class="text-uppercase text-muted mb-2 small">Member Aktif</p>
                    <h2 class="mb-0">{{ $activeMembers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-top border-4 border-info">
                <div class="card-body">
                    <p class="text-uppercase text-muted mb-2 small">Total Sesi</p>
                    <h2 class="mb-0">{{ $totalSessions }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-top border-4 border-warning">
                <div class="card-body">
                    <p class="text-uppercase text-muted mb-2 small">Kalori Terbakar</p>
                    <h2 class="mb-0">{{ number_format($totalCalories) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Member Hampir Expired</h5>
                </div>
                <div class="card-body">
                    @if($almostExpired->isEmpty())
                        <p class="text-muted">Tidak ada member yang hampir expired dalam 30 hari.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($almostExpired as $member)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $member->name }}</strong>
                                        <div class="text-muted small">{{ $member->member_code }}</div>
                                    </div>
                                    <span class="badge bg-warning text-dark">{{ $member->expire_date->format('d M Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Top 5 Member Aktif</h5>
                </div>
                <div class="card-body">
                    @if($topMembers->isEmpty())
                        <p class="text-muted">Belum ada data member aktif.</p>
                    @else
                        <ol class="list-group list-group-numbered">
                            @foreach($topMembers as $member)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $member->name }}</span>
                                    <span class="badge bg-info">{{ $member->workout_sessions_count }} sesi</span>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection