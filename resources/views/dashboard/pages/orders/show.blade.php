@extends('dashboard.layouts.master')
@section('page-header')
    <!-- breadcrumb -->

        <div class="my-auto">
            <div class="d-flex my-4">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الطلب</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        بيانات الطلب
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table-reference text-nowrap mb-0 mg-t-5">
                            <thead>
                                <tr>
                                    <th class="wd-30p">البند</th>
                                    <th class="wd-70p">التفاصيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>إسم العميل</td>
                                    <td> <a href = "{{route('client.orders',['client_id' =>$order->client->id])}}" >{{$order->client->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>إسم المطعم</td>
                                    <td> <a href = "{{route('restaurant.orders',$order->restaurant->id)}}" >{{$order->restaurant->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>العنوان</td>
                                    <td> {{$order->address}}</td>
                                </tr>
                                <tr>
                                    <td>طريقة الدفع</td>
                                    <td> {{$order->payment_method->name}}</td>
                                </tr>
                                <tr>
                                    <td>حالة الطلب</td>
                                    <td> {{$order->label()}}</td>
                                </tr>
                                <tr>
                                    <td>ملاحظات</td>
                                    <td class="text-danger"> {{$order->notes ? $order->notes : 'لايوجد ملاحظات علي الطلب'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        تفاصيل البنود
                    </div>

                    <div class="table-responsive">
                        <table class="table main-table-reference text-nowrap mb-0 mg-t-5">
                            <thead>
                                <tr>
                                    <th class="wd-20p">البند</th>
                                    <th class="wd-20p">سعر الوحدة </th>
                                    <th class="wd-20p">الكميه</th>
                                    <th class="wd-20p">إجمالي البند</th>
                                    <th class="wd-20p">إضافات خاصة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $key => $orderItem)
                                    <tr>
                                    {{-- {{dd($orderItem)}} --}}
                                        <td>{{$orderItem->name}}</td>
                                        <td>{{$orderItem->pivot->qty}}</td>
                                        <td>{{$orderItem->pivot->item_price}}</td>
                                        <td>{{$orderItem->pivot->total_price}}</td>
                                        <td>{{$orderItem->pivot->add_special}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                         التكلفة
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table-reference text-nowrap mb-0 mg-t-5">
                            <thead>
                                <tr>
                                    <th class="wd-30p">البند</th>
                                    <th class="wd-70p">السعر</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>تكلفة  البنود</td>
                                    <td> {{$order->total_price}} جنيه</td>
                                </tr>
                                <tr>
                                    <td>رسوم التوصيل</td>
                                    <td> {{$order->delivery_fees}} جنيه</td>
                                </tr>
                                <tr>
                                    <td>إجمالي التكلفة</td>
                                    <td> {{$order->total_price + $order->delivery_fees }} جنيه</td>
                                </tr>
                                <tr>
                                    <td>عمولة الموقع</td>
                                    <td> {{$order->commission_fees}} جنيه</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!-- /row -->
@endsection
