@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route('home')}}">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المطاعم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

@include("dashboard.inc.message")



<div class="row row-sm">
	<!--div-->
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">قائمة المطاعم</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive hoverable-table">

					<table id="restaurants" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                               <th class="text-center">#</th>
                               <th class="text-center">الإسم</th>
                               <th class="text-center">البريد الالكتروني</th>
                               <th class="text-center">الحد الأدني للطلب</th>
                               <th class="text-center">رسوم التوصيل</th>
                               <th class="text-center">رابط الواتس اب</th>
                               <th class="text-center">الهاتف</th>
                               <th class="text-center">المنطقة</th>
                               <th class="text-center">تغيير الحالة</th>
                               <th class="text-center">الصورة</th>
                               <th class="text-center">عرض</th>
                               <th class="text-center">حذف</th>
                               <th class="text-center">كشف حساب</th>
                            </tr>
                         </thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="change_restaurant_availability_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تغيير حالة العميل</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>


            <form action="{{ route('restaurant.change_availability')}}" method="post" autocomplete="off">
                @csrf
                <h6 class="tx-danger mg-b-20 mx-3 my-3">هل أنت متأكد من عملية تغيير حالة العميل <span  id="name"></span></h6>
                <div class="form-row">
                    <div class="col">
                        <input type="hidden" id="id" name="id">


                    </div>
                </div>
                    <button class="btn btn-primary btn-sm nextBtn btn-lg pull-right mx-3 my-3" type="submit">حفظ التعديل</button>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="delete_restaurant_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20 mx-3 my-3">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h6 class="tx-danger mg-b-20 mx-3 my-3">هل أنت متأكد من عملية الحذف لمطعم  <span id="name"></span></h6>
                <form action="{{ route('restaurant.delete')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right mx-3 my-3" type="submit">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
    $(function() {
        $('#restaurants').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: ['print'],
            ajax: '{!! route('restaurants.list') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'min_order_charge', name: 'min_order_charge' },
                { data: 'delivery_fees', name: 'delivery_fees' },
                { data: 'whats_app_url', name: 'whats_app_url' },
                { data: 'phone', name: 'phone' },
                { data: 'region_id', name: 'region_id' },
                { data: 'change_restaurant_availability', name: 'change_restaurant_availability' },
                { data: 'image',name: 'image', },
                { data: 'show', name: 'show' },
                { data: 'delete', name: 'delete' },
                { data: 'balance_sheet', name: 'balance_sheet' },
            ]
        });




        $('#restaurants tbody').on('click','#delete_btn',function(){
            var id = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            console.log(id);
            $('#delete_restaurant_modal #id').val(id);
            $('#delete_restaurant_modal #name').text(name);
        });

        $('#restaurants tbody').on('click','#change_restaurant_availability_btn',function(){
            var id = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            console.log(name);
            $('#change_restaurant_availability_modal #id').val(id);
            $('#change_restaurant_availability_modal #name').text(name);
        });
    });
    </script>
@endpush



