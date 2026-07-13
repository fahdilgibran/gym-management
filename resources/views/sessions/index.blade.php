@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Riwayat Sesi Latihan</h2>
            <p class="text-muted mb-0">Lihat, filter, dan kelola sesi latihan dengan cepat.</p>
        </div>
        <a href="{{ route('sessions.create') }}" class="btn btn-primary btn-sm">+ Catat Sesi Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small text-muted">Cari member</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama member..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Filter tipe sesi</label>
                        <select name="session_type" class="form-select">
                            <option value="">Semua Tipe Sesi</option>
                            <option value="Cardio" {{ request('session_type') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                            <option value="Strength Training" {{ request('session_type') == 'Strength Training' ? 'selected' : '' }}>Strength Training</option>
                            <option value="HIIT" {{ request('session_type') == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                        <a href="{{ route('sessions.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle rounded-4 overflow-hidden shadow-sm">
            <thead class="table-secondary">
                <tr>
                    <th>Tanggal</th>
                    <th>Member</th>
                    <th>Tipe Sesi</th>
                    <th>Trainer</th>
                    <th>Durasi</th>
                    <th>Kalori</th>
                    <th>Rating</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sessions as $session)
                    <tr>
                        <td>{{ $session->session_date->format('Y-m-d') }}</td>
                        <td>{{ $session->member->name ?? 'Member tidak ditemukan' }}</td>
                        <td>{{ $session->session_type }}</td>
                        <td>{{ $session->trainer_name ?? '-' }}</td>
                        <td>{{ $session->duration_minutes }} menit</td>
                        <td>{{ number_format($session->calories_burned ?? 0) }}</td>
                        <td>{!! $session->rating ? '⭐ ' . $session->rating . '/5' : '<span class="text-muted">-</span>' !!}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('sessions.show', $session) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                <a href="{{ route('sessions.edit', $session) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus sesi ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada sesi latihan yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        {{ $sessions->links() }}
    </div>
</div>
@endsection