@extends('layouts.layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
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
                                <h1 class="display-5 mt-1 mb-3 text-primary">6</h1>
                                <div class="mb-1">
                                    <span class="text-muted">Total 100</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Printings</h5>
                                <h1 class="display-5 mt-1 mb-3 text-primary">31</h1>
                                <div class="mb-1">
                                    <span class="text-muted float-left">Completed: 250</span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">User Status</h5>
                                <h1 class="display-5 mt-1 mb-3 text-primary">Active</h1>
                                <div class="mb-1">
                                    <span class="text-muted float-left">Page : 700</span>

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
