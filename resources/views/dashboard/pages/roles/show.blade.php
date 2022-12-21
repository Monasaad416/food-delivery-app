@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الوظيفة  </span>
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
                        <p class="product-description my-4 mx-3">
                        <h4 class="mx-3">الوظيفة :  {{$role->name}} </strong>
                        <h5 class="text-muted mx-4 mt-4"> الصلاحيات: </h5>
                        <ul>
                            @foreach ($rolePermissions as $permission)
                                <li class="mx-4 my-3">{{$permission->name}}</li>
                            @endforeach
                        </ul>
                    </p>

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


