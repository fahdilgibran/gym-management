@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Detail Sesi Latihan</h2>
            <p class="text-muted mb-0">Detail lengkap sesi training dan ringkasan performa member.</p>
        </div>
        <a href="{{ route('sessions.index') }}" class="btn btn-outline-secondary btn-sm">← Kembali ke Daftar Sesi</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 border" style="background: #f8fafc;">
                        <h5 class="mb-3">Informasi Member</h5>
                        <p class="mb-2"><strong>Nama:</strong> {{ $session->member->name ?? '-' }}</p>
                        <p class="mb-2"><strong>Member Code:</strong> {{ $session->member->member_code ?? '-' }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $session->member->email ?? '-' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 border" style="background: #f8fafc;">
                        <h5 class="mb-3">Informasi Sesi</h5>
                        <p class="mb-2"><strong>Tanggal:</strong> {{ $session->session_date->format('d F Y') }}</p>
                        <p class="mb-2"><strong>Tipe Sesi:</strong> {{ $session->session_type }}</p>
                        <p class="mb-2"><strong>Trainer:</strong> {{ $session->trainer_name ?? 'Tidak ada trainer' }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-3">
                <div class="col-md-4">
                    <div class="p-4 rounded-4 border text-center" style="background: #f8fafc;">
                        <p class="text-muted small mb-1">Durasi</p>
                        <h4 class="mb-0">{{ $session->duration_minutes }} menit</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4 border text-center" style="background: #f8fafc;">
                        <p class="text-muted small mb-1">Kalori Terbakar</p>
                        <h4 class="mb-0">{{ number_format($session->calories_burned ?? 0) }} kcal</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4 border text-center" style="background: #f8fafc;">
                        <p class="text-muted small mb-1">Berat Badan</p>
                        <h4 class="mb-0">{{ $session->weight_kg ?? '-' }} kg</h4>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-3">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 border bg-white">
                        <p class="text-uppercase text-muted small mb-2">Latihan yang dilakukan</p>
                        <p class="mb-0 text-muted">{{ $session->exercises_done ?? 'Tidak ada detail latihan.' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 border bg-white">
                        <p class="text-uppercase text-muted small mb-2">Catatan</p>
                        <p class="mb-0 text-muted">{{ $session->notes ?? 'Tidak ada catatan.' }}</p>
                    </div>
                </div>
            </div>

            @if($session->rating)
                <div class="mt-4 p-4 rounded-4 border bg-white text-center">
                    <p class="text-muted small mb-2">Rating Sesi</p>
                    <h3 class="mb-0">⭐ {{ $session->rating }}/5</h3>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection