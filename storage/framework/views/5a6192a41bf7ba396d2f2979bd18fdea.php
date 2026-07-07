

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">My Dashboard - <?php echo e(auth()->user()->name); ?></h2>

    <?php
        $user = auth()->user();
        $member = $user->gymMember;
        $membershipBadge = 'secondary';
        $membershipText = 'Tidak Aktif';
        $daysLeft = null;
        $membershipType = $member?->membership_type ?? $user->membership_type ?? 'monthly';
        $expireDate = $member?->expire_date ?? $user->expire_date;
        $startDate = $member?->start_date ?? $user->start_date;
        $status = $member?->status ?? 'active';

        if ($status === 'active') {
            $membershipBadge = 'success';
            $membershipText = 'Aktif';
        } elseif ($status === 'expired') {
            $membershipBadge = 'warning';
            $membershipText = 'Kadaluarsa';
        } else {
            $membershipBadge = 'secondary';
            $membershipText = 'Ditangguhkan';
        }

        if ($expireDate) {
            $daysLeft = now()->startOfDay()->diffInDays($expireDate->copy()->startOfDay(), false);
        }
    ?>

    <div class="alert alert-info shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <strong>Membership Anda:</strong> <?php echo e(ucfirst($membershipType)); ?>

            <span class="badge bg-<?php echo e($membershipBadge); ?> ms-2"><?php echo e($membershipText); ?></span>
        </div>
        <div class="text-end">
            <div><strong>Mulai:</strong> <?php echo e($startDate ? $startDate->format('d M Y') : '-'); ?></div>
            <div><strong>Expired:</strong> <?php echo e($expireDate ? $expireDate->format('d M Y') : '-'); ?></div>
            <?php if($daysLeft !== null): ?>
                <div class="fw-bold <?php echo e($daysLeft < 0 ? 'text-danger' : ($daysLeft <= 7 ? 'text-warning' : 'text-success')); ?>">
                    <?php echo e($daysLeft < 0 ? abs($daysLeft) . ' hari sudah lewat' : $daysLeft . ' hari lagi'); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4">
        <!-- Statistik Pribadi -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body text-center">
                    <h5>Total Sesi Latihan</h5>
                    <h2><?php echo e($totalSessions); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body text-center">
                    <h5>Total Kalori Terbakar</h5>
                    <h2><?php echo e(number_format($totalCalories)); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info shadow">
                <div class="card-body text-center">
                    <h5>Pengukuran Terakhir</h5>
                    <h2><?php echo e($latestMeasurements->count() > 0 ? $latestMeasurements->first()->weight_kg . ' kg' : '-'); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pengukuran Terbaru -->
    <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">
            <h5>Pengukuran Tubuh Terbaru</h5>
        </div>
        <div class="card-body">
            <?php if($latestMeasurements->isEmpty()): ?>
                <p class="text-muted">Belum ada data pengukuran.</p>
            <?php else: ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Berat</th>
                            <th>Body Fat</th>
                            <th>Muscle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $latestMeasurements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($m->measurement_date->format('d M Y')); ?></td>
                            <td><strong><?php echo e($m->weight_kg); ?> kg</strong></td>
                            <td><?php echo e($m->body_fat_percentage ? $m->body_fat_percentage . '%' : '-'); ?></td>
                            <td><?php echo e($m->muscle_mass_kg ?? '-'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Riwayat Nutrisi Terbaru -->
    <div class="card shadow mt-4">
        <div class="card-header bg-success text-white">
            <h5>Nutrisi Terbaru</h5>
        </div>
        <div class="card-body">
            <?php if($latestNutrition->isEmpty()): ?>
                <p class="text-muted">Belum ada catatan nutrisi.</p>
            <?php else: ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kalori</th>
                            <th>Protein</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $latestNutrition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($log->log_date->format('d M Y')); ?></td>
                            <td><?php echo e($log->calories_intake ?? '-'); ?> kkal</td>
                            <td><?php echo e($log->protein_grams ?? '-'); ?> g</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/member/dashboard.blade.php ENDPATH**/ ?>