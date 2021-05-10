@extends('layouts.admin_layout')
@section('content')

    <?php
        $student = $data['student_info'];
    ?>
    <div class="container-fluid px-lg-4">
        <div class="row mt-5">
            <div class="col-md-12 mb-5">
                <div class="card rounded shadow-none">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 d-flex">
                                <div class="user-avatar mb-auto">
                                    <img src="{{asset('assets/images/faces/face8.jpg')}}" alt="profile image" class="profile-img img-lg rounded-circle">
                                </div>
                                <div class="wrapper pl-4">
                                    <div class="wrapper d-flex align-items-center">
                                        <h4 class="mb-0 font-weight-medium">{{$student->name}}</h4>
                                    </div>
                                    <div class="wrapper d-flex align-items-center font-weight-medium text-muted">
                                        <i class="mdi mdi-inbox-arrow-down mr-2"></i>
                                        <p class="mb-0 text-muted">{{$student->id}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="wrapper d-flex justify-content-end">
                                    {{--<a href="{{route('admin.goto_load_student_page')}}" class="btn btn-sm btn-inverse-primary mr-2">Back</a>--}}
                                    <button type="submit"  data-toggle="modal" data-target="#edit_student_modal" class="btn btn-sm btn-inverse-primary mr-2">Edit</button>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#page_load_modal">Load Page</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper border-top">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex">
                                    <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                                        <i class="mdi mdi-account-plus icon-sm my-0 mx-1"></i>
                                    </div>
                                    <div class="wrapper pl-3">
                                        <p class="mb-0 font-weight-medium text-muted">STATUS</p>
                                        <h4 class="font-weight-semibold mb-0 {{$student->status == 1 ? 'text-success' : 'text-danger'}}">{{$student->status == 1 ? 'Active' : 'Inactive'}}</h4>
                                    </div>
                                </div>
                                <div class="col d-flex">
                                    <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                                        <i class="mdi mdi-server-security icon-sm my-0 mx-1"></i>
                                    </div>
                                    <div class="wrapper pl-3">
                                        <p class="mb-0 font-weight-medium text-muted">PAGE LEFT</p>
                                        <h4 class="font-weight-semibold mb-0 text-warning">{{$student->page_left}}</h4>
                                    </div>
                                </div>
                                <div class="col d-flex">
                                    <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                                        <i class="mdi mdi-traffic-light icon-sm my-0 mx-1"></i>
                                    </div>
                                    <div class="wrapper pl-3">
                                        <p class="mb-0 font-weight-medium text-muted">TOTAL PRINTED</p>
                                        <h4 class="font-weight-semibold mb-0">{{$student->total_printed}}</h4>
                                    </div>
                                </div>
                                <div class="col d-flex">
                                    <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                                        <i class="mdi mdi-chart-arc icon-sm my-0 mx-1"></i>
                                    </div>
                                    <div class="wrapper pl-3">
                                        <p class="mb-0 font-weight-medium text-muted">PENDING FILE</p>
                                        <h4 class="font-weight-semibold mb-0 text-primary">{{$student->pending}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








        {{----------------------------------------------Page Load  Modal Starts------------------------------------------}}

        <div class="modal fade" id="page_load_modal" tabindex="-1" role="dialog" aria-labelledby="page_load_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="page_load_modalLabel">Load Page</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('admin.increase_page_amount')}}">
                            @csrf
                            <input type="hidden" name="nsu_id" value="{{$student->id}}">
                            {{-------------------------- Page Amount ---------------------}}
                            <div class="form-group row">
                                <label for="page_amount" class="col-md-4 col-form-label text-md-right">{{ __('Page Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="page_amount" type="number" class="form-control" name="page_amount" value="{{ old('page_amount') }}"  autocomplete="title" autofocus required>
                                </div>
                            </div>
                            {{-------------------------- Edit Button ---------------------}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{----------------------------------------------Load Page Modal Ends------------------------------------------}}



        {{----------------------------------------------Edit Student Modal Starts------------------------------------------}}

        <div class="modal fade" id="edit_student_modal" tabindex="-1" role="dialog" aria-labelledby="edit_student_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_student_modalLabel">Edit Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('admin.edit_student_information')}}">
                            @csrf
                            <input type="hidden" name="nsu_id" value="{{$student->id}}">
                            {{-------------------------- Current Status---------------------}}
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Current Status') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            {{-------------------------- Edit Button ---------------------}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{----------------------------------------------Edit Modal Ends------------------------------------------}}
    </div>


@endsection



{{---------------------------------------JavaScript Section Starts--------------------------------}}
@section('extra_js')
    <script>
        $('#edit_student_modal').on('show.bs.modal', function (event) {
            var current_status = {{$student->status}};
            var modal = $(this)
            modal.find('.modal-body #status').val(current_status)
        })
    </script>
@endsection
{{---------------------------------------JavaScript Section Ends--------------------------------}}
