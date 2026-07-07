

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4>Detail Sesi Latihan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informasi Member</h5>
                    <p><strong>Nama:</strong> <?php echo e($session->member->name ?? '-'); ?></p>
                    <p><strong>Member Code:</strong> <?php echo e($session->member->member_code ?? '-'); ?></p>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Sesi</h5>
                    <p><strong>Tanggal:</strong> <?php echo e($session->session_date->format('d F Y')); ?></p>
                    <p><strong>Tipe Sesi:</strong> <?php echo e($session->session_type); ?></p>
                    <p><strong>Trainer:</strong> <?php echo e($session->trainer_name ?? 'Tidak ada trainer'); ?></p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-4">
                    <p><strong>Durasi:</strong> <?php echo e($session->duration_minutes); ?> menit</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Kalori Terbakar:</strong> <?php echo e(number_format($session->calories_burned ?? 0)); ?> kcal</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Berat Badan:</strong> <?php echo e($session->weight_kg ?? '-'); ?> kg</p>
                </div>
            </div>

            <div class="mt-3">
                <p><strong>Latihan yang dilakukan:</strong></p>
                <p class="border p-3 bg-light"><?php echo e($session->exercises_done ?? '-'); ?></p>
            </div>

            <div class="mt-3">
                <p><strong>Catatan:</strong></p>
                <p class="border p-3 bg-light"><?php echo e($session->notes ?? 'Tidak ada catatan'); ?></p>
            </div>

            <?php if($session->rating): ?>
            <div class="mt-3">
                <p><strong>Rating:</strong> ⭐ <?php echo e($session->rating); ?>/5</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="card-footer">
            <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-secondary">Kembali ke Daftar Sesi</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/sessions/show.blade.php ENDPATH**/ ?>