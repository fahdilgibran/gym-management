@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Member - {{ $member->name }}</h2>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5>Informasi Member</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Member Code:</strong> {{ $member->member_code }}</p>
                    <p><strong>Nama:</strong> {{ $member->name }}</p>
                    <p><strong>Email:</strong> {{ $member->email ?? '-' }}</p>
                    <p><strong>Telepon:</strong> {{ $member->phone }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal Lahir:</strong> {{ $member->birth_date ? $member->birth_date->format('d M Y') : '-' }}</p>
                    <p><strong>Jenis Membership:</strong> {{ ucfirst($member->membership_type) }}</p>
                    <p><strong>Mulai:</strong> {{ $member->start_date ? $member->start_date->format('d M Y') : '-' }}</p>
                    <p><strong>Berakhir:</strong> {{ $member->expire_date ? $member->expire_date->format('d M Y') : '-' }}</p>
                    <p><strong>Status:</strong> 
                        @if($member->status == 'active')
                            <span class="badge bg-success">Aktif</span>
                        @elseif($member->status == 'expired')
                            <span class="badge bg-danger">Expired</span>
                        @else
                            <span class="badge bg-warning">Suspended</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Pengukuran Tubuh -->
    <div class="mb-4">
        <a href="{{ route('measurements.create', $member->id) }}" class="btn btn-primary btn-lg">
            Catat Pengukuran Tubuh Baru
        </a>
        <a href="{{ route('measurements.index', $member->id) }}" class="btn btn-outline-primary btn-lg ms-2">
            Lihat Riwayat Pengukuran
        </a>
    </div>

    <!-- Riwayat Pengukuran Terbaru (preview) -->
    <div class="card shadow">
        <div class="card-header">
            <h5>Riwayat Pengukuran Terbaru</h5>
        </div>
        <div class="card-body">
            @if($member->bodyMeasurements->isEmpty())
                <p class="text-muted">Belum ada data pengukuran tubuh.</p>
            @else
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Berat (kg)</th>
                            <th>Body Fat (%)</th>
                            <th>Muscle (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($member->bodyMeasurements->take(5) as $m)
                        <tr>
                            <td>{{ $m->measurement_date->format('d M Y') }}</td>
                            <td><strong>{{ $m->weight_kg }}</strong></td>
                            <td>{{ $m->body_fat_percentage ?? '-' }}%</td>
                            <td>{{ $m->muscle_mass_kg ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection