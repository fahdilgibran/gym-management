@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Edit Sesi Latihan</h2>
            <p class="text-muted mb-0">Perbarui detail sesi untuk memastikan laporan tetap akurat.</p>
        </div>
        <a href="{{ route('sessions.index') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Sesi</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('sessions.update', $session) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Member</label>
                        <select name="member_id" class="form-select" required>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ $session->member_id == $member->id ? 'selected' : '' }}>{{ $member->name }} ({{ $member->member_code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Sesi</label>
                        <input type="date" name="session_date" class="form-control" value="{{ $session->session_date->format('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Tipe Sesi</label>
                        <select name="session_type" class="form-select" required>
                            <option value="Cardio" {{ $session->session_type == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                            <option value="Strength Training" {{ $session->session_type == 'Strength Training' ? 'selected' : '' }}>Strength Training</option>
                            <option value="HIIT" {{ $session->session_type == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                            <option value="Yoga" {{ $session->session_type == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                            <option value="CrossFit" {{ $session->session_type == 'CrossFit' ? 'selected' : '' }}>CrossFit</option>
                            <option value="Personal Training" {{ $session->session_type == 'Personal Training' ? 'selected' : '' }}>Personal Training</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Trainer</label>
                        <input type="text" name="trainer_name" class="form-control" value="{{ old('trainer_name', $session->trainer_name) }}">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Durasi (Menit)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $session->duration_minutes) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kalori Terbakar</label>
                        <input type="number" name="calories_burned" class="form-control" value="{{ old('calories_burned', $session->calories_burned) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="weight_kg" class="form-control" value="{{ old('weight_kg', $session->weight_kg) }}">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Latihan yang Dilakukan</label>
                        <input type="text" name="exercises_done" class="form-control" value="{{ old('exercises_done', $session->exercises_done) }}">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="4">{{ old('notes', $session->notes) }}</textarea>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select">
                            <option value="">-- Pilih Rating --</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $session->rating == $i ? 'selected' : '' }}>⭐ {{ $i }}/5</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-warning">Update Sesi</button>
                    <a href="{{ route('sessions.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection