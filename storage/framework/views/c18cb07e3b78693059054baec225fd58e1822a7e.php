<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->

        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل المطعم</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card my-3">
                <div class="card-body h-100">
                    <div class="row row-sm ">
                        <div class=" col-xl-5 col-lg-12 col-md-12">
                            <img src="<?php echo e(url("uploads/". $restaurant->image)); ?>" width="80%" height="80%" alt="image"/>
                        </div>
                        <?php
                            $rating = $reviews->sum('rating');//14
                            $noOfReviews = $reviews->count();//4
                            $average = $rating/$noOfReviews;//14/4 = 3.5
                        ?>
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                            <h4 class="product-title mb-1"><?php echo e($restaurant->name); ?></h4>
                            <p class="text-muted tx-13 mb-1"><?php echo e($restaurant->email); ?></p>
                            <div class="rating mb-1">
                                <div class="stars">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <?php if(floor($average) - $i >= 1): ?>
                                        
                                        <i class="fas fa-star text-warning"> </i>
                                    <?php elseif($average - $i > 0): ?>
                                        
                                        <i class="fas fa-star-half-alt text-warning"> </i>
                                    <?php else: ?>
                                        
                                        <i class="far fa-star text-muted"> </i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                                <span class="review-no"><?php echo e($reviews->count()); ?> تقييم</span>
                            </div>
                            <p class="product-description"><strong>المنطقة: </strong> <?php echo e($restaurant->region->name); ?></p>
                            <p class="product-description"><strong>الحد الأدني للطلب : </strong><?php echo e($restaurant->min_order_charge); ?> جنيه</p>
                            <p class="product-description"><strong>  رسوم التوصيل: </strong> <?php echo e($restaurant->delivery_fees); ?> جنيه</p>
                            <p class="product-description"><strong>رابط حساب الواتس اب: </strong> <a href="<?php echo e($restaurant->whats_app_url); ?>" target="_blank"><?php echo e($restaurant->whats_app_url); ?></a></p>
                            <p class="product-description"><strong>الهاتف: </strong> <?php echo e($restaurant->phone); ?></p>
                            <p class="product-description"><strong>حالة المطعم : </strong>
                                <span class="text-<?php echo e($restaurant->availability ? 'success' : 'danger'); ?>">
                                    <?php echo e($restaurant->availability ? 'مفتوح' : 'مغلق'); ?>

                                </span>
                            </p>

                            <p class="product-description">
                                <strong>التصنيفات :   </strong>
                                <ul>
                                    <?php $__currentLoopData = $restaurant->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="mx-3"><?php echo e($cat->name); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->


    <!-- offers-->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto mx-2">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">العروض الحالية</h4>
                </div>
            </div>
        </div>
    <div class="row mx-2">
        <?php if(count($offers) > 0): ?>
            <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 ">
                    <div class="card item-card ">
                        <div class="card-body pb-0 h-100">
                            <div class="text-center h-25">
                                <img src="<?php echo e(url('uploads/'. $offer->image)); ?>" alt="img" width="100%" height="150px">
                            </div>
                            <div class="card-body cardbody relative">
                                <div class="cardtitle">
                                    <h5><?php echo e($offer->name); ?></h5>
                                    <p><?php echo e($offer->description); ?></p>
                                </div>
                                <div >
                                    <strong>من تاريخ :</strong><span><?php echo e($offer->from_date); ?></span>
                                    <br>
                                    <strong>إلي تاريخ :</strong><span><?php echo e($offer->to_date); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php if(count($items) > 4): ?>
                    <div class="text-left mx-4 my-2">
                        <button class="btn btn-primary-gradient">عرض الكل</button>
                    </div> 
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <div class="col-12">
                    <div class="card item-card ">
                        <div class="card-body pb-0 h-100">
                            <div class="text-center">
                                <p class="text-danger font-weight-bold">عفوا لايوجد عروض في الوقت الحالي </p>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endif; ?>   
        
          
     
    </div>


    <!-- offes end -->
    <!-- items-->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto mx-3">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الطعام</h4>
            </div>
        </div>
    </div>
    
    <div class="row mx-2">
        <?php if(count($items) > 0): ?>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="pro-img-box">
                                <div class="d-flex product-sale">
                                    <?php if(App\Models\Item::whereBetween('created_at', [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()->subMonth()->endOfMonth()])->first() ): ?>
                                        <div class="badge bg-info">New</div>
                                    <?php endif; ?>
                                </div>

                                <img  src="<?php echo e(url('uploads/'. $item->image)); ?>" width="100%" height="200px" alt="item-image">
                                </a>
                            </div>
                            <div class="text-center pt-3">
                                <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase"><?php echo e($item->name); ?></h3>
                                <span class="tx-15 ml-auto">
                                    <i class="ion ion-md-star text-warning"></i>
                                    <i class="ion ion-md-star text-warning"></i>
                                    <i class="ion ion-md-star text-warning"></i>
                                    <i class="ion ion-md-star-half text-warning"></i>
                                    <i class="ion ion-md-star-outline text-warning"></i>
                                </span>
                                <?php if($item->discount_price > 0): ?>
                                    <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$<?php echo e($item->discount_price); ?> <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$120</span></h4>
                                <?php else: ?>
                                    <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-secondary">$<?php echo e($item->price); ?></h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(count($items) > 3): ?>
                    <div class="text-left mx-4 my-2">
                        <button class="btn btn-primary-gradient">عرض الكل</button>
                    </div> 
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="col-12">
                <div class="card item-card ">
                    <div class="card-body pb-0 h-100">
                        <div class="text-center">
                            <p class="text-danger font-weight-bold">عفوا لايوجد وجبات في الوقت الحالي </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>   
    </div>
    <!-- items end -->

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/restaurants/show.blade.php ENDPATH**/ ?>