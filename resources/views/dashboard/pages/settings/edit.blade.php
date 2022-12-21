@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الإعدادات </span>
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

                        @inject('model','App\Models\Setting')

                        @include('dashboard.inc.errors')
                        @include("dashboard.inc.message")

                            {!! Form::model($settings,[
                                'route' => 'settings.update',
                                'method' => 'post'
                                ]) !!}
                            <div class="card-body">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {!! Form::text('email', null, array('placeholder' => 'البريد الإلكتروني','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {!! Form::text('about_us', $settings->about_us ,array('placeholder' => 'عن الموقع','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {!! Form::number('app_commission', null, array('placeholder' => 'عمولة الموقع ','class' => 'form-control','min'=> 0)) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {!! Form::text('commission_text', null, array('placeholder' => 'نص العمولة','class' => 'form-control','min'=> 0)) !!}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mx-4">
                                {!!Form::submit('حفظ',[
                                    'class' =>'btn btn-primary btn-flat mx-4'
                                ])!!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



