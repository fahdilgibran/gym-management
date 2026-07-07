

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Riwayat Pengukuran Tubuh - <?php echo e($member->name); ?></h2>
        <a href="<?php echo e(route('measurements.create', $member->id)); ?>" class="btn btn-primary">
            + Catat Pengukuran Baru
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Berat (kg)</th>
                <th>Body Fat (%)</th>
                <th>Muscle Mass (kg)</th>
                <th>Dada (cm)</th>
                <th>Pinggang (cm)</th>
                <th>Lengan (cm)</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $measurements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($m->measurement_date->format('d M Y')); ?></td>
                <td><strong><?php echo e($m->weight_kg); ?> kg</strong></td>
                <td><?php echo e($m->body_fat_percentage ? $m->body_fat_percentage . '%' : '-'); ?></td>
                <td><?php echo e($m->muscle_mass_kg ?? '-'); ?> kg</td>
                <td><?php echo e($m->chest_cm ?? '-'); ?> cm</td>
                <td><?php echo e($m->waist_cm ?? '-'); ?> cm</td>
                <td><?php echo e($m->arm_cm ?? '-'); ?> cm</td>
                <td>
                    <a href="<?php echo e(route('measurements.edit', $m)); ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                    
                    <form action="<?php echo e(route('measurements.destroy', $m)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus pengukuran ini?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="mt-4">
        <?php echo e($measurements->links()); ?>

    </div>

    <a href="<?php echo e(route('members.show', $member->id)); ?>" class="btn btn-secondary mt-3">Kembali ke Detail Member</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\gym-management\resources\views/body_measurements/index.blade.php ENDPATH**/ ?>