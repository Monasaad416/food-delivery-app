<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="<?php echo e(route('home')); ?>">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طلبات العميل </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make("dashboard.inc.message", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"> طلبات العميل : <?php echo e($client->name); ?></h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">العمبل</th>
                            <th class="text-center">المطعم</th>
                            <th class="text-center">العنوان </th>
                            <th class="text-center">طريقة الدفع</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">إجمالي المبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th><?php echo e($loop->iteration); ?></th>
                                <th><?php echo e($order->client->name); ?></th>
                                <td><?php echo e($order->restaurant->name); ?></td>
                                <td><?php echo e($order->address); ?></td>
                                <td><?php echo e($order->payment_method->name); ?></td>
                                <td><?php echo e($order->label()); ?></td>
                                <td><?php echo e($order->total_price); ?></td>
                            </tr>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>			
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/clients/client_orders.blade.php ENDPATH**/ ?>