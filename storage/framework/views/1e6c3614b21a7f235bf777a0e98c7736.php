

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Detail Member</h2>
            <p class="text-muted mb-0">Informasi lengkap member dan riwayat aktivitasnya.</p>
        </div>
        <a href="<?php echo e(route('members.index')); ?>" class="btn btn-outline-secondary btn-sm">← Kembali</a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-3">Detail Personal</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Member Code</p>
                            <p class="fw-semibold mb-0"><?php echo e($member->member_code); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Nama</p>
                            <p class="fw-semibold mb-0"><?php echo e($member->name); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Email</p>
                            <p class="mb-0"><?php echo e($member->email ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Telepon</p>
                            <p class="mb-0"><?php echo e($member->phone ?? $member->user?->phone ?? '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Gender</p>
                            <p class="mb-0"><?php echo e($member->gender == 'M' ? 'Laki-laki' : ($member->gender == 'F' ? 'Perempuan' : '-')); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Tanggal Lahir</p>
                            <p class="mb-0"><?php echo e($member->birth_date ? $member->birth_date->format('d M Y') : '-'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-3">Keanggotaan</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Membership</p>
                            <p class="fw-semibold mb-0"><?php echo e(ucfirst($member->membership_type ?? 'monthly')); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Status</p>
                            <p class="mb-0">
                                <?php if($member->status == 'active'): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php elseif($member->status == 'expired'): ?>
                                    <span class="badge bg-danger">Expired</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Suspended</span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Mulai</p>
                            <p class="mb-0"><?php echo e($member->start_date ? $member->start_date->format('d M Y') : '-'); ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1 small text-muted">Berakhir</p>
                            <p class="mb-0"><?php echo e($member->expire_date ? $member->expire_date->format('d M Y') : '-'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff'): ?>
        <div class="mb-4 d-flex flex-wrap gap-2">
            <?php if(Auth::user()->role === 'admin'): ?>
                <a href="<?php echo e(route('members.edit', $member->id)); ?>" class="btn btn-warning btn-sm">Edit Data Member</a>
            <?php endif; ?>
            <a href="<?php echo e(route('measurements.create', $member->id)); ?>" class="btn btn-primary btn-sm">Catat Pengukuran Tubuh</a>
            <a href="<?php echo e(route('nutrition.create', $member->id)); ?>" class="btn btn-success btn-sm">Catat Nutrisi Harian</a>
        </div>
    <?php endif; ?>

    <?php if(Auth::user()->role === 'admin' && $member->membership_status === 'pending'): ?>
        <div class="mb-4">
            <a href="<?php echo e(route('members.confirm', $member)); ?>" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi membership untuk <?php echo e($member->name); ?>?')">
                ✅ Konfirmasi Membership
            </a>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Riwayat Pengukuran</h5>
                        <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff'): ?>
                            <a href="<?php echo e(route('measurements.index', $member->id)); ?>" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                        <?php endif; ?>
                    </div>
                    <?php if($member->bodyMeasurements->isEmpty()): ?>
                        <p class="text-muted py-4 text-center">Belum ada data pengukuran tubuh.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Berat</th>
                                        <th>Body Fat</th>
                                        <th>Muscle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $member->bodyMeasurements->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($m->measurement_date->format('d M Y')); ?></td>
                                            <td><strong><?php echo e($m->weight_kg); ?> kg</strong></td>
                                            <td><?php echo e($m->body_fat_percentage ? $m->body_fat_percentage . '%' : '-'); ?></td>
                                            <td><?php echo e($m->muscle_mass_kg ?? '-'); ?> kg</td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Riwayat Nutrisi</h5>
                        <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff'): ?>
                            <a href="<?php echo e(route('nutrition.index', $member->id)); ?>" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                        <?php endif; ?>
                    </div>
                    <?php if($member->nutritionLogs->isEmpty()): ?>
                        <p class="text-muted py-4 text-center">Belum ada catatan nutrisi.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kalori</th>
                                        <th>Protein</th>
                                        <th>Karbo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $member->nutritionLogs->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($log->log_date->format('d M Y')); ?></td>
                                            <td><?php echo e($log->calories_intake ?? '-'); ?> kkal</td>
                                            <td><?php echo e($log->protein_grams ?? '-'); ?> g</td>
                                            <td><?php echo e($log->carbs_grams ?? '-'); ?> g</td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/members/show.blade.php ENDPATH**/ ?>