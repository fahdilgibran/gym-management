

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Member Gym</h2>
        <a href="<?php echo e(route('members.create')); ?>" class="btn btn-primary">
            + Tambah Member Baru
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Form Pencarian & Filter -->
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" 
                    placeholder="Cari nama, kode member, atau email..." 
                    value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="expired" <?php echo e(request('status') == 'expired' ? 'selected' : ''); ?>>Expired</option>
                    <option value="suspended" <?php echo e(request('status') == 'suspended' ? 'selected' : ''); ?>>Suspended</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
    <tr>
        <th>Member Code</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No. Telepon</th>        <!-- ← Tambahkan ini -->
        <th>Membership</th>
        <th>Expire Date</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
        <tbody>
            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong><?php echo e($member->member_code); ?></strong></td>
                <td><?php echo e($member->name); ?></td>
                <td><?php echo e($member->email ?? '-'); ?></td>
                <td><?php echo e($member->phone ?? $member->user?->phone ?? '-'); ?></td>
                <td><?php echo e(ucfirst($member->membership_type)); ?></td>
                <td><?php echo e($member->start_date ? $member->start_date->format('Y-m-d') : '-'); ?></td>
                <td><?php echo e($member->expire_date ? $member->expire_date->format('Y-m-d') : '-'); ?></td>
                <td>
                    <?php if($member->status == 'active'): ?>
                        <span class="badge bg-success">Aktif</span>
                    <?php elseif($member->status == 'expired'): ?>
                        <span class="badge bg-danger">Expired</span>
                    <?php else: ?>
                        <span class="badge bg-warning">Suspended</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e(route('members.show', $member)); ?>" class="btn btn-info btn-sm">Detail</a>
                </td>
                <td>
                    <?php if(Auth::user()->role === 'admin'): ?>
                        <a href="<?php echo e(route('members.edit', $member)); ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                        
                        <form action="<?php echo e(route('members.destroy', $member)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus member ini? Data dan riwayatnya juga akan terhapus.')">
                                Delete
                            </button>
                        </form>
                    <?php else: ?>
                        <span class="text-muted small">—</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="mt-4">
        <?php echo e($members->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/members/index.blade.php ENDPATH**/ ?>