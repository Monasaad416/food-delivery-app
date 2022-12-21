@if(session('success'))
    <div class="alert alert-success" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>أحسنت!</strong> تم إضافة االبند بنجاح.
    </div>
@endif


@if(session('update'))
    <div class="alert alert-info" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>أحسنت!</strong> تم تعديل االبند بنجاح.
    </div>
@endif


@if(session('delete'))
    <div class="alert alert-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>إنتبه!</strong> تم حذف البند.
    </div>
@endif



@if(session('logout'))
    <div class="alert alert-danger" role="alert">
        <strong>إنتبه!</strong> تم تسجيل الخروج.
    </div>
@endif


@if(session('login'))
    <div class="alert alert-success" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>أحسنت!</strong> تم تسجيل الدخول بنجاح.
    </div>
@endif



