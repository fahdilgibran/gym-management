@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Riwayat Sesi Latihan</h2>
        <a href="{{ route('sessions.create') }}" class="btn btn-success">
            + Catat Sesi Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Filter Sesi -->
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" 
                    placeholder="Cari nama member..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="session_type" class="form-control">
                    <option value="">Semua Tipe Sesi</option>
                    <option value="Cardio" {{ request('session_type') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                    <option value="Strength Training" {{ request('session_type') == 'Strength Training' ? 'selected' : '' }}>Strength Training</option>
                    <option value="HIIT" {{ request('session_type') == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                    <!-- tambahkan lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="col-md-5">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('sessions.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Member</th>
                <th>Tipe Sesi</th>
                <th>Trainer</th>
                <th>Durasi (menit)</th>
                <th>Kalori</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
            <tr>
                <td>{{ $session->session_date->format('Y-m-d') }}</td>
                <td>{{ $session->member->name ?? 'Member tidak ditemukan' }}</td>
                <td>{{ $session->session_type }}</td>
                <td>{{ $session->trainer_name ?? '-' }}</td>
                <td>{{ $session->duration_minutes }}</td>
                <td>{{ number_format($session->calories_burned ?? 0) }}</td>
                <td>
                    @if($session->rating)
                        ⭐ {{ $session->rating }}/5
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('sessions.show', $session) }}" 
                    class="btn btn-info btn-sm">
                        Detail
                    </a>
                </td>
                <td>
                    <a href="{{ route('sessions.edit', $session) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                    
                    <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus sesi ini?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $sessions->links() }}
    </div>
</div>
@endsection