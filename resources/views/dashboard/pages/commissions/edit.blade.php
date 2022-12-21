@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل العمولة </span>
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

                        @inject('model','App\Models\PaidCommission')

                        @include('dashboard.inc.errors')

                        @php
                            $restaurants = App\Models\Restaurant::pluck('name', 'id');
                            $banks = App\Models\Bank::pluck('name', 'id');
                        @endphp

                        {!! Form::model($commission,[
                            'route' => ['commissions.update',$commission->id],
                             'method' => 'PATCH',
                            ])
                        !!}
                         <div class="card-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>المطعم:</strong>
                                    {!! Form::select('restaurant_id', $restaurants, null , ['class' => 'form-control my-3', 'id' => 'city_id','placeholder' => '...إختر المطعم', ])!!}
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>المبلغ المدفوع:</strong>
                                    {!! Form::number('paid', null, array('placeholder' => 'المبلغ المدفوع','class' => 'form-control' ,'min' => 0)) !!}
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>تاريخ الدفع:</strong>
                                    {!! Form::date('payment_date',new \DateTime($commission->payment_date), array('placeholder' => 'تاريخ الدفع','class' => 'form-control')) !!}
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>البنك:</strong>
                                    {!! Form::select('bank_id', $banks, null , ['class' => 'form-control my-3','placeholder' => '...إختر البنك', ])!!}
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>ملاحظات:</strong>
                                    {!! Form::text('notes', null, array('placeholder' => 'ملاحظات','class' => 'form-control')) !!}
                                </div> 
            
                                {!!Form::hidden('id', $commission->id)!!}
                    
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






