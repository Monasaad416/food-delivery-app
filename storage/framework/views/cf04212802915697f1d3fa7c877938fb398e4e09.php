

<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة مطعم جديد</span>
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

                        <?php $model = app('App\Models\Restaurant'); ?>

                        <?php echo $__env->make('dashboard.inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php
                            $cities = App\Models\City::pluck('name', 'id');
                            $regions = [];
                            $categorois = App\Models\Category::pluck('name', 'id');
                        ?>

                        <?php echo Form::model($model,[
                            'route' => 'dashboard.restaurants.store',
                            'files' =>true,
                            ]); ?>

                                <div class="card-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>الإسم:</strong>
                                            <?php echo Form::text('name', null, array('placeholder' => 'الإسم','class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>البريد الإلكتروني:</strong>
                                            <?php echo Form::text('email', null, array('placeholder' => 'البريد الإلكتروني','class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>كلمة السر:</strong>
                                            <?php echo Form::password('password', array('placeholder' => 'كلمة السر','class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>تأكيد كلمة السر:</strong>
                                            <?php echo Form::password('password_confirmation', array('placeholder' => 'تأكيد كلمة السر','class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <?php echo Form::select('city_id', $cities, null ,
                                            ['class' => 'form-control my-3',
                                            'id' => 'city_id',
                                            'placeholder' => '...إختر المدينة',
                                            ]); ?>

                                        <?php echo Form::select('region_id', $regions, null ,
                                            ['class' => 'form-control my-3',
                                            'placeholder' => '...إختر المنطقة',
                                            ]); ?>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>الحد الأدني للطلب</strong>
                                            <?php echo Form::number('min_order_charge', null, array('placeholder' => 'الحد الادني للطلب','class' => 'form-control','min'=> 0)); ?>

                                        </div>
                                    </div> 
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>رسوم التوصيل</strong>
                                            <?php echo Form::number('delivery_fees', null, array('placeholder' => 'رسوم التوصيل','class' => 'form-control','min'=> 0)); ?>

                                        </div>
                                    </div> 
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>الهاتف</strong>
                                            <?php echo Form::text('phone', null, array('placeholder' => 'الهاتف','class' => 'form-control')); ?>

                                        </div>
                                    </div> 
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>رابط حساب الواتس اب</strong>
                                            <?php echo Form::text('whats_app_url', null, array('placeholder' => 'الهاتف','class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                       


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?php echo Form::file('image'); ?>

                                    </div>



                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                       <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Categories:</strong>
                                                <?php echo Form::select('categories_id[]', $categorois,[], array('class' => 'form-control','multiple')); ?>

                                            </div>
                                        </div>
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




<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/restaurants/create.blade.php ENDPATH**/ ?>