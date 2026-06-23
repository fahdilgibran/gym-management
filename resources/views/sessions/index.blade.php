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
                    <a href="#" class="btn btn-info btn-sm">Detail</a>
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