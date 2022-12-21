@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة مطعم جديد</span>
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

                        @inject('model', 'Spatie\Permission\Models\Permission')
                        @php
                            $permissions = Spatie\Permission\Models\Permission::all();
                        @endphp

                        @include('dashboard.inc.errors')

                        {!! Form::model($model,[
                            'route' => 'roles.store',
                            ])
                        !!}
                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::label('name', 'Name:')!!}
                                    {!!Form::text('name', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter role name...'
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name', 'Select Permissions:')!!}
                                    <div class="my-1">
                                        {!!Form::label( 'all', "Select All",[
                                            'class' => 'mx-1'
                                        ] )!!}
                                        {!!Form::checkbox( "all", "checkedAll",false,[
                                            'id' => 'checkedAll',
                                        ])!!}

                                    </div>
                                    @foreach ($permissions as $permission)
                                        <div class="my-1">
                                            {!!Form::label( 'label', $permission->name ,[
                                                'class' => 'font-weight-light mx-1',
                                            ])!!}
                                            {!!Form::checkbox( "permission[]", $permission->id ,false,[
                                                'class' => 'checkSingle',
                                            ])!!}

                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    {!!Form::submit('Save',[
                                        'class' =>'btn btn-primary btn-flat'
                                    ])!!}
                                </div>

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
    $(document).ready(function() {
        $("#checkedAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked=true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked=false;
                });
            }
        });

        $(".checkSingle").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;

                $(".checkSingle").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $("#checkedAll").prop("checked", true);
                }
            }
            else {
                $("#checkedAll").prop("checked", false);
            }
        });
    });
    </script>
@endpush


