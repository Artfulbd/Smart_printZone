@if(count($errors)>0)
    @foreach($errors->all as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif
@if(session('success'))
    <div class="alert alert-success">
        <i class="fa fa-check-square mr-2"> </i>     {{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        <i class="fa fa-info-circle mr-2"> </i>      {{session('error')}}
    </div>
@endif
