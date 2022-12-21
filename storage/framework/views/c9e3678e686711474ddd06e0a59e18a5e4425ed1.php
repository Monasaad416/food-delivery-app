<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->

        <div class="my-auto">
            <div class="d-flex my-4">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الرسالة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title my-3">تفاصيل الرسالة</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <tbody>
                            <tr>
                                <td>رسالة واردة من  :</td>
                                <td><?php echo e($message->name); ?></td>
                            </tr>
                            <tr>
                                <td>البريد الإلكتروني للمرسل :</td>
                                <td><?php echo e($message->email); ?></td>
                            </tr>
                            <tr>
                                <td>هاتف المرسل  :</td>
                                <td><?php echo e($message->phone); ?></td>
                            </tr>
                            <tr>
                                <td>نوع الرسالة  :</td>
                                <td><?php echo e($message->label()); ?></td>
                            </tr>
                            <tr>
                                <td>محتوي الرسالة  :</td>
                                <td><?php echo e($message->content); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/messages/show.blade.php ENDPATH**/ ?>