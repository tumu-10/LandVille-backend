<?php $__env->startSection('content'); ?>


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Service</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo e(route('services.index')); ?>"> Back</a>
        </div>
        <?php if(session('status')): ?>
        <div class="alert alert-success mb-1 mt-1">
            <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <div class="card-body">
            <form action="<?php echo e(route('services.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="services_title" class="form-label">Title:</label>
                    <input type="text" name="services_title" class="form-control" placeholder="Name of the Property">
                    <?php $__errorArgs = ['services_title'];
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
                    <label for="services_desc" class="form-label">Description:</label>
                    <textarea name="services_desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                    <?php $__errorArgs = ['services_desc'];
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
                    <label for="sub_services">Sub Services</label>
                    <input type="text" name="sub_services[]" class="form-control" placeholder="Enter sub-service" value="<?php echo e(old('sub_services.0')); ?>" required>
                    <button type="button" onclick="addSubService()">Add More</button>
                    <div id="subServicesContainer"></div>
                    <?php $__errorArgs = ['sub_services'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                 </div>
                <div class="col-md-10">
                    <label for='services_img' class="form-label">Select Cover Picture:</label>
                    <input type="file" name="services_img" id="services_img" class="form-control" />
                    <?php $__errorArgs = ['services_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger mt-4 mb-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-10">
                    <label for='video' class="form-label">Select video:</label>
                    <input type="file" name="video" id="video" class="form-control" />
                    <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger mt-4 mb-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>


                <button type="submit" class="btn btn-primary mt-5 mb-0">Create Service</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

    <script>
        function addSubService() {
            const container = document.getElementById('subServicesContainer');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'sub_services[]';
            input.classList.add('form-control');
            container.appendChild(input);
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sam T\Desktop\buyrentnow-master - Copy\buyrentnow-master\resources\views/services/create.blade.php ENDPATH**/ ?>