

<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة عمولة جديد</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <?php $model = app('App\Models\PaidCommission'); ?>
                        <?php
                            $restaurants = App\Models\Restaurant::pluck('name', 'id');
                            $banks = App\Models\Bank::pluck('name', 'id');
                        ?>

                        <?php echo $__env->make('dashboard.inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo Form::model($model,[
                            'route' => 'dashboard.commissions.store',
                            ]); ?>

                                <div class="card-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>المطعم:</strong>
                                            <?php echo Form::select('restaurant_id', $restaurants, null , ['class' => 'form-control my-3','placeholder' => '...إختر المطعم', ]); ?>

                                        </div> 
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>المبلغ المدفوع:</strong>
                                            <?php echo Form::number('paid', null, array('placeholder' => 'المبلغ المدفوع','class' => 'form-control' ,'min' => 0)); ?>

                                        </div> 
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>تاريخ الدفع:</strong>
                                            <?php echo Form::date('payment_date', null, array('placeholder' => 'تاريخ الدفع','class' => 'form-control')); ?>

                                        </div> 
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>البنك:</strong>
                                            <?php echo Form::select('bank_id', $banks, null , ['class' => 'form-control my-3','placeholder' => '...إختر البنك', ]); ?>

                                        </div> 
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>ملاحظات:</strong>
                                            <?php echo Form::text('notes', null, array('placeholder' => 'ملاحظات','class' => 'form-control')); ?>

                                        </div> 
                                    </div>
                                </div>    

                                <div class="form-group mx-4 mb-4">
                                    <?php echo Form::submit('Save',[
                                        'class' =>'btn btn-primary btn-flat'
                                    ]); ?>

                                </div>

                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('select[name="city_id"]').on('change', function () {
                var city_id = $(this).val();
                if (city_id) {
                    $.ajax({
                        url: "<?php echo e(URL::to('/dashboard/regions-by-city')); ?>/" + city_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="region_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="region_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>




<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/commissions/create.blade.php ENDPATH**/ ?>