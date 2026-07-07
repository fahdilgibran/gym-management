

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Catat Pengukuran Tubuh - <?php echo e($member->name); ?></h2>
    <p class="text-muted">Member Code: <strong><?php echo e($member->member_code); ?></strong></p>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="<?php echo e(route('measurements.store', $member->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pengukuran</label>
                        <input type="date" name="measurement_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="weight_kg" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Body Fat (%)</label>
                        <input type="number" step="0.1" name="body_fat_percentage" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Muscle Mass (kg)</label>
                        <input type="number" step="0.1" name="muscle_mass_kg" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Lingkar Dada (cm)</label>
                        <input type="number" step="0.1" name="chest_cm" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Lingkar Pinggang (cm)</label>
                        <input type="number" step="0.1" name="waist_cm" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Lingkar Lengan (cm)</label>
                        <input type="number" step="0.1" name="arm_cm" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Catatan / Progress</label>
                    <textarea name="notes" class="form-control" rows="4" placeholder="Catatan tambahan..."></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan Pengukuran</button>
                <a href="<?php echo e(route('members.show', $member->id)); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/body_measurements/create.blade.php ENDPATH**/ ?>