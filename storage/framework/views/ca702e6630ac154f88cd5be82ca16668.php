

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Edit Sesi Latihan</h2>
            <p class="text-muted mb-0">Perbarui detail sesi untuk memastikan laporan tetap akurat.</p>
        </div>
        <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-outline-secondary btn-sm">Kembali ke Sesi</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="<?php echo e(route('sessions.update', $session)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Member</label>
                        <select name="member_id" class="form-select" required>
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($member->id); ?>" <?php echo e($session->member_id == $member->id ? 'selected' : ''); ?>><?php echo e($member->name); ?> (<?php echo e($member->member_code); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Sesi</label>
                        <input type="date" name="session_date" class="form-control" value="<?php echo e($session->session_date->format('Y-m-d')); ?>" required>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Tipe Sesi</label>
                        <select name="session_type" class="form-select" required>
                            <option value="Cardio" <?php echo e($session->session_type == 'Cardio' ? 'selected' : ''); ?>>Cardio</option>
                            <option value="Strength Training" <?php echo e($session->session_type == 'Strength Training' ? 'selected' : ''); ?>>Strength Training</option>
                            <option value="HIIT" <?php echo e($session->session_type == 'HIIT' ? 'selected' : ''); ?>>HIIT</option>
                            <option value="Yoga" <?php echo e($session->session_type == 'Yoga' ? 'selected' : ''); ?>>Yoga</option>
                            <option value="CrossFit" <?php echo e($session->session_type == 'CrossFit' ? 'selected' : ''); ?>>CrossFit</option>
                            <option value="Personal Training" <?php echo e($session->session_type == 'Personal Training' ? 'selected' : ''); ?>>Personal Training</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Trainer</label>
                        <input type="text" name="trainer_name" class="form-control" value="<?php echo e(old('trainer_name', $session->trainer_name)); ?>">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Durasi (Menit)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="<?php echo e(old('duration_minutes', $session->duration_minutes)); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kalori Terbakar</label>
                        <input type="number" name="calories_burned" class="form-control" value="<?php echo e(old('calories_burned', $session->calories_burned)); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="weight_kg" class="form-control" value="<?php echo e(old('weight_kg', $session->weight_kg)); ?>">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Latihan yang Dilakukan</label>
                        <input type="text" name="exercises_done" class="form-control" value="<?php echo e(old('exercises_done', $session->exercises_done)); ?>">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="4"><?php echo e(old('notes', $session->notes)); ?></textarea>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select">
                            <option value="">-- Pilih Rating --</option>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <option value="<?php echo e($i); ?>" <?php echo e($session->rating == $i ? 'selected' : ''); ?>>⭐ <?php echo e($i); ?>/5</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-warning">Update Sesi</button>
                    <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/sessions/edit.blade.php ENDPATH**/ ?>