<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->

        <div class="my-auto">
            <div class="d-flex my-4">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الطلب</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        بيانات الطلب
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table-reference text-nowrap mb-0 mg-t-5">
                            <thead>
                                <tr>
                                    <th class="wd-30p">البند</th>
                                    <th class="wd-70p">التفاصيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>إسم العميل</td>
                                    <td> <a href = "<?php echo e(route('client.orders',['client_id' =>$order->client->id])); ?>" ><?php echo e($order->client->name); ?></a></td>
                                </tr>
                                <tr>
                                    <td>إسم المطعم</td>
                                    <td> <a href = "<?php echo e(route('restaurant.orders',$order->restaurant->id)); ?>" ><?php echo e($order->restaurant->name); ?></a></td>
                                </tr>
                                <tr>
                                    <td>العنوان</td>
                                    <td> <?php echo e($order->address); ?></td>
                                </tr>
                                <tr>
                                    <td>طريقة الدفع</td>
                                    <td> <?php echo e($order->payment_method->name); ?></td>
                                </tr>
                                <tr>
                                    <td>حالة الطلب</td>
                                    <td> <?php echo e($order->label()); ?></td>
                                </tr>
                                <tr>
                                    <td>ملاحظات</td>
                                    <td class="text-danger"> <?php echo e($order->notes ? $order->notes : 'لايوجد ملاحظات علي الطلب'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        تفاصيل البنود
                    </div>

                    <div class="table-responsive">
                        <table class="table main-table-reference text-nowrap mb-0 mg-t-5">
                            <thead>
                                <tr>
                                    <th class="wd-20p">البند</th>
                                    <th class="wd-20p">سعر الوحدة </th>
                                    <th class="wd-20p">الكميه</th>
                                    <th class="wd-20p">إجمالي البند</th>
                                    <th class="wd-20p">إضافات خاصة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    
                                        <td><?php echo e($orderItem->name); ?></td>
                                        <td><?php echo e($orderItem->pivot->qty); ?></td>
                                        <td><?php echo e($orderItem->pivot->item_price); ?></td>
                                        <td><?php echo e($orderItem->pivot->total_price); ?></td>
                                        <td><?php echo e($orderItem->pivot->add_special); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                         التكلفة
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table-reference text-nowrap mb-0 mg-t-5">
                            <thead>
                                <tr>
                                    <th class="wd-30p">البند</th>
                                    <th class="wd-70p">السعر</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>تكلفة  البنود</td>
                                    <td> <?php echo e($order->total_price); ?> جنيه</td>
                                </tr>
                                <tr>
                                    <td>رسوم التوصيل</td>
                                    <td> <?php echo e($order->delivery_fees); ?> جنيه</td>
                                </tr>
                                <tr>
                                    <td>إجمالي التكلفة</td>
                                    <td> <?php echo e($order->total_price + $order->delivery_fees); ?> جنيه</td>
                                </tr>
                                <tr>
                                    <td>عمولة الموقع</td>
                                    <td> <?php echo e($order->commission_fees); ?> جنيه</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!-- /row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/orders/show.blade.php ENDPATH**/ ?>