@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4>Detail Sesi Latihan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informasi Member</h5>
                    <p><strong>Nama:</strong> {{ $session->member->name ?? '-' }}</p>
                    <p><strong>Member Code:</strong> {{ $session->member->member_code ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Sesi</h5>
                    <p><strong>Tanggal:</strong> {{ $session->session_date->format('d F Y') }}</p>
                    <p><strong>Tipe Sesi:</strong> {{ $session->session_type }}</p>
                    <p><strong>Trainer:</strong> {{ $session->trainer_name ?? 'Tidak ada trainer' }}</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-4">
                    <p><strong>Durasi:</strong> {{ $session->duration_minutes }} menit</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Kalori Terbakar:</strong> {{ number_format($session->calories_burned ?? 0) }} kcal</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Berat Badan:</strong> {{ $session->weight_kg ?? '-' }} kg</p>
                </div>
            </div>

            <div class="mt-3">
                <p><strong>Latihan yang dilakukan:</strong></p>
                <p class="border p-3 bg-light">{{ $session->exercises_done ?? '-' }}</p>
            </div>

            <div class="mt-3">
                <p><strong>Catatan:</strong></p>
                <p class="border p-3 bg-light">{{ $session->notes ?? 'Tidak ada catatan' }}</p>
            </div>

            @if($session->rating)
            <div class="mt-3">
                <p><strong>Rating:</strong> ⭐ {{ $session->rating }}/5</p>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('sessions.index') }}" class="btn btn-secondary">Kembali ke Daftar Sesi</a>
        </div>
    </div>
</div>
@endsection