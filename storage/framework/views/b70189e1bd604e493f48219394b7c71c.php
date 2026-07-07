

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Edit Profil Saya</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row">
        <!-- Foto Profil -->
        <div class="col-md-4 text-center mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <?php if($user->photo): ?>
                        <a href="<?php echo e(asset('storage/' . $user->photo)); ?>" target="_blank">
                            <img src="<?php echo e(asset('storage/' . $user->photo)); ?>" 
                                 class="rounded-circle img-fluid mb-3 shadow-sm" 
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        </a>
                    <?php else: ?>
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-6x text-muted"></i>
                        </div>
                    <?php endif; ?>
                    <h5><?php echo e($user->name); ?></h5>
                    <span class="badge bg-success"><?php echo e(ucfirst($user->role)); ?></span>

                    <?php
                        $member = $user->gymMember;
                        $statusBadge = 'secondary';
                        $statusText = 'Tidak Aktif';
                        $daysLeft = null;
                        $membershipType = $member?->membership_type ?? $user->membership_type ?? 'monthly';
                        $expireDate = $member?->expire_date ?? $user->expire_date;
                        $startDate = $member?->start_date ?? $user->start_date;
                        $status = $member?->status ?? 'active';

                        if ($status === 'active') {
                            $statusBadge = 'success';
                            $statusText = 'Aktif';
                        } elseif ($status === 'expired') {
                            $statusBadge = 'warning';
                            $statusText = 'Kadaluarsa';
                        } else {
                            $statusBadge = 'secondary';
                            $statusText = 'Ditangguhkan';
                        }

                        if ($expireDate) {
                            $daysLeft = now()->startOfDay()->diffInDays($expireDate->copy()->startOfDay(), false);
                        }
                    ?>

                    <div class="mt-3 border rounded p-3 text-start small">
                        <div class="fw-bold mb-2">Informasi Membership</div>
                        <div class="mb-1"><strong>Tipe:</strong> <?php echo e(ucfirst($membershipType)); ?></div>
                        <div class="mb-1"><strong>Mulai:</strong> <?php echo e($startDate ? $startDate->format('d M Y') : '-'); ?></div>
                        <div class="mb-1"><strong>Expired:</strong> <?php echo e($expireDate ? $expireDate->format('d M Y') : '-'); ?></div>
                        <div class="mb-1"><strong>Status:</strong> <span class="badge bg-<?php echo e($statusBadge); ?>"><?php echo e($statusText); ?></span></div>
                        <?php if($daysLeft !== null): ?>
                            <div><strong>Sisa Hari:</strong> <span class="fw-bold <?php echo e($daysLeft < 0 ? 'text-danger' : ($daysLeft <= 7 ? 'text-warning' : 'text-success')); ?>"><?php echo e($daysLeft < 0 ? abs($daysLeft) . ' hari sudah lewat' : $daysLeft . ' hari'); ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Edit Profil -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label>Foto Profil</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>No. Telepon</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $user->phone)); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="M" <?php echo e(old('gender', $user->gymMember?->gender) == 'M' ? 'selected' : ''); ?>>Laki-laki</option>
                                    <option value="F" <?php echo e(old('gender', $user->gymMember?->gender) == 'F' ? 'selected' : ''); ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="birth_date" class="form-control" 
                                       value="<?php echo e(old('birth_date', $user->gymMember?->birth_date?->format('Y-m-d'))); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tipe Membership</label>
                                <select name="membership_type" class="form-control">
                                    <option value="monthly" <?php echo e(old('membership_type', $user->gymMember?->membership_type) == 'monthly' ? 'selected' : ''); ?>>Monthly</option>
                                    <option value="quarterly" <?php echo e(old('membership_type', $user->gymMember?->membership_type) == 'quarterly' ? 'selected' : ''); ?>>Quarterly</option>
                                    <option value="annual" <?php echo e(old('membership_type', $user->gymMember?->membership_type) == 'annual' ? 'selected' : ''); ?>>Annual</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="<?php echo e(route('my.dashboard')); ?>" class="btn btn-secondary">Kembali ke My Dashboard</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/member/profile.blade.php ENDPATH**/ ?>