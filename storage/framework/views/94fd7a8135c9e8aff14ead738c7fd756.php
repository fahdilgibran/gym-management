

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Riwayat Sesi Latihan</h2>
        <a href="<?php echo e(route('sessions.create')); ?>" class="btn btn-success">
            + Catat Sesi Baru
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Form Filter Sesi -->
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" 
                    placeholder="Cari nama member..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3">
                <select name="session_type" class="form-control">
                    <option value="">Semua Tipe Sesi</option>
                    <option value="Cardio" <?php echo e(request('session_type') == 'Cardio' ? 'selected' : ''); ?>>Cardio</option>
                    <option value="Strength Training" <?php echo e(request('session_type') == 'Strength Training' ? 'selected' : ''); ?>>Strength Training</option>
                    <option value="HIIT" <?php echo e(request('session_type') == 'HIIT' ? 'selected' : ''); ?>>HIIT</option>
                    <!-- tambahkan lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="col-md-5">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

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
            <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($session->session_date->format('Y-m-d')); ?></td>
                <td><?php echo e($session->member->name ?? 'Member tidak ditemukan'); ?></td>
                <td><?php echo e($session->session_type); ?></td>
                <td><?php echo e($session->trainer_name ?? '-'); ?></td>
                <td><?php echo e($session->duration_minutes); ?></td>
                <td><?php echo e(number_format($session->calories_burned ?? 0)); ?></td>
                <td>
                    <?php if($session->rating): ?>
                        ⭐ <?php echo e($session->rating); ?>/5
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e(route('sessions.show', $session)); ?>" 
                    class="btn btn-info btn-sm">
                        Detail
                    </a>
                </td>
                <td>
                    <a href="<?php echo e(route('sessions.edit', $session)); ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                    
                    <form action="<?php echo e(route('sessions.destroy', $session)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus sesi ini?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="mt-4">
        <?php echo e($sessions->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/sessions/index.blade.php ENDPATH**/ ?>