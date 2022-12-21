<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="<?php echo e(route('home')); ?>">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الملف الشخصي</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
            <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <?php $model = app('App\Models\User'); ?>

                    <?php echo $__env->make('dashboard.inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('dashboard.inc.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    <?php echo Form::model($loggedAdmin,[
                        'route' => ['profile.update'],
                        ]); ?>

                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <?php echo Form::text('name', null, array('placeholder' => 'الإسم','class' => 'form-control')); ?>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php echo Form::text('email', null, array('placeholder' => 'البريد الإلكتروني','class' => 'form-control')); ?>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="كلمة السر">
                                </div>
                            </div>

                           <div class="col-12">
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة السر">
                                </div>
                            </div>
                                <?php echo Form::hidden('id', $loggedAdmin->id); ?>

                        </div>

                        <div class="form-group mx-4">
                            <?php echo Form::submit('حفظ ',[
                                'class' =>'btn btn-primary btn-flat'
                            ]); ?>

                        </div>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/profile/edit.blade.php ENDPATH**/ ?>