

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Catat Sesi Latihan Baru</h2>
            <p class="text-muted mb-0">Input sesi latihan member dengan cepat dan mudah.</p>
        </div>
        <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-outline-secondary btn-sm">Kembali ke Sesi</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="<?php echo e(route('sessions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Member</label>
                        <select name="member_id" class="form-select" required>
                            <option value="">-- Pilih Member --</option>
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($member->id); ?>"><?php echo e($member->name); ?> (<?php echo e($member->member_code); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Sesi</label>
                        <input type="date" name="session_date" class="form-control" required>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Tipe Sesi</label>
                        <select name="session_type" id="session_type" class="form-select" required>
                            <option value="">-- Pilih Tipe Sesi --</option>
                            <option value="Cardio">Cardio</option>
                            <option value="Strength Training">Strength Training</option>
                            <option value="HIIT">HIIT</option>
                            <option value="Yoga">Yoga</option>
                            <option value="CrossFit">CrossFit</option>
                            <option value="Personal Training">Personal Training</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Trainer</label>
                        <input type="text" name="trainer_name" class="form-control">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Durasi (Menit)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="60" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kalori Terbakar</label>
                        <input type="number" name="calories_burned" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="weight_kg" class="form-control">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Latihan yang Dilakukan</label>
                        <select name="exercises_done" id="exercises_done" class="form-select">
                            <option value="">-- Pilih latihan sesuai tipe sesi --</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="Catatan tambahan..."></textarea>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Rating (1-5)</label>
                        <select name="rating" class="form-select">
                            <option value="">-- Pilih Rating --</option>
                            <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                            <option value="4">⭐⭐⭐⭐ Puas</option>
                            <option value="3">⭐⭐⭐ Cukup</option>
                            <option value="2">⭐⭐ Kurang</option>
                            <option value="1">⭐ Sangat Kurang</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-success">Simpan Sesi Latihan</button>
                    <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/sessions/create.blade.php ENDPATH**/ ?>