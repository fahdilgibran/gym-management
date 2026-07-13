@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">My Dashboard - {{ auth()->user()->name }}</h2>

    @php
        $user = auth()->user();
        $member = $user->gymMember;
        $membershipBadge = 'secondary';
        $membershipText = 'Tidak Aktif';
        $daysLeft = null;
        $membershipType = $member?->membership_type ?? $user->membership_type ?? 'monthly';
        $expireDate = $member?->expire_date ?? $user->expire_date;
        $startDate = $member?->start_date ?? $user->start_date;
        $status = $member?->status ?? 'active';
        
        if ($status === 'active') {
            $membershipBadge = 'success';
            $membershipText = 'Aktif';
        } elseif ($status === 'expired') {
            $membershipBadge = 'warning';
            $membershipText = 'Kadaluarsa';
        } else {
            $membershipBadge = 'secondary';
            $membershipText = 'Ditangguhkan';
        }
        
        if ($expireDate) {
            $daysLeft = now()->startOfDay()->diffInDays($expireDate->copy()->startOfDay(), false);
        }
    @endphp

    <!-- Notifikasi Membership Status -->
    @if($member && $member->membership_status === 'pending')
        <div class="alert alert-warning alert-dismissible fade show">
            <strong>Membership Anda masih Pending!</strong> Mohon tunggu konfirmasi dari Admin.
        </div>
    @elseif($member && $member->membership_status === 'active')
        <div class="alert alert-success alert-dismissible fade show">
            Membership Anda aktif sampai <strong>{{ $member->expire_date->format('d M Y') }}</strong>
        </div>
    @endif

    <!-- Info Membership -->
    <div class="alert alert-info shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <strong>Membership Anda:</strong> {{ ucfirst($membershipType) }}
            <span class="badge bg-{{ $membershipBadge }} ms-2">{{ $membershipText }}</span>
        </div>
        <div class="text-end">
            <div><strong>Mulai:</strong> {{ $startDate ? $startDate->format('d M Y') : '-' }}</div>
            <div><strong>Expired:</strong> {{ $expireDate ? $expireDate->format('d M Y') : '-' }}</div>
            @if($daysLeft !== null)
                <div class="fw-bold {{ $daysLeft < 0 ? 'text-danger' : ($daysLeft <= 7 ? 'text-warning' : 'text-success') }}">
                    {{ $daysLeft < 0 ? abs($daysLeft) . ' hari sudah lewat' : $daysLeft . ' hari lagi' }}
                </div>
            @endif
        </div>
    </div>

    <div class="row g-4">
        <!-- Statistik Pribadi -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body text-center">
                    <h5>Total Sesi Latihan</h5>
                    <h2>{{ $totalSessions ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body text-center">
                    <h5>Total Kalori Terbakar</h5>
                    <h2>{{ number_format($totalCalories ?? 0) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info shadow">
                <div class="card-body text-center">
                    <h5>Pengukuran Terakhir</h5>
                    <h2>{{ $latestMeasurements->count() > 0 ? $latestMeasurements->first()->weight_kg . ' kg' : '-' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pengukuran Terbaru -->
    <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">
            <h5>Pengukuran Tubuh Terbaru</h5>
        </div>
        <div class="card-body">
            @if($latestMeasurements->isEmpty())
                <p class="text-muted">Belum ada data pengukuran.</p>
            @else
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Berat</th>
                            <th>Body Fat</th>
                            <th>Muscle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestMeasurements as $m)
                        <tr>
                            <td>{{ $m->measurement_date->format('d M Y') }}</td>
                            <td><strong>{{ $m->weight_kg }} kg</strong></td>
                            <td>{{ $m->body_fat_percentage ? $m->body_fat_percentage . '%' : '-' }}</td>
                            <td>{{ $m->muscle_mass_kg ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Riwayat Nutrisi Terbaru -->
    <div class="card shadow mt-4">
        <div class="card-header bg-success text-white">
            <h5>Nutrisi Terbaru</h5>
        </div>
        <div class="card-body">
            @if($latestNutrition->isEmpty())
                <p class="text-muted">Belum ada catatan nutrisi.</p>
            @else
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kalori</th>
                            <th>Protein</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestNutrition as $log)
                        <tr>
                            <td>{{ $log->log_date->format('d M Y') }}</td>
                            <td>{{ $log->calories_intake ?? '-' }} kkal</td>
                            <td>{{ $log->protein_grams ?? '-' }} g</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection