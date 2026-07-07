

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Member - <?php echo e($member->name); ?></h2>
        <a href="<?php echo e(route('members.index')); ?>" class="btn btn-secondary">← Kembali</a>
    </div>

    <!-- Informasi Member -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5>Informasi Member</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Member Code:</strong> <?php echo e($member->member_code); ?></p>
                    <p><strong>Nama:</strong> <?php echo e($member->name); ?></p>
                    <p><strong>Email:</strong> <?php echo e($member->email ?? '-'); ?></p>
                    <p><strong>No. Telepon:</strong> <?php echo e($member->phone ?? $member->user?->phone ?? '-'); ?></p>
                    <p><strong>Gender:</strong> <?php echo e($member->gender == 'M' ? 'Laki-laki' : ($member->gender == 'F' ? 'Perempuan' : '-')); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal Lahir:</strong> <?php echo e($member->birth_date ? $member->birth_date->format('d M Y') : '-'); ?></p>
                    <p><strong>Jenis Membership:</strong> <?php echo e(ucfirst($member->membership_type)); ?></p>
                    <p><strong>Mulai:</strong> <?php echo e($member->start_date ? $member->start_date->format('d M Y') : '-'); ?></p>
                    <p><strong>Berakhir:</strong> <?php echo e($member->expire_date ? $member->expire_date->format('d M Y') : '-'); ?></p>
                    <p><strong>Status:</strong> 
                        <?php if($member->status == 'active'): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php elseif($member->status == 'expired'): ?>
                            <span class="badge bg-danger">Expired</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Suspended</span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi (Hanya untuk Admin & Staff) -->
    <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff'): ?>
    <div class="mb-4">
        <?php if(Auth::user()->role === 'admin'): ?>
            <a href="<?php echo e(route('members.edit', $member->id)); ?>" class="btn btn-warning btn-lg me-2">
                Edit Data Member
            </a>
        <?php endif; ?>
        
        <a href="<?php echo e(route('measurements.create', $member->id)); ?>" class="btn btn-primary btn-lg me-2">
            Catat Pengukuran Tubuh
        </a>
        
        <a href="<?php echo e(route('nutrition.create', $member->id)); ?>" class="btn btn-success btn-lg">
            Catat Nutrisi Harian
        </a>
    </div>
    <?php endif; ?>

    <!-- Riwayat Pengukuran Tubuh -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between">
            <h5>Riwayat Pengukuran Tubuh Terbaru</h5>
            <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff'): ?>
                <a href="<?php echo e(route('measurements.index', $member->id)); ?>" class="btn btn-sm btn-light">Lihat Semua</a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if($member->bodyMeasurements->isEmpty()): ?>
                <p class="text-muted text-center py-4">Belum ada data pengukuran tubuh.</p>
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
            <?php endif; ?>
        </div>
    </div>

    <!-- Riwayat Nutrisi -->
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between">
            <h5>Riwayat Nutrisi Terbaru</h5>
            <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff'): ?>
                <a href="<?php echo e(route('nutrition.index', $member->id)); ?>" class="btn btn-sm btn-light">Lihat Semua</a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if($member->nutritionLogs->isEmpty()): ?>
                <p class="text-muted text-center py-4">Belum ada catatan nutrisi.</p>
            <?php else: ?>
                <table class="table table-sm">
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
                            <td><?php echo e($log->protein_grams ?? '-'); ?>g</td>
                            <td><?php echo e($log->carbs_grams ?? '-'); ?>g</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/members/show.blade.php ENDPATH**/ ?>