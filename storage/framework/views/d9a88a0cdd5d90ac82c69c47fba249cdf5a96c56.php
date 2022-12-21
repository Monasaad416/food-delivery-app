<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> اهلا <?php echo e(auth()->user()->name); ?></h2>
                <p class="mg-b-0">لوحة تحكم الموقع .</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">إجمالي الطلبات المستلمة</label>
                <h5><?php echo e(number_format($orders->where('status',4)->sum('total_price'))); ?> جنية</h5>
            </div>
            <div>
                <label class="tx-13">إجمالي الطلبات المرفوضة</label>
                <h5><?php echo e(number_format($orders->where('status',5)->sum('total_price'))); ?> جنية</h5>
            </div>
            <div>
                <label class="tx-13">إجمالي عمولات الموقع</label>
                <h5><?php echo e(number_format($commissions->sum('paid'))); ?> جنية</h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<!-- row -->
    <?php echo $__env->make("dashboard.inc.message", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="row row-sm">
		<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
			<div class="card overflow-hidden sales-card bg-primary-gradient">
				<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
					<div class="">
						<h6 class="mb-3 tx-12 text-white">طلبات اليوم</h6>
					</div>
					<div class="pb-0 mt-0">
						<div class="d-flex">
							<div class="">
								<h4 class="tx-20 font-weight-bold mb-1 text-white"><?php echo e($orders->where('created_at',date('Y-m-d H:i:s'))->sum('total_price')); ?> جنية</h4>
								
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
			<div class="card overflow-hidden sales-card bg-danger-gradient">
				<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
					<div class="">
						<h6 class="mb-3 tx-12 text-white">عدد المطاعم</h6>
					</div>
					<div class="pb-0 mt-0">
						<div class="d-flex">
							<div class="">
								<h4 class="tx-20 font-weight-bold mb-1 text-white"><?php echo e($restaurants->count()); ?> مطعم</h4>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
			<div class="card overflow-hidden sales-card bg-warning-gradient">
				<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
					<div class="">
						<h6 class="mb-3 tx-12 text-white">عدد العملاء</h6>
					</div>
					<div class="pb-0 mt-0">
						<div class="d-flex">
							<div class="">
								<h4 class="tx-20 font-weight-bold mb-1 text-white"><?php echo e($clients->count()); ?>  عميل</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
			<div class="card overflow-hidden sales-card bg-success-gradient">
				<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
					<div class="">
						<h6 class="mb-3 tx-12 text-white">عمولات اليوم</h6>
					</div>
					<div class="pb-0 mt-0">
						<div class="d-flex">
							<div class="">
								<h4 class="tx-20 font-weight-bold mb-1 text-white"><?php echo e($commissions->where('payment_date',date('Y-m-d H:i:s'))->sum('total_price')); ?>  جنية</h4>
							</div>
							<span class="float-right my-auto mr-auto">

								<?php if($commissions->where('payment_date',Carbon\Carbon::yesterday())->sum('total_price') !== 0 ): ?>
									<i class="fas fa-arrow-circle-up text-white"></i>
									<span class="text-white op-7"><?php echo e($orders->where('created_at',date('Y-m-d H:i:s'))->sum('total_price') / $orders->where('created_at',Carbon\Carbon::yesterday())->sum('total_price') * 100); ?></span>
								<?php endif; ?>
							</span>
						</div>
					</div>
				</div>
				<span id="compositeline3" class="pt-1"></span>
			</div>
		</div>
	</div>

	<div class="row ">
		<div class="w-100">
			<div class="card">
				<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mb-0">إجمالي الطلبات</h4>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div>
					<p class="tx-12 text-muted mb-0">وفقا لحالة الطلب</p>
				</div>
				<div class="card-body">
					<div class="total-revenue">
						<div>
							<h4><?php echo e($orders->where('status',1)->sum('total_price')); ?>جنيه</h4>
							<label><span class="bg-secondary"></span>تحت الموافقة</label>
						</div>
						<div>
							<h4><?php echo e($orders->where('status',2)->sum('total_price')); ?>جنيه</h4>
							<label><span class="bg-primary"></span>تمت الموافقة</label>
						</div>
						<div>
							<h4><?php echo e($orders->where('status',3)->sum('total_price')); ?>جنيه</h4>
							<label><span class="bg-danger"></span>مرفوضة</label>
						</div>
						<div>
							<h4><?php echo e($orders->where('status',4)->sum('total_price')); ?>جنيه</h4>
							<label><span class="bg-success"></span>مستلمة</label>
							</div>
							<div>
							<h4><?php echo e($orders->where('status',5)->sum('total_price')); ?>جنيه</h4>
							<label><span class="bg-warning"></span>مرتجعه</label>
							</div>
						</div>
					<div id="bar" class="sales-bar mt-4"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row row-sm">
		<div class="col-xl-4 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header pb-1">
					<h3 class="card-title mb-2">عمولة المطاعم</h3>
					<p class="tx-12 mb-0 text-muted">مطاعم قامت بتسديد العمولة حديثا</p>
				</div>
				<?php
					$latestCommissions = App\Models\PaidCommission::latest()->take(4)->get();
				?>
				<div class="card-body p-0 customers mt-1">
					<div class="list-group list-lg-group list-group-flush">
						<?php $__currentLoopData = $latestCommissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<div class="list-group-item list-group-item-action br-br-7 br-bl-7" href="#">
								<div class="media mt-0">
									<img class="avatar-lg rounded-circle ml-3 my-auto" src="<?php echo e(url("uploads") ."/". $commission->restaurant->image); ?>" alt="<?php echo e($commission->restaurant->name); ?>">
									<div class="media-body">
										<div class="d-flex align-items-center">
											<div class="mt-1">
												<h5 class="mb-1 tx-15"><?php echo e($commission->restaurant->name); ?></h5>
												<p class="b-0 tx-13 text-muted mb-0"><span class="text-success ml-2"> المدفوع:</span><?php echo e($commission->paid); ?> جنيه</p>
											</div>
											<span class="mr-auto wd-45p fs-16 mt-2">
												<div id="spark5" class="wd-100p"></div>
											</span>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-12 col-lg-6">
			<div class="card">
				<div class="card-header pb-1">
					<h3 class="card-title mb-2">حركة المبيعات</h3>
					<p class="tx-12 mb-0 text-muted">إجمالي المبيعات والأرباح وعمولة الموقع</p>
				</div>
				<div class="product-timeline card-body pt-2 mt-1">
					<ul class="timeline-1 mb-0">
						<li class="mt-0"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">أجمالي المبيعات : </span> <a href="#" class="float-left tx-11 text-muted"><?php echo e(Carbon\Carbon::parse(App\Models\Order::latest()->first()->created_at)->format('d M ,Y')); ?> اخر تحديث</a>
							<p class="mb-0 text-muted tx-12"><?php echo e($orders->sum('total_price')); ?> جنية</p>
						</li>
						<li class="mt-0"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 "> العمولات المدفوعة :</span> <a href="#" class="float-left tx-11 text-muted"><?php echo e(Carbon\Carbon::parse(App\Models\PaidCommission::latest()->first()->created_at)->format('d M ,Y')); ?> اخر تحديث</a>
							<p class="mb-0 text-muted tx-12"><?php echo e(App\Models\PaidCommission::sum('paid')); ?> جنية</p>
						</li>
						<li class="mt-0"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">إجمالي العمولات :<span class="font-weight-semibold mb-4 tx-14 "></span> <a href="#" class="float-left tx-11 text-muted"><?php echo e(Carbon\Carbon::parse(App\Models\Order::latest()->first()->created_at)->format('d M ,Y')); ?> اخر تحديث</a>
							<p class="mb-0 text-muted tx-12"><?php echo e($orders->sum('total_price') * $settings->app_commission /100); ?> جنية</p>
						</li>
						<li class="mt-0 mb-0"> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">التقييمات</span> <a href="#" class="float-left tx-11 text-muted"><?php echo e(Carbon\Carbon::parse(App\Models\Review::latest()->first()->created_at)->format('d M ,Y')); ?> اخر تحديث</a>
							<p class="mb-0 text-muted tx-12"><?php echo e(App\Models\Review::count()); ?> تقييم :</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-12 col-lg-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title mb-2">الطلبات الحالية</h3>
					<p class="tx-12 mb-0 text-muted">طلبات تحت الموافقة وطلبات تمت الموافقة عليها وتحت التجهيز</p>
				</div>
				<div class="card-body sales-info">
					<div id="chart" class="ht-150"></div>
					<div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p">
						<div class="col-md-6 col">
							<p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>تحت الموافقة </p>
							<h3 class="mb-1"><?php echo e($orders->where('status',1)->count()); ?> طلب</h3>
						</div>
						<div class="col-md-6 col">
							<p class="mb-0 d-flex"><span class="legend bg-info brround"></span> جاري تجهيزها</p>
							<h3 class="mb-1"><?php echo e($orders->where('status',2)->count()); ?> طلب</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row row-sm row-deck">
		<div class="col-md-12 col-lg-4 col-xl-4">
			<div class="card card-dashboard-eight pb-2">
				<h6 class="card-title">العملاء المميزين</h6><span class="d-block mg-b-10 text-muted tx-12">اكثر العملاء طلبا</span>
                <?php
                    $repeated = App\Models\Order::latest()->select('client_id','total_price')->get();
                    $clients = $orders->pluck('client_id')->toArray();
                    $vals = array_count_values($clients);

                    arsort($vals);
                    $all_ids = array_keys($vals);
                    $ids = array_slice($all_ids,0,5);
                    $topClients = App\Models\Client::whereIn('id',$ids)->get();
                ?>
                <div class="list-group">
                    <?php $__currentLoopData = $topClients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topClient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item border-top-0">
                            <p><?php echo e($topClient->name); ?></p><span><?php echo e($topClient->orders->count()); ?> طلب</span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                </div>
			</div>
		</div>
		<div class="col-md-12 col-lg-8 col-xl-8">
			<div class="card card-table-two">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mb-1">حالة الطلبات</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				<span class="tx-12 tx-muted mb-3 ">تتبع حالة الطلبات</span>
				<div class="table-responsive country-table">
					<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
						<thead>
							<tr>
								<th class="wd-lg-20p">تحت الموافقة</th>
								<th class="wd-lg-20p tx-right">تحت التجهير</th>
								<th class="wd-lg-20p tx-right">مرفوض</th>
								<th class="wd-lg-20p tx-right">تم التسليم </th>
								<th class="wd-lg-20p tx-right">تم الإسترجاع</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo e($orders->where('status',1)->count()); ?> طلب</td>
								<td class="tx-right tx-medium tx-inverse"><?php echo e($orders->where('status',2)->count()); ?> طلب</td>
								<td class="tx-right tx-medium tx-danger"><?php echo e($orders->where('status',3)->count()); ?> طلب</td>
								<td class="tx-right tx-medium tx-inverse"><?php echo e($orders->where('status',4)->count()); ?> طلب</td>
								<td class="tx-right tx-medium tx-danger"><?php echo e($orders->where('status',5)->count()); ?> طلب</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Container closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravelprojects\sofra-app\resources\views/dashboard/pages/index.blade.php ENDPATH**/ ?>