@extends('layouts.admin_layout')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title font-weight-bold text-primary">Manage Admin</h2>
                @if($data['found'])
                    <p class="card-description"><code class="text-success">Available Admins</code></p>
                @else
                    <p class="card-description"><code class="text-danger">No User Admin is created till now</code></p>
                @endif
                <div class="row mt-2 mb-4 mr-1">
                    <button class="btn btn-info ml-sm-auto" data-toggle="modal" data-target="#create_admin_modal">Create New Admin</button>
                </div>
                @if($data['found'])
                    <table class="col-lg-12 table table-responsive">
                        <thead>
                        <tr>
                            <th > Admin ID</th>
                            <th > Name </th>
                            <th > Email </th>
                            <th > Role </th>
                            <th > Status </th>
                            <th > Edit </th>
                            <th > Delete </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['data'] as $all)
                            <tr>
                                <td>{{$all->id}}</td>
                                <td>{{$all->name}}</td>
                                <td>{{$all->email}}</td>
                                <td>{{$all->role}}</td>
                                <td>
                                    @if($all->status)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Disable</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-rounded btn-sm" data-toggle="modal" data-target="#edit_admin_modal" data-user_id="{{$all->id}}" data-name="{{$all->name}}" data-email="{{$all->email}}" data-role="{{$all->role}}" data-status="{{$all->status}}">Edit</button>
                                </td>
                                <td>
                                    <form action="/delete_admin" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$all->id}}">
                                        <button type="submit" class="btn btn-danger btn-rounded btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>



    {{----------------------------------------------Create Modal Starts------------------------------------------}}
    <!-- Modal -->
    <div class="modal fade" id="create_admin_modal" tabindex="-1" role="dialog" aria-labelledby="create_admin_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_admin_modalTitle">Create New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_admin" enctype="multipart/form-data">
                        @csrf

                        {{-------------------------- Admin ID ---------------------}}
                        <div class="form-group row">
                            <label for="c_user_id" class="col-md-4 col-form-label text-md-right">{{ __('Admin ID') }}</label>

                            <div class="col-md-6">
                                <input id="c_user_id" type="text" class="form-control" name="c_user_id" value="{{ old('c_user_id') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Admin Name ---------------------}}
                        <div class="form-group row">
                            <label for="c_name" class="col-md-4 col-form-label text-md-right">{{ __('Admin Name') }}</label>

                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control" name="c_name" value="{{ old('c_name') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Email ---------------------}}
                        <div class="form-group row">
                            <label for="c_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="c_email" type="text" class="form-control" name="c_email" value="{{ old('c_email') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Password ---------------------}}
                        <div class="form-group row">
                            <label for="c_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="c_password" type="password" class="form-control" name="c_password" value="{{ old('c_password') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Role ---------------------}}
                        <div class="form-group row">
                            <label for="c_role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="c_role" name="c_role">
                                    <option >----</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin_1">Admin 1</option>
                                    <option value="admin_2">Admin 2</option>
                                    <option value="admin_3">Admin 3</option>
                                </select>
                            </div>
                        </div>
                        {{-------------------------- Status ---------------------}}
                        <div class="form-group row">
                            <label for="c_status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="c_status" name="c_status">
                                    <option >----</option>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        {{-------------------------- Create Button ---------------------}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{----------------------------------------------Create Modal Ends------------------------------------------}}




    {{----------------------------------------------Edit Modal Starts------------------------------------------}}

    <div class="modal fade" id="edit_admin_modal" tabindex="-1" role="dialog" aria-labelledby="edit_admin_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_admin_modalLabel">Edit Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_admin" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="">
                        {{-------------------------- Admin ID ---------------------}}
                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Admin ID') }}</label>

                            <div class="col-md-6">
                                <input id="user_id" type="text" class="form-control" name="user_id" value="{{ old('user_id') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Admin Name ---------------------}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Admin Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Email ---------------------}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Role ---------------------}}
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="role" name="role">
                                    <option >----</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin_1">Admin 1</option>
                                    <option value="admin_2">Admin 2</option>
                                    <option value="admin_3">Admin 3</option>
                                </select>
                            </div>
                        </div>
                        {{-------------------------- Status ---------------------}}
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="status" name="status">
                                    <option >----</option>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        {{-------------------------- Edit Button ---------------------}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{----------------------------------------------Edit Modal Ends------------------------------------------}}
@endsection




{{---------------------------------------JavaScript Section Starts--------------------------------}}
@section('extra_js')
    <script>
        $('#edit_admin_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var user_id = button.data('user_id')
            var name = button.data('name')
            var email = button.data('email')
            var role = button.data('role')
            var status = button.data('status')
            var modal = $(this)

            console.log(role);

            modal.find('.modal-body #user_id').val(user_id)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-body #role').val(role)
            modal.find('.modal-body #status').val(status)
        })
    </script>
@endsection
{{---------------------------------------JavaScript Section Ends--------------------------------}}
