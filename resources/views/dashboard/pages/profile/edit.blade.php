@extends('dashboard.layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route('home')}}">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الملف الشخصي</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
            <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    @inject('model','App\Models\User')

                    @include('dashboard.inc.errors')
                    @include('dashboard.inc.message')


                    {!! Form::model($loggedAdmin,[
                        'route' => ['profile.update'],
                        ])
                    !!}
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::text('name', null, array('placeholder' => 'الإسم','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::text('email', null, array('placeholder' => 'البريد الإلكتروني','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="كلمة السر">
                                </div>
                            </div>

                           <div class="col-12">
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة السر">
                                </div>
                            </div>
                                {!!Form::hidden('id', $loggedAdmin->id)!!}
                        </div>

                        <div class="form-group mx-4">
                            {!!Form::submit('حفظ ',[
                                'class' =>'btn btn-primary btn-flat'
                            ])!!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection
