@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Member - {{ $member->name }}</h2>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <!-- Informasi Member -->
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

    <!-- Tombol Fitur -->
    <div class="mb-4">
        <a href="{{ route('measurements.create', $member->id) }}" class="btn btn-primary btn-lg me-2">
            Catat Pengukuran Tubuh
        </a>
        <a href="{{ route('nutrition.create', $member->id) }}" class="btn btn-success btn-lg me-2">
            Catat Nutrisi Harian
        </a>
        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-lg">
            Edit Data Member
        </a>
    </div>

    <!-- Riwayat Pengukuran Tubuh -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between">
            <h5>Riwayat Pengukuran Tubuh Terbaru</h5>
            <a href="{{ route('measurements.index', $member->id) }}" class="btn btn-sm btn-light">Lihat Semua</a>
        </div>
        <div class="card-body">
            @if($member->bodyMeasurements->isEmpty())
                <p class="text-muted text-center py-4">Belum ada data pengukuran tubuh.</p>
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
                        @foreach($member->bodyMeasurements->take(5) as $m)
                        <tr>
                            <td>{{ $m->measurement_date->format('d M Y') }}</td>
                            <td><strong>{{ $m->weight_kg }} kg</strong></td>
                            <td>{{ $m->body_fat_percentage ? $m->body_fat_percentage . '%' : '-' }}</td>
                            <td>{{ $m->muscle_mass_kg ?? '-' }} kg</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Riwayat Nutrisi -->
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between">
            <h5>Riwayat Nutrisi Terbaru</h5>
            <a href="{{ route('nutrition.index', $member->id) }}" class="btn btn-sm btn-light">Lihat Semua</a>
        </div>
        <div class="card-body">
            @if($member->nutritionLogs->isEmpty())
                <p class="text-muted text-center py-4">Belum ada catatan nutrisi.</p>
            @else
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kalori</th>
                            <th>Protein</th>
                            <th>Karbo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($member->nutritionLogs->take(5) as $log)
                        <tr>
                            <td>{{ $log->log_date->format('d M Y') }}</td>
                            <td>{{ $log->calories_intake ?? '-' }} kkal</td>
                            <td>{{ $log->protein_grams ?? '-' }}g</td>
                            <td>{{ $log->carbs_grams ?? '-' }}g</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection