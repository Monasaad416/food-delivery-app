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
                        @endphp

                        {!! Form::model($region,[
                            'route' => ['regions.update',$region->id],
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
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        {!! Form::select('city_id', $cities, $region->city->id ,
                                            ['class' => 'form-control my-3',
                                            'id' => 'city_id',
                                            'placeholder' => '...إختر المدينة',
                                            ])
                                        !!}
                                    </div>
                                     {!!Form::hidden('id', $region->id)!!} 
                                    </div>    
                                </div>

                                
                                <div class="form-group">
                                    {!!Form::submit('Save',[
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



