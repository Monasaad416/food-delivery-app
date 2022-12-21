<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل البنك </span>
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

                        <?php $model = app('App\Models\Bank'); ?>

                        <?php echo $__env->make('dashboard.inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo Form::model($bank,[
                            'route' => ['banks.update',$bank->id],
                            'method' => 'PATCH',
                            ]); ?>



                                <div class="card-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <?php echo Form::text('name', null, array('placeholder' => 'إسم البنك','class' => 'form-control')); ?>

                                        </div> 
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <?php echo Form::text('account_no', null, array('placeholder' => 'رقم الحساب','class' => 'form-control')); ?>

                                        </div> 
                                    </div>

                                    <?php echo Form::hidden('id', $bank->id); ?>

                                </div>  
            

                                <div class="form-group mx-4">
                                    <?php echo Form::submit('حفظ',[
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




<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/banks/edit.blade.php ENDPATH**/ ?>