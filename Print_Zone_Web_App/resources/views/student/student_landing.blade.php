@extends('layouts.student_layout')
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
                                            @if(strtolower(auth()->user()->role) == 'student')
                                                Undergrad Student
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
        <div class="row mt-5">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dash Board</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Page Remaining</h5>
                                <h1 class="display-5 mt-1 mb-3 text-primary">{{$data['page_left']}}</h1>
                                <div class="mb-1">
                                    <span class="text-muted">Total 200</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Print Remaining</h5>
                                <h1 class="display-5 mt-1 mb-3 text-primary">{{$data['pending']}} files</h1>
                                <div class="mb-1">
                                    <span class="text-muted float-left">Completed: {{$data['total_printed']}}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">User Status</h5>
                                @if($data['status'])
                                    <h1 class="display-5 mt-1 mb-3 text-success">Active</h1>
                                @else
                                    <h1 class="display-5 mt-1 mb-3 text-danger">Inactive</h1>
                                @endif
                                <div class="mb-1">
                                    <span class="text-muted float-left">Page : 200</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Printing Forecast</h5>
                                <h1 class="display-5 mt-1 mb-3 text-primary">129550</h1>
                                <div class="mb-1">
                                    <span class="text-muted float-left">Page: 500</span>

                                </div>
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
