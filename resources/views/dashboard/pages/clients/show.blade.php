@extends('dashboard.layouts.master')
@section('page-header')
    <!-- breadcrumb -->

        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل المطعم</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body h-100">
                    <div class="row row-sm ">
                        <div class=" col-xl-5 col-lg-12 col-md-12">
                            <img src="{{url("uploads/". $restaurant->image)}}" class="img-fluid" alt="image"/>
                        </div>
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                            <h4 class="product-title mb-1">{{$restaurant->name}}</h4>
                            <p class="text-muted tx-13 mb-1">{{$restaurant->email}}</p>
                            <div class="rating mb-1">
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star text-muted"></span>
                                    <span class="fa fa-star text-muted"></span>
                                </div>
                                <span class="review-no">{{$restaurant->reviews()->count()}} تقييم</span>
                            </div>
                            <p class="product-description"><strong>المنطقة: </strong> {{$restaurant->region->name}}</p>
                            <p class="product-description"><strong>الحد الأدني للطلب : </strong>{{$restaurant->min_order_charge}} جنيه</p>
                            <p class="product-description"><strong>  رسوم التوصيل: </strong> {{$restaurant->delivery_fees}} جنيه</p>
                            <p class="product-description"><strong>رابط حساب الواتس اب: </strong> <a href="{{$restaurant->whats_app_url}}" target="_blank">{{$restaurant->whats_app_url}}</a></p>
                            <p class="product-description"><strong>الهاتف: </strong> {{$restaurant->phone}}</p>
                            <p class="product-description"><strong>حالة المطعم : </strong>
                                <span class="text-{{$restaurant->availability ? 'success' : 'danger'}}">
                                    {{$restaurant->availability ? 'مفتوح' : 'مغلق'}}
                                </span>
                            </p>

                            <p class="product-description">
                                <strong>التصنيفات :   </strong>
                                <ul>
                                    @foreach ($restaurant->categories as $cat)
                                        <li class="mx-3">{{$cat->name}}</li>
                                    @endforeach
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

        @foreach ($offers as $offer )
            <div class="col-lg-3 ">
                <div class="card item-card ">
                    <div class="card-body pb-0 h-100">
                        <div class="text-center">
                            <img src="{{url('uploads/'. $offer->image)}}" alt="img" class="img-fluid" >
                        </div>
                        <div class="card-body cardbody relative">
                            <div class="cardtitle">
                                <h5>{{$offer->name}}</h5>
                                <p>{{$offer->description}}</p>
                            </div>
                            <div >
                                <strong>من تاريخ :</strong><span>{{$offer->from_date}}</span>
                                <br>
                                <strong>إلي تاريخ :</strong><span>{{$offer->to_date}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-left mx-4 my-2">
        <button class="btn btn-primary-gradient">عرض المزيد</button>
    </div>

    <!-- offes end -->
    <!-- items-->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto mx-3">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الوجبات</h4>
            </div>
        </div>
    </div>
    <div class="row mx-2">
        @foreach ($items as $item )
            <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="pro-img-box">
                            <div class="d-flex product-sale">
                                @if(App\Models\Item::whereBetween('created_at', [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()->subMonth()->endOfMonth()])->first() )
                                    <div class="badge bg-info">New</div>
                                @endif
                            </div>

                            <img class="w-100" src="{{url('uploads/'. $item->image)}}" alt="item-image">
                            </a>
                        </div>
                        <div class="text-center pt-3">
                            <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{$item->name}}</h3>
                            <span class="tx-15 ml-auto">
                                <i class="ion ion-md-star text-warning"></i>
                                <i class="ion ion-md-star text-warning"></i>
                                <i class="ion ion-md-star text-warning"></i>
                                <i class="ion ion-md-star-half text-warning"></i>
                                <i class="ion ion-md-star-outline text-warning"></i>
                            </span>
                            @if($item->discount_price > 0)
                                <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">${{$item->discount_price}} <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$120</span></h4>
                            @else
                                <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-secondary">${{$item->price}}</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-left mx-4 my-2">
        <button class="btn btn-primary-gradient">عرض المزيد</button>
    </div>
    <!-- items end -->

    
@endsection
