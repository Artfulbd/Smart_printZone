@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="assets/images/faces/face8.jpg" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0">{{auth()->user()->name}}</h3>
                                        <p class="text-muted mb-0">
                                            @if(strtolower(auth()->user()->role) == 'super_admin')
                                                Super Admin
                                            @elseif(strtolower(auth()->user()->role) == 'student')
                                                Student
                                            @endif
                                        </p>
                                    </div>
                                </div>


                                <button class="btn btn-danger my-3">About Me</button>
                                <p class="text-muted">Hi, I'm {{auth()->user()->name}}</p>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">ID</strong> <span>{{auth()->user()->id}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li>
                                    <li><strong class="text-dark mr-4">Email</strong> <span>{{auth()->user()->email}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
@section('welcome_message')
    <script src="assets/js/shared/misc.js"></script>
@endsection
