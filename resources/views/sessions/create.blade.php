@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Catat Sesi Latihan Baru</h2>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('sessions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Member</label>
                    <select name="member_id" class="form-control" required>
                        <option value="">-- Pilih Member --</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">
                                {{ $member->name }} ({{ $member->member_code }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Sesi</label>
                        <input type="date" name="session_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipe Sesi</label>
                        <select name="session_type" id="session_type" class="form-control" required>
                            <option value="">-- Pilih Tipe Sesi --</option>
                            <option value="Cardio">Cardio</option>
                            <option value="Strength Training">Strength Training</option>
                            <option value="HIIT">HIIT</option>
                            <option value="Yoga">Yoga</option>
                            <option value="CrossFit">CrossFit</option>
                            <option value="Personal Training">Personal Training</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Trainer</label>
                        <input type="text" name="trainer_name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Durasi (Menit)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="60" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kalori Terbakar</label>
                        <input type="number" name="calories_burned" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="weight_kg" class="form-control">
                    </div>
                </div>

                <!-- Latihan yang Dilakukan (Dynamic) -->
                <div class="mb-3">
                    <label>Latihan yang Dilakukan</label>
                    <select name="exercises_done" id="exercises_done" class="form-control">
                        <option value="">-- Pilih latihan sesuai tipe sesi --</option>
                    </select>
                </div>

                <!-- Catatan -->
                <div class="mb-3">
                    <label>Catatan Tambahan</label>
                    <textarea name="notes" class="form-control" rows="4" placeholder="Catatan tambahan..."></textarea>
                </div>

                <div class="mb-3">
                    <label>Rating (1-5)</label>
                    <select name="rating" class="form-control">
                        <option value="">-- Pilih Rating --</option>
                        <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                        <option value="4">⭐⭐⭐⭐ Puas</option>
                        <option value="3">⭐⭐⭐ Cukup</option>
                        <option value="2">⭐⭐ Kurang</option>
                        <option value="1">⭐ Sangat Kurang</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan Sesi Latihan</button>
                <a href="{{ route('sessions.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('session_type').addEventListener('change', function() {
    const type = this.value;
    const exercisesSelect = document.getElementById('exercises_done');
    exercisesSelect.innerHTML = '<option value="">-- Pilih latihan --</option>';

    let exercises = [];

    if (type === 'Cardio') {
        exercises = ['Running', 'Cycling', 'Jump Rope', 'Burpees', 'Mountain Climbers'];
    } else if (type === 'Strength Training') {
        exercises = ['Bench Press', 'Squats', 'Deadlift', 'Pull Ups', 'Shoulder Press'];
    } else if (type === 'HIIT') {
        exercises = ['Burpees', 'Jumping Jacks', 'High Knees', 'Push-ups', 'Plank Jacks'];
    } else if (type === 'Yoga') {
        exercises = ['Downward Dog', 'Warrior Pose', 'Plank', 'Tree Pose', 'Sun Salutation'];
    } else if (type === 'CrossFit') {
        exercises = ['Box Jump', 'Kettlebell Swing', 'Thruster', 'Wall Ball', 'Rowing'];
    } else if (type === 'Personal Training') {
        exercises = ['Custom Program', 'Core Training', 'Mobility Work', 'Functional Training'];
    }

    exercises.forEach(ex => {
        const option = document.createElement('option');
        option.value = ex;
        option.textContent = ex;
        exercisesSelect.appendChild(option);
    });
});
</script>
@endsection