@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Sesi Latihan</h2>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('sessions.update', $session) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Member</label>
                    <select name="member_id" class="form-control" required>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ $session->member_id == $member->id ? 'selected' : '' }}>
                                {{ $member->name }} ({{ $member->member_code }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Sesi</label>
                        <input type="date" name="session_date" class="form-control" value="{{ $session->session_date->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipe Sesi</label>
                        <select name="session_type" class="form-control" required>
                            <option value="Cardio" {{ $session->session_type == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                            <option value="Strength Training" {{ $session->session_type == 'Strength Training' ? 'selected' : '' }}>Strength Training</option>
                            <option value="HIIT" {{ $session->session_type == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                            <option value="Yoga" {{ $session->session_type == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                            <option value="CrossFit" {{ $session->session_type == 'CrossFit' ? 'selected' : '' }}>CrossFit</option>
                            <option value="Personal Training" {{ $session->session_type == 'Personal Training' ? 'selected' : '' }}>Personal Training</option>
                        </select>
                    </div>
                </div>

                <!-- Sisanya sama seperti create, tapi dengan value lama -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Trainer</label>
                        <input type="text" name="trainer_name" class="form-control" value="{{ old('trainer_name', $session->trainer_name) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Durasi (Menit)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $session->duration_minutes) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kalori Terbakar</label>
                        <input type="number" name="calories_burned" class="form-control" value="{{ old('calories_burned', $session->calories_burned) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="weight_kg" class="form-control" value="{{ old('weight_kg', $session->weight_kg) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Latihan yang Dilakukan</label>
                    <input type="text" name="exercises_done" class="form-control" value="{{ old('exercises_done', $session->exercises_done) }}">
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <textarea name="notes" class="form-control" rows="4">{{ old('notes', $session->notes) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Rating</label>
                    <select name="rating" class="form-control">
                        <option value="">-- Pilih Rating --</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $session->rating == $i ? 'selected' : '' }}>⭐ {{ $i }}/5</option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">Update Sesi</button>
                <a href="{{ route('sessions.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection