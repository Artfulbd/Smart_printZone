@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-info">Search Student</h4>
                                    <p class="card-description"> Search by ID </p>
                                    <form class="forms-sample" action="{{route('admin.search_student_post')}}" METHOD="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="nsu_id" class="col-sm-3 col-form-label">NSU ID</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" name="nsu_id" id="nsu_id" placeholder="Enter NSU ID" min="6" required> </div>
                                        </div>
                                        <button type="submit" class="btn btn-danger mr-2">Search</button>
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
