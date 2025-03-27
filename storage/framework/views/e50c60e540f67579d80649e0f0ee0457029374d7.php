<?php $__env->startSection('content'); ?>

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title"><?php echo e(session('title')); ?></h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="<?php echo e(route('services.create')); ?>"> Create Service</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All LandVille Services</div>
            </div>
            <div class="card-body">
                <?php if(Session::has('message')): ?>
                <div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true"></button>
                    <?php echo e(Session::get('message')); ?>

                </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="wd-15p border-bottom-0">TITLE</th>

                                <th class="wd-15p border-bottom-0">SUB-SERVICE</th>
                                <th class="wd-20p border-bottom-0">IMAGES</th>
                                <th class="wd-20p border-bottom-0">video</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th class="wd-15p border-bottom-0">DESC</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($post->id); ?></td>
                                <td><?php echo e($post->services_title); ?></td>
                                <td>
                                    <?php if(is_array($post->sub_services)): ?>
                                        <?php echo e(implode(', ', $post->sub_services)); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                <?php if(!empty($post->services_img) && is_string($post->services_img)): ?>
                                    <img src="<?php echo e(asset('storage/' . $post->services_img)); ?>" alt="Image" width="100" height="100">
                                <?php endif; ?>
                                </td>
                                <td>
                                <?php if(!empty($post->services_video) && is_string($post->services_video)): ?>
                                        <video class="embed-responsive-item" controls width="300" height="100">
                                            <source class="embed-responsive-item" src="<?php echo e(asset('storage/' . $post->services_video)); ?>"
                                                allowfullscreen autoplay="0">
                                        </video>

                                <?php endif; ?>
                                </td>
                                <td><?php echo e($post->created_at); ?></td>
                                <td><?php echo e(\Illuminate\Support\Str::limit($post->services_desc, 20, '...')); ?></td>


                                <td>
                                        <form action="<?php echo e(route('services.destroy', $post->id)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this service?')">
                                                Delete
                                            </button>
                                        </form>
                                </td>                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- End Row -->
    <!--End Page header-->

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sam T\Desktop\buyrentnow-master - Copy\buyrentnow-master\resources\views/services/index.blade.php ENDPATH**/ ?>