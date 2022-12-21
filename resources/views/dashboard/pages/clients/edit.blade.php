@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مطعم </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        @inject('model','App\Models\Restaurant')

                        @include('dashboard.inc.errors')

                        @php
                            $cities = App\Models\City::pluck('name', 'id');
                            $categories = App\Models\Category::pluck('name', 'id');
                            $regions = App\Models\Region::pluck('name','id');

                        @endphp

                        {!! Form::model($restaurant,[
                            'route' => ['restaurants.update',$restaurant->id],
                            'files' =>true,
                             'method' => 'PATCH',
                            ])
                        !!}
                                <div class="card-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>الإسم:</strong>
                                            {!! Form::text('name', null, array('placeholder' => 'الإسم','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>البريد الإلكتروني:</strong>
                                            {!! Form::text('email', null, array('placeholder' => 'البريد الإلكتروني','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>كلمة السر:</strong>
                                            {!! Form::password('password', array('placeholder' => 'كلمة السر','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>تأكيد كلمة السر:</strong>
                                            {!! Form::password('password_confirmation', array('placeholder' => 'تأكيد كلمة السر','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        {!! Form::select('city_id', $cities, $restaurant->region->city->id ,
                                            ['class' => 'form-control my-3',
                                            'id' => 'city_id',
                                            'placeholder' => '...إختر المدينة',
                                            ])
                                        !!}
                    
                                        {!! Form::select('region_id', $regions, $restaurant->region->id  ,
                                            ['class' => 'form-control my-3',
                                            'placeholder' => '...إختر المنطقة',
                                            ])
                                        !!}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>الحد الأدني للطلب</strong>
                                            {!! Form::number('min_order_charge', null, array('placeholder' => 'الحد الادني للطلب','class' => 'form-control','min'=> 0)) !!}
                                        </div>
                                    </div> 
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>رسوم التوصيل</strong>
                                            {!! Form::number('delivery_fees', null, array('placeholder' => 'رسوم التوصيل','class' => 'form-control','min'=> 0)) !!}
                                        </div>
                                    </div> 
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>الهاتف</strong>
                                            {!! Form::text('phone', null, array('placeholder' => 'الهاتف','class' => 'form-control')) !!}
                                        </div>
                                    </div> 
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>رابط حساب الواتس اب</strong>
                                            {!! Form::text('whats_app_url', null, array('placeholder' => 'الهاتف','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                       


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        {!!Form::file('image')!!}
                                    </div>



                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                       <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Categories:</strong>
                                                {!! Form::select('categories_id[]', $categories,$restaurant->categories->pluck('id','name'), array('class' => 'form-control','multiple')) !!}
                                            </div>
                                        </div>
                                    </div>   


                                     {!!Form::hidden('id', $restaurant->id)!!} 

                     
                                    </div>    
                                </div>

                                
                                <div class="form-group mx-4">
                                    {!!Form::submit('حفظ',[
                                        'class' =>'btn btn-primary btn-flat'
                                    ])!!}
                                </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection





@push('scripts')
    <script>
        $(document).ready(function () {
            $('select[name="city_id"]').on('change', function () {
                var city_id = $(this).val();
                if (city_id) {
                    $.ajax({
                        url: "{{ URL::to('/dashboard/regions-by-city') }}/" + city_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="region_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="region_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endpush



