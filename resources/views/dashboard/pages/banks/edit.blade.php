@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل البنك </span>
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

                        @inject('model','App\Models\Bank')

                        @include('dashboard.inc.errors')

                        {!! Form::model($bank,[
                            'route' => ['banks.update',$bank->id],
                            'method' => 'PATCH',
                            ])
                        !!}


                                <div class="card-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            {!! Form::text('name', null, array('placeholder' => 'إسم البنك','class' => 'form-control')) !!}
                                        </div> 
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            {!! Form::text('account_no', null, array('placeholder' => 'رقم الحساب','class' => 'form-control')) !!}
                                        </div> 
                                    </div>

                                    {!!Form::hidden('id', $bank->id)!!}
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



