@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route('home')}}">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طلبات العميل </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

@include("dashboard.inc.message")



<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"> طلبات العميل : {{$client->name}}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">العمبل</th>
                            <th class="text-center">المطعم</th>
                            <th class="text-center">العنوان </th>
                            <th class="text-center">طريقة الدفع</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">إجمالي المبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $order)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <th>{{$order->client->name}}</th>
                                <td>{{$order->restaurant->name}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->payment_method->name}}</td>
                                <td>{{$order->label()}}</td>
                                <td>{{$order->total_price}}</td>
                            </tr>
                            
                        @endforeach
                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>			
</div>
@endsection




