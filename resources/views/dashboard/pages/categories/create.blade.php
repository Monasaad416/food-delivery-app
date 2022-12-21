@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة تصنيف جديد</span>
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

                        @inject('model','App\Models\City')

                        @include('dashboard.inc.errors')

                        {!! Form::model($model,[
                            'route' => 'categories.store',
                            'files' =>true,
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

                                <div class="form-group mx-4 mb-4">
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



