<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="<?php echo e(route('dashboard.home')); ?>">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كشف حساب</span>
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
                    <h4 class="card-title mg-b-0"> كشف حساب المطعم : <?php echo e($restaurant->name); ?></h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <tbody>
                            <tr>
                                <td class="text-center h5">إجمالي تكلفة الطلبات</td>
                                <td class="text-center"><?php echo e($totalOrders); ?></td>
                            </tr>   
                            <tr>
                            
                            <td class="text-center h5">إجمالي عمولة الموقع</td> 
                            <td class="text-center"><?php echo e($totalCommessions); ?></td>
                            </tr>
                            <tr>
                                <td class="text-center h5">إجمالي ماتم دفعه </td>
                                <td class="text-center"> <?php echo e($totalPayments); ?></td>
                            </tr>
                            <tr>   
                                <td class="text-center h5">أجمالي المتبقي </td> 
                                <td class="text-center"><?php echo e($remainning); ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>





<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/restaurants/balance_sheet.blade.php ENDPATH**/ ?>