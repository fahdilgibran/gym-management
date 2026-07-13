

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Laporan & Statistik</h2>
            <p class="text-muted mb-0">Pantau performa gym dan status member dalam satu tampilan.</p>
        </div>
        <a href="<?php echo e(route('members.index')); ?>" class="btn btn-outline-secondary btn-sm">Kembali ke Member</a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-top border-4 border-primary">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-2">Total Member</p>
                    <h2 class="mb-0"><?php echo e($totalMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-top border-4 border-success">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-2">Member Aktif</p>
                    <h2 class="mb-0"><?php echo e($activeMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-top border-4 border-danger">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-2">Expired</p>
                    <h2 class="mb-0"><?php echo e($expiredMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-top border-4 border-warning">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-2">Total Kalori</p>
                    <h2 class="mb-0"><?php echo e(number_format($totalCalories)); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Member Hampir Expired</h5>
                </div>
                <div class="card-body">
                    <?php if($almostExpired->isEmpty()): ?>
                        <p class="text-muted">Tidak ada member yang mendekati masa expired.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php $__currentLoopData = $almostExpired; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <strong><?php echo e($member->name); ?></strong>
                                        <div class="text-muted small"><?php echo e($member->member_code); ?></div>
                                    </div>
                                    <span class="badge bg-warning text-dark"><?php echo e($member->expire_date->format('d M Y')); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Top 5 Member Aktif</h5>
                </div>
                <div class="card-body">
                    <?php if($topMembers->isEmpty()): ?>
                        <p class="text-muted">Belum ada data member aktif.</p>
                    <?php else: ?>
                        <ol class="list-group list-group-numbered">
                            <?php $__currentLoopData = $topMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <span><?php echo e($member->name); ?></span>
                                    <span class="badge bg-info"><?php echo e($member->workout_sessions_count); ?> sesi</span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Statistik Per Tipe Sesi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr>
                            <th>Tipe Sesi</th>
                            <th>Jumlah Sesi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sessionByType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($type->session_type); ?></td>
                                <td><strong><?php echo e($type->total); ?></strong> kali</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/reports/index.blade.php ENDPATH**/ ?>