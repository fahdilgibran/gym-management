<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Dashboard Gym Management</h1>

    <div class="row g-4">
        <!-- Statistik Cards -->
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5>Total Member</h5>
                    <h2><?php echo e($totalMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5>Member Aktif</h5>
                    <h2><?php echo e($activeMembers); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5>Total Sesi</h5>
                    <h2><?php echo e($totalSessions); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5>Kalori Terbakar</h5>
                    <h2><?php echo e(number_format($totalCalories)); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="<?php echo e(route('members.index')); ?>" class="btn btn-primary btn-lg me-3">
            Kelola Member
        </a>
        <a href="<?php echo e(route('sessions.index')); ?>" class="btn btn-success btn-lg">
            Catat Sesi Latihan
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/dashboard.blade.php ENDPATH**/ ?>