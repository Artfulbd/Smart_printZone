@extends('layouts.admin_layout')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title font-weight-bold text-primary">Zone Settings</h2>
                @if($data['found'])
                    <p class="card-description"><code class="text-success">Available Zones</code></p>
                @else
                    <p class="card-description"><code class="text-danger">No Zone Setting is available</code></p>
                @endif
                <div class="row mt-2 mb-4 mr-1">
                    <button class="btn btn-info ml-sm-auto" data-toggle="modal" data-target="#create_zone_setting_modal">Create Zone</button>
                </div>
                @if($data['found'])
                    <table class="col-lg-12 table table-responsive"  style="width: 100%">
                        <thead>
                        <tr>
                            <th > Zone No</th>
                            <th > Zone Name</th>
                            <th > Created at </th>
                            <th > Updated at </th>
                            <th > Edit </th>
                            <th > Delete </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count = 0; ?>
                        @foreach($data['data'] as $all)
                            <tr>
                                <td>{{++$count}}</td>
                                <td>{{$all->zone_name}}</td>
                                <td>{{(new DateTime($all->created_at))->format("d-m-Y h:i A")}}</td>
                                <td>{{(new DateTime($all->updated_at))->format("d-m-Y h:i A")}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-rounded btn-sm" data-toggle="modal" data-target="#edit_zone_setting_modal" data-zone_id="{{$all->zone_id}}"  data-zone_name="{{$all->zone_name}}">Edit</button>
                                </td>
                                <td>
                                    <form action="{{route('admin.delete_zone')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="zone_id" value="{{$all->zone_id}}">
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
    <div class="modal fade" id="create_zone_setting_modal" tabindex="-1" role="dialog" aria-labelledby="create_zone_setting_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_zone_setting_modalTitle">Create New Zone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.create_zone')}}">
                        @csrf

                        {{-------------------------- Zone Name ---------------------}}
                        <div class="form-group row">
                            <label for="zone_name_c" class="col-md-4 col-form-label text-md-right">{{ __('Zone Name') }}</label>

                            <div class="col-md-6">
                                <input id="zone_name_c" type="text" class="form-control" name="zone_name" value="{{ old('zone_name') }}"  autocomplete="title" autofocus required>
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

    <div class="modal fade" id="edit_zone_setting_modal" tabindex="-1" role="dialog" aria-labelledby="edit_zone_setting_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_zone_setting_modalLabel">Edit Zone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.edit_zone')}}">
                        @csrf
                        <input type="hidden" id="zone_id" name="zone_id" value="">
                        {{-------------------------- Zone Name ---------------------}}
                        <div class="form-group row">
                            <label for="zone_name" class="col-md-4 col-form-label text-md-right">{{ __('Zone Name') }}</label>

                            <div class="col-md-6">
                                <input id="zone_name" type="text" class="form-control" name="zone_name" value="{{ old('zone_name') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Edit Button ---------------------}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save</button>
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
        $('#edit_zone_setting_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var zone_id = button.data('zone_id')
            var zone_name = button.data('zone_name')
            var modal = $(this)


            modal.find('.modal-body #zone_id').val(zone_id)
            modal.find('.modal-body #zone_name').val(zone_name)
        })
    </script>
@endsection
{{---------------------------------------JavaScript Section Ends--------------------------------}}
