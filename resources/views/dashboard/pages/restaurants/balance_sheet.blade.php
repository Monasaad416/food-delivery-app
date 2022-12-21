@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route('home')}}">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كشف حساب</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

@include("inc.message")



<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"> كشف حساب المطعم : {{$restaurant->name}}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <tbody>
                            <tr>
                                <td class="text-center h5">إجمالي تكلفة الطلبات</td>
                                <td class="text-center">{{$totalOrders}}</td>
                            </tr>   
                            <tr>
                            
                            <td class="text-center h5">إجمالي عمولة الموقع</td> 
                            <td class="text-center">{{$totalCommessions}}</td>
                            </tr>
                            <tr>
                                <td class="text-center h5">إجمالي ماتم دفعه </td>
                                <td class="text-center"> {{$totalPayments}}</td>
                            </tr>
                            <tr>   
                                <td class="text-center h5">أجمالي المتبقي </td> 
                                <td class="text-center">{{$remainning}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
{{--
@push('scripts')
    <script>
    $(function() {
        $('#restaurants').DataTable({
            processing: true,
            serverSide: true,
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
                { data: 'availability', name: 'availability' },
                { data: 'image',name: 'image', },

                { data: 'show', name: 'show' },
                { data: 'edit', name: 'edit' },
                { data: 'delete', name: 'delete' },
                { data: 'balance_sheet', name: 'balance_sheet' },
            ]
        });


        $('#restaurants tbody').on('click','#delete_btn',function(){
            var id = $(tdis).attr("data-id");
            console.log(id);
            $('#delete_restaurant_modal #id').val(id);
        });
    });
    </script>
@endpush --}}



