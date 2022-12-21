@extends('dashboard.layouts.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route('home')}}">الرئيسية</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ البنوك</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

@include("dashboard.inc.message")
<div class="row row-sm">
	<!--div-->
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">قائمة البنوك</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
			</div>
			<div class="card-body">
				<div class="table-responsive hoverable-table">

                    @can('إضافة-بنك')
                        <button id="button" class="btn btn-primary mg-b-20">
                            <a href="{{route('banks.create')}}" class="text-white">
                                إضافة بنك
                            </a>
                        </button>
                    @endcan

					<table id="banks" class="table table-striped tabllogo.pnge-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">الإسم</th>
                                <th class="text-center">رقم الحساب</th>
                                <th class="text-center">تعديل</th>
                                 <th class="text-center">حذف</th>

                            </tr>
                         </thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="delete_bank_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h6 class="tx-danger mg-b-20 mx-3 my-3">هل أنت متأكد من عملية الحذف ل<span  id="name"></span></h6>
                <form action="{{ route('bank.delete')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>

                    <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right mx-3 my-3" type="submit">حذف</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        $(function() {
            $('#banks ').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('banks.list') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'account_no', name: 'account_no' },
                    { data: 'edit', name: 'edit' },
                    { data: 'delete', name: 'delete' },
                ]
            });

            $('#banks tbody').on('click','#delete_btn',function(){
                var id = $(this).attr("data-id");
                var name = $(this).attr("data-name");
                console.log(id);
                $('#delete_bank_modal #id').val(id);
                $('#delete_bank_modal #name').text(name);
            });
        });
    </script>
@endpush



