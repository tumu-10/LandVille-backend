<?php $__env->startSection('content'); ?>


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add main_titles</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo e(route('mainTitles.index')); ?>"> Back</a>
        </div>
        <?php if(session('status')): ?>
        <div class="alert alert-success mb-1 mt-1">
            <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <div class="card-body">
            <form action="<?php echo e(route('mainTitles.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="word1" class="form-label">WORD ONE:</label>
                    <input type="text" name="word1" class="form-control" placeholder="Name of the Property">
                    <?php $__errorArgs = ['word1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="word2" class="form-label">WORD TWO:</label>
                    <textarea name="word2" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                    <?php $__errorArgs = ['word2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Add New Titles</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sam T\Desktop\buyrentnow-master - Copy\buyrentnow-master\resources\views/mainTitles/create.blade.php ENDPATH**/ ?>