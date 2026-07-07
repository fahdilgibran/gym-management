

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Laporan & Statistik Gym</h2>

    <!-- Statistik Utama -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Member</h5>
                    <h2><?php echo e($totalMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Member Aktif</h5>
                    <h2><?php echo e($activeMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5>Expired</h5>
                    <h2><?php echo e($expiredMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Total Kalori</h5>
                    <h2><?php echo e(number_format($totalCalories)); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Member Hampir Expired -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-danger text-white">
                    <h5>⚠️ Member Hampir Expired (30 hari)</h5>
                </div>
                <div class="card-body">
                    <?php if($almostExpired->isEmpty()): ?>
                        <p class="text-muted">Tidak ada member yang hampir expired.</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php $__currentLoopData = $almostExpired; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?php echo e($member->name); ?> (<?php echo e($member->member_code); ?>)</span>
                                <span class="badge bg-warning"><?php echo e($member->expire_date->format('d M Y')); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Top Member -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>🏆 Top 5 Member Aktif</h5>
                </div>
                <div class="card-body">
                    <ol>
                        <?php $__currentLoopData = $topMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-2">
                            <strong><?php echo e($member->name); ?></strong> 
                            <span class="badge bg-info"><?php echo e($member->workout_sessions_count); ?> sesi</span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Tipe Sesi -->
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h5>📈 Statistik per Tipe Sesi</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/reports/index.blade.php ENDPATH**/ ?>