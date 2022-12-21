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

                        <?php $model = app('Spatie\Permission\Models\Permission'); ?>
                        <?php
                            $permissions = Spatie\Permission\Models\Permission::all();
                        ?>

                        <?php echo $__env->make('dashboard.inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo Form::model($model,[
                            'route' => 'dashboard.roles.store',
                            ]); ?>

                            <div class="card-body">
                                <div class="form-group">
                                    <?php echo Form::label('name', 'Name:'); ?>

                                    <?php echo Form::text('name', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter role name...'
                                    ]); ?>

                                </div>

                                <div class="form-group">
                                    <?php echo Form::label('name', 'Select Permissions:'); ?>

                                    <div class="my-1">
                                        <?php echo Form::label( 'all', "Select All",[
                                            'class' => 'mx-1'
                                        ] ); ?>

                                        <?php echo Form::checkbox( "all", "checkedAll",false,[
                                            'id' => 'checkedAll',
                                        ]); ?>


                                    </div>
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="my-1">
                                            <?php echo Form::label( 'label', $permission->name ,[
                                                'class' => 'font-weight-light mx-1',
                                            ]); ?>

                                            <?php echo Form::checkbox( "permission[]", $permission->id ,false,[
                                                'class' => 'checkSingle',
                                            ]); ?>


                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <div class="form-group">
                                    <?php echo Form::submit('Save',[
                                        'class' =>'btn btn-primary btn-flat'
                                    ]); ?>

                                </div>

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
    $(document).ready(function() {
        $("#checkedAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked=true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked=false;
                });
            }
        });

        $(".checkSingle").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;

                $(".checkSingle").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $("#checkedAll").prop("checked", true);
                }
            }
            else {
                $("#checkedAll").prop("checked", false);
            }
        });
    });
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/roles/create.blade.php ENDPATH**/ ?>