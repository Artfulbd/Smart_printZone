@extends('layouts.admin_layout')
@section('content')
    @php($status = $data['status'])
    @php($system_id = $data['system_id'])
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="text-primary">Turn On/Off Whole System </h1>
                                <h3 class="mt-4">Current System Status :
                                    @if($status)
                                    <span class="text-success">  On </span>
                                    @else
                                    <span class="text-danger">  off </span>
                                    @endif
                                </h3>
                                <div class="row">
                                    <form action="/on_off_action" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="{{$status}}">
                                        <input type="hidden" name="system_id" value="{{$system_id}}">
                                        @if($status)
                                            <button type="submit" class="btn-lg btn-danger my-5 ml-3">Turn off</button>
                                        @else
                                            <button type="submit" class="btn-lg btn-success my-5 ml-3">Turn On</button>
                                        @endif

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
