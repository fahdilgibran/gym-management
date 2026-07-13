

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Edit Data Member</h2>
            <p class="text-muted mb-0">Perbarui detail member untuk data yang lebih akurat.</p>
        </div>
        <a href="<?php echo e(route('members.index')); ?>" class="btn btn-outline-secondary btn-sm">Kembali ke Daftar</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="<?php echo e(route('members.update', $member)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $member->name)); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Member Code</label>
                        <input type="text" name="member_code" class="form-control" value="<?php echo e(old('member_code', $member->member_code)); ?>" required>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $member->email)); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $member->phone)); ?>" required>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control" value="<?php echo e(old('birth_date', $member->birth_date?->format('Y-m-d'))); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="M" <?php echo e($member->gender == 'M' ? 'selected' : ''); ?>>Laki-laki</option>
                            <option value="F" <?php echo e($member->gender == 'F' ? 'selected' : ''); ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jenis Membership</label>
                        <select name="membership_type" class="form-select">
                            <option value="monthly" <?php echo e($member->membership_type == 'monthly' ? 'selected' : ''); ?>>Monthly</option>
                            <option value="quarterly" <?php echo e($member->membership_type == 'quarterly' ? 'selected' : ''); ?>>Quarterly</option>
                            <option value="annual" <?php echo e($member->membership_type == 'annual' ? 'selected' : ''); ?>>Annual</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date', $member->start_date?->format('Y-m-d'))); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Berakhir</label>
                        <input type="date" name="expire_date" class="form-control" value="<?php echo e(old('expire_date', $member->expire_date?->format('Y-m-d'))); ?>" required>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-warning">Update Data Member</button>
                    <a href="<?php echo e(route('members.index')); ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/members/edit.blade.php ENDPATH**/ ?>