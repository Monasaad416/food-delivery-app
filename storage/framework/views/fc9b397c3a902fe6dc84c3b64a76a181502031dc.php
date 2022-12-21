

<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مطعم </span>
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
                        ?>

                        <?php echo Form::model($region,[
                            'route' => ['regions.update',$region->id],
                             'method' => 'PATCH',
                            ]); ?>

                                <div class="card-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>الإسم:</strong>
                                            <?php echo Form::text('name', null, array('placeholder' => 'الإسم','class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <?php echo Form::select('city_id', $cities, $region->city->id ,
                                            ['class' => 'form-control my-3',
                                            'id' => 'city_id',
                                            'placeholder' => '...إختر المدينة',
                                            ]); ?>

                                    </div>
                                     <?php echo Form::hidden('id', $region->id); ?> 
                                    </div>    
                                </div>

                                
                                <div class="form-group">
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




<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/regions/edit.blade.php ENDPATH**/ ?>