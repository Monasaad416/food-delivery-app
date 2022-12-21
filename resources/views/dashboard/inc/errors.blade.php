
@if($errors->any())
    <div class="alert alert-danger mg-b-0" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
            @foreach ($errors->all() as $error )
                <p class="m-0">{{$error}}</p>
            @endforeach
    </div>
@endif
