

<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('إضافة-بنك')): ?>
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة بنك جديد</span>
            </div> 
        <?php endif; ?>

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

                        <?php $model = app('App\Models\City'); ?>

                        <?php echo $__env->make('dashboard.inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo Form::model($model,[
                            'route' => 'banks.store',
                            'files' =>true,
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




<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/banks/create.blade.php ENDPATH**/ ?>