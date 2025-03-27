<?php $__env->startSection('content'); ?>

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title"><?php echo e(session('title')); ?></h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="<?php echo e(route('blogs.create')); ?>"> Create Blog</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Blogs</div>
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
                                <th class="wd-15p border-bottom-0">title</th>
                                <th class="wd-15p border-bottom-0">Desc</th>
                                <th class="wd-15p border-bottom-0">Author</th>
                                <th class="wd-15p border-bottom-0">Uploaded On</th>
                                <th class="wd-15p border-bottom-0">cover image</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($opportunity->id); ?></td>
                                <td><?php echo nl2br(wordwrap($opportunity->blog_title, 20, "\n", true)); ?></td>
                                <td><?php echo e(\Illuminate\Support\Str::limit($opportunity->blog_desc, 20, '...')); ?></td>
                                <td><?php echo e($opportunity->blog_author); ?></td>
                                <td><?php echo e($opportunity->date); ?></td>
                                <td>
                                <?php if(!empty($opportunity->blog_img) && is_string($opportunity->blog_img)): ?>
                                    <img src="<?php echo e(asset('storage/' . $opportunity->blog_img)); ?>" alt="Image" width="200" height="200">
                                <?php endif; ?>
                                </td>
                                <td><?php echo e($opportunity->created_at); ?></td>
                                <td>
                                        <form action="<?php echo e(route('blogs.destroy', $opportunity->id)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this blog?')">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sam T\Desktop\buyrentnow-master - Copy\buyrentnow-master\resources\views/blogs/index.blade.php ENDPATH**/ ?>