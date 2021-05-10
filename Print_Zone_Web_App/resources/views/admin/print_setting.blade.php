@extends('layouts.admin_layout')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title font-weight-bold text-primary">Print Settings</h2>
                @if($data['found'])
                    <p class="card-description"><code class="text-success">Available Print Settings</code></p>
                @else
                    <p class="card-description"><code class="text-danger">No Print Setting is available</code></p>
                @endif
                <div class="row mt-2 mb-4 mr-1">
                    <button class="btn btn-info ml-sm-auto" data-toggle="modal" data-target="#create_print_setting_modal">Create Print Setting</button>
                </div>
                @if($data['found'])
                    <table class="col-lg-12 table table-responsive" style="width: 100%">
                        <thead>
                        <tr>
                            <th > Setting ID</th>
                            <th > Max File Count</th>
                            <th > Max Upload File Size </th>
                            <th > Server Directory </th>
                            <th > Hidden Directory </th>
                            <th > Temp Directory </th>
                            <th > Edit </th>
                            <th > Delete </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['data'] as $all)
                            <tr>
                                <td>{{$loop ->index + 1}}</td>
                                <td>{{$all->max_file_count}}</td>
                                <td>{{$all->max_size_total}}  KB</td>
                                <td>{{$all->server_dir}}</td>
                                <td>{{$all->hidden_dir}}</td>
                                <td>{{$all->temp_dir}}</td>

                                <td>
                                    <button type="button" class="btn btn-warning btn-rounded btn-sm" data-toggle="modal" data-target="#edit_print_setting_modal" data-setting_id="{{$all->setting_id}}" data-max_file_count="{{$all->max_file_count}}" data-max_size_total="{{$all->max_size_total}}" data-storing_location="{{$all->server_dir}}" data-hidden_dir="{{$all->hidden_dir}}" data-temp_dir="{{$all->temp_dir}}">Edit</button>
                                </td>
                                <td>
                                    <form action="/delete_print_setting" method="post">
                                        @csrf
                                        <input type="hidden" name="setting_id" value="{{$all->setting_id}}">
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
    <div class="modal fade" id="create_print_setting_modal" tabindex="-1" role="dialog" aria-labelledby="create_print_setting_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_print_setting_modalTitle">Create New Print Setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_print_setting" enctype="multipart/form-data">
                        @csrf

                        {{-------------------------- Max File Count ---------------------}}
                        <div class="form-group row">
                            <label for="c_max_file_count" class="col-md-4 col-form-label text-md-right">{{ __('Max File Count') }}</label>

                            <div class="col-md-6">
                                <input id="c_max_file_count" type="text" class="form-control" name="c_max_file_count" value="{{ old('c_max_file_count') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Max Size Total---------------------}}
                        <div class="form-group row">
                            <label for="c_max_size_total" class="col-md-4 col-form-label text-md-right">{{ __('Max Size Total') }}</label>

                            <div class="col-md-6">
                                <input id="c_max_size_total" type="text" class="form-control" name="c_max_size_total" value="{{ old('c_max_size_total') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Storing Location---------------------}}
                        <div class="form-group row">
                            <label for="c_storing_location" class="col-md-4 col-form-label text-md-right">{{ __('Storing Location') }}</label>

                            <div class="col-md-6">
                                <input id="c_storing_location" type="text" class="form-control" name="c_storing_location" value="{{ old('c_storing_location') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Hidden Location---------------------}}
                        <div class="form-group row">
                            <label for="c_hidden_dir" class="col-md-4 col-form-label text-md-right">{{ __('Hidden Location') }}</label>

                            <div class="col-md-6">
                                <input id="c_hidden_dir" type="text" class="form-control" name="c_hidden_dir" value="{{ old('c_hidden_dir') }}"  autocomplete="c_hidden_dir" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Storing Location---------------------}}
                        <div class="form-group row">
                            <label for="c_temp_dir" class="col-md-4 col-form-label text-md-right">{{ __('Storing Location') }}</label>

                            <div class="col-md-6">
                                <input id="c_temp_dir" type="text" class="form-control" name="c_temp_dir" value="{{ old('c_temp_dir') }}"  autocomplete="c_temp_dir" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Edit Button ---------------------}}
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

    <div class="modal fade" id="edit_print_setting_modal" tabindex="-1" role="dialog" aria-labelledby="edit_print_setting_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_print_setting_modalLabel">Edit Print Setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_print_setting" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="setting_id" name="setting_id" value="">
                        {{-------------------------- Max File Count ---------------------}}
                        <div class="form-group row">
                            <label for="max_file_count" class="col-md-4 col-form-label text-md-right">{{ __('Max File Count') }}</label>

                            <div class="col-md-6">
                                <input id="max_file_count" type="text" class="form-control" name="max_file_count" value="{{ old('max_file_count') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Max Size Total---------------------}}
                        <div class="form-group row">
                            <label for="max_size_total" class="col-md-4 col-form-label text-md-right">{{ __('Max Size Total') }}</label>

                            <div class="col-md-6">
                                <input id="max_size_total" type="text" class="form-control" name="max_size_total" value="{{ old('max_size_total') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Storing Location---------------------}}
                        <div class="form-group row">
                            <label for="storing_location" class="col-md-4 col-form-label text-md-right">{{ __('Storing Location') }}</label>

                            <div class="col-md-6">
                                <input id="storing_location" type="text" class="form-control" name="storing_location" value=""  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Storing Location---------------------}}
                        <div class="form-group row">
                            <label for="hidden_dir" class="col-md-4 col-form-label text-md-right">{{ __('Hidden Location') }}</label>

                            <div class="col-md-6">
                                <input id="hidden_dir" type="text" class="form-control" name="hidden_dir" value=""  autocomplete="hidden_dir" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Storing Location---------------------}}
                        <div class="form-group row">
                            <label for="temp_dir" class="col-md-4 col-form-label text-md-right">{{ __('Temp Location') }}</label>

                            <div class="col-md-6">
                                <input id="temp_dir" type="text" class="form-control" name="temp_dir" value=""  autocomplete="temp_dir" autofocus required>
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
        $('#edit_print_setting_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var setting_id = button.data('setting_id')
            var max_file_count = button.data('max_file_count')
            var max_size_total = button.data('max_size_total')
            var storing_location = button.data('storing_location')
            var hidden_dir = button.data('hidden_dir')
            var temp_dir = button.data('temp_dir')
            var modal = $(this)


            modal.find('.modal-body #setting_id').val(setting_id)
            modal.find('.modal-body #max_file_count').val(max_file_count)
            modal.find('.modal-body #max_size_total').val(max_size_total)
            modal.find('.modal-body #storing_location').val(storing_location)
            modal.find('.modal-body #hidden_dir').val(hidden_dir)
            modal.find('.modal-body #temp_dir').val(temp_dir)
        })
    </script>
@endsection
{{---------------------------------------JavaScript Section Ends--------------------------------}}
