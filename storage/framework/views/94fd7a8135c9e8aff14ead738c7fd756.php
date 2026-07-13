

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Riwayat Sesi Latihan</h2>
            <p class="text-muted mb-0">Lihat, filter, dan kelola sesi latihan dengan cepat.</p>
        </div>
        <a href="<?php echo e(route('sessions.create')); ?>" class="btn btn-primary btn-sm">+ Catat Sesi Baru</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small text-muted">Cari member</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama member..." value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Filter tipe sesi</label>
                        <select name="session_type" class="form-select">
                            <option value="">Semua Tipe Sesi</option>
                            <option value="Cardio" <?php echo e(request('session_type') == 'Cardio' ? 'selected' : ''); ?>>Cardio</option>
                            <option value="Strength Training" <?php echo e(request('session_type') == 'Strength Training' ? 'selected' : ''); ?>>Strength Training</option>
                            <option value="HIIT" <?php echo e(request('session_type') == 'HIIT' ? 'selected' : ''); ?>>HIIT</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                        <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-outline-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle rounded-4 overflow-hidden shadow-sm">
            <thead class="table-secondary">
                <tr>
                    <th>Tanggal</th>
                    <th>Member</th>
                    <th>Tipe Sesi</th>
                    <th>Trainer</th>
                    <th>Durasi</th>
                    <th>Kalori</th>
                    <th>Rating</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($session->session_date->format('Y-m-d')); ?></td>
                        <td><?php echo e($session->member->name ?? 'Member tidak ditemukan'); ?></td>
                        <td><?php echo e($session->session_type); ?></td>
                        <td><?php echo e($session->trainer_name ?? '-'); ?></td>
                        <td><?php echo e($session->duration_minutes); ?> menit</td>
                        <td><?php echo e(number_format($session->calories_burned ?? 0)); ?></td>
                        <td><?php echo $session->rating ? '⭐ ' . $session->rating . '/5' : '<span class="text-muted">-</span>'; ?></td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="<?php echo e(route('sessions.show', $session)); ?>" class="btn btn-sm btn-outline-info">Detail</a>
                                <a href="<?php echo e(route('sessions.edit', $session)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="<?php echo e(route('sessions.destroy', $session)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus sesi ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada sesi latihan yang ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <?php echo e($sessions->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/sessions/index.blade.php ENDPATH**/ ?>