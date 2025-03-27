<?php $__env->startSection('content'); ?>

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title"><?php echo e(session('title')); ?></h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="<?php echo e(route('bg_videos.create')); ?>"> Add New Video Blog</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Background Video</div>
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
                                <th class="wd-15p border-bottom-0">Background Video</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $bgVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($opportunity->id); ?></td>
                                <td>
                                    <?php if(is_string($opportunity->video_path)): ?>
                                        <video class="embed-responsive-item" controls width="200" height="200">
                                            <source class="embed-responsive-item" src="<?php echo e(asset('storage/' . $opportunity->video_path)); ?>"
                                                allowfullscreen autoplay="0">
                                        </video>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($opportunity->created_at); ?></td>
                                <td>
                                <form action="<?php echo e(route('bg_videos.destroy', $opportunity->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this video?')">
                                        Delete
                                    </button>
                                </form>

                                </td>
                            </tr>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sam T\Desktop\buyrentnow-master - Copy\buyrentnow-master\resources\views/bg_videos/index.blade.php ENDPATH**/ ?>