<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة مستخدم جديد</span>
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

                        <?php $model = app('App\Models\User'); ?>

                        <?php echo $__env->make('dashboard.inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                        <?php echo Form::model($model,[
                            'route' => 'users.store',
                            ]); ?>

                                <div class="card-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <?php echo Form::text('name', null, array('placeholder' => 'الإسم','class' => 'form-control')); ?>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <?php echo Form::text('email', null, array('placeholder' => 'البريد الإلكتروني','class' => 'form-control')); ?>

                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <?php echo Form::password('password', array('placeholder' => 'كلمة السر','class' => 'form-control')); ?>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <?php echo Form::password('confirm-password', array('placeholder' => 'تأكيد كلمة السر','class' => 'form-control')); ?>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <?php echo Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')); ?>

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




<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/users/create.blade.php ENDPATH**/ ?>