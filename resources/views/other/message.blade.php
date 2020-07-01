
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-sm">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('working'))
    <div class="alert alert-success alert-sm">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

