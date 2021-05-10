@extends('layouts.admin_layout')
@section('custom_style')
    <link href="{{asset('/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        th {
            text-align: center;
        }
        table {
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title font-weight-bold text-primary">Printer Details Settings</h2>
                @if($data['found'])
                    <p class="card-description"><code class="text-success">Available Printer Details</code></p>
                @else
                    <p class="card-description"><code class="text-danger">No Printer Details is available</code></p>
                @endif
                <div class="row mt-2 mb-4 mr-1">
                    <button class="btn btn-info ml-sm-auto" data-toggle="modal" data-target="#create_printer_details_modal">Add Printer</button>
                </div>
                @if($data['found'])
                    <table class="col-lg-12 table table-responsive">
                        <thead>
                        <tr>
                            <th > SL #</th>
                            <th > Printer Name</th>
                            <th > Given Name</th>
                            <th > Zone </th>
                            <th > Port </th>
                            <th > Per Page Printing Time </th>
                            <th > Driver Name </th>
                            <th > Current Status </th>
                            <th > Edit </th>
                            <th > Delete </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['data'] as $all)
                            <tr>
                                <td>{{$loop ->index + 1}}</td>
                                <td>{{$all->printer_name}}</td>
                                <td>{{$all->given_name}}</td>
                                <td>{{$all->zone_name}}</td>
                                <td>{{$all->port}}</td>
                                <td>{{$all->time_one_pg}}</td>
                                <td>{{$all->driver_name}}</td>
                                <td>{{$all->status}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-rounded btn-sm" data-toggle="modal" data-target="#edit_printer_details_modal" data-printer_id="{{$all->printer_id}}" data-zone_id="{{$all->zone_id}}" data-printer_name="{{$all->printer_name}}" data-given_name="{{$all->given_name}}" data-port="{{$all->port}}" data-time_one_pg="{{$all->time_one_pg}}" data-driver_name="{{$all->driver_name}}" data-current_status="{{$all->current_status}}">Edit</button>
                                </td>
                                <td>
                                    <form action="{{route('admin.delete_printer_details')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="printer_id" value="{{$all->printer_id}}">
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
    <div class="modal fade" id="create_printer_details_modal" tabindex="-1" role="dialog" aria-labelledby="create_printer_details_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_printer_details_modalTitle">Add New Printer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.create_printer_details')}}">
                        @csrf

                        {{-------------------------- Zone Name ---------------------}}
                        <div class="form-group row">
                            <label for="zone_id" class="col-md-4 col-form-label text-md-right">{{ __('Zone Name') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="zone_id" name="zone_id" required>
                                    @php
                                    $zones = \App\Models\Zone::all();
                                    @endphp
                                    @if(!$zones->isEmpty())
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->zone_id}}">{{$zone->zone_name}}</option>
                                        @endforeach
                                    @else
                                        <option>No Zone Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-------------------------- Printer Name ---------------------}}
                        <div class="form-group row">
                            <label for="printer_name" class="col-md-4 col-form-label text-md-right">{{ __('Printer Name') }}</label>

                            <div class="col-md-6">
                                <input id="printer_name" type="text" class="form-control" name="printer_name" value="{{ old('printer_name') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Given Name---------------------}}
                        <div class="form-group row">
                            <label for="given_name" class="col-md-4 col-form-label text-md-right">{{ __('Given Name') }}</label>

                            <div class="col-md-6">
                                <input id="given_name" type="text" class="form-control" name="given_name" value="{{ old('given_name') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Port ---------------------}}
                        <div class="form-group row">
                            <label for="port" class="col-md-4 col-form-label text-md-right">{{ __('Port') }}</label>

                            <div class="col-md-6">
                                <input id="port" type="text" class="form-control" name="port" value="{{ old('port') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Per Page Printing Time---------------------}}
                        <div class="form-group row">
                            <label for="time_one_pg" class="col-md-4 col-form-label text-md-right">{{ __('Time Per Page') }}</label>

                            <div class="col-md-6">
                                <input id="time_one_pg" type="text" class="form-control" name="time_one_pg" value="{{ old('time_one_pg') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Driver Name---------------------}}
                        <div class="form-group row">
                            <label for="driver_name" class="col-md-4 col-form-label text-md-right">{{ __('Driver Name') }}</label>

                            <div class="col-md-6">
                                <input id="driver_name" type="text" class="form-control" name="driver_name" value="{{ old('driver_name') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Current Status---------------------}}
                        <div class="form-group row">
                            <label for="current_status" class="col-md-4 col-form-label text-md-right">{{ __('Current Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="current_status" name="current_status" required>
                                    @php
                                        $printer_status_code = \App\Models\PrinterStatusCode::all();
                                    @endphp
                                    @if(!$printer_status_code->isEmpty())
                                        @foreach($printer_status_code as $psc)
                                            <option value="{{$psc->s_code}}">{{$psc->status}}</option>
                                        @endforeach
                                    @else
                                        <option>No Zone Status Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-------------------------- Add Button ---------------------}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{----------------------------------------------Create Modal Ends------------------------------------------}}




    {{----------------------------------------------Edit Modal Starts------------------------------------------}}

    <div class="modal fade" id="edit_printer_details_modal" tabindex="-1" role="dialog" aria-labelledby="edit_printer_details_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_printer_details_modalLabel">Edit Print Setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_printer_details" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="printer_id_e" name="printer_id_e" value="">
                        {{-------------------------- Zone Name ---------------------}}
                        <div class="form-group row">
                            <label for="zone_id_e" class="col-md-4 col-form-label text-md-right">{{ __('Zone Name') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="zone_id_e" name="zone_id_e" required>
                                    @php
                                        $zones = \App\Models\Zone::all();
                                    @endphp
                                    @if(!$zones->isEmpty())
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->zone_id}}">{{$zone->zone_name}}</option>
                                        @endforeach
                                    @else
                                        <option>No Zone Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-------------------------- Printer Name ---------------------}}
                        <div class="form-group row">
                            <label for="printer_name_e" class="col-md-4 col-form-label text-md-right">{{ __('Printer Name') }}</label>

                            <div class="col-md-6">
                                <input id="printer_name_e" type="text" class="form-control" name="printer_name_e" value="{{ old('printer_name_e') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Given Name---------------------}}
                        <div class="form-group row">
                            <label for="given_name_e" class="col-md-4 col-form-label text-md-right">{{ __('Given Name') }}</label>

                            <div class="col-md-6">
                                <input id="given_name_e" type="text" class="form-control" name="given_name_e" value="{{ old('given_name_e') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Port ---------------------}}
                        <div class="form-group row">
                            <label for="port_e" class="col-md-4 col-form-label text-md-right">{{ __('Port') }}</label>

                            <div class="col-md-6">
                                <input id="port_e" type="text" class="form-control" name="port_e" value="{{ old('port_e') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Per Page Printing Time---------------------}}
                        <div class="form-group row">
                            <label for="time_one_pg_e" class="col-md-4 col-form-label text-md-right">{{ __('Time Per Page') }}</label>

                            <div class="col-md-6">
                                <input id="time_one_pg_e" type="text" class="form-control" name="time_one_pg_e" value="{{ old('time_one_pg_e') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Driver Name---------------------}}
                        <div class="form-group row">
                            <label for="driver_name" class="col-md-4 col-form-label text-md-right">{{ __('Driver Name') }}</label>

                            <div class="col-md-6">
                                <input id="driver_name_e" type="text" class="form-control" name="driver_name_e" value="{{ old('driver_name_e') }}"  autocomplete="title" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Current Status---------------------}}
                        <div class="form-group row">
                            <label for="current_status_e" class="col-md-4 col-form-label text-md-right">{{ __('Current Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="current_status_e" name="current_status_e" required>
                                    @php
                                        $printer_status_code = \App\Models\PrinterStatusCode::all();
                                    @endphp
                                    @if(!$printer_status_code->isEmpty())
                                        @foreach($printer_status_code as $psc)
                                            <option value="{{$psc->s_code}}">{{$psc->status}}</option>
                                        @endforeach
                                    @else
                                        <option>No Zone Status Available</option>
                                    @endif
                                </select>
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
        $('#edit_printer_details_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var printer_id = button.data('printer_id')
            var zone_id = button.data('zone_id')
            var printer_name = button.data('printer_name')
            var given_name = button.data('given_name')
            var port = button.data('port')
            var time_one_pg = button.data('time_one_pg')
            var driver_name = button.data('driver_name')
            var current_status = button.data('current_status')
            var modal = $(this)


            modal.find('.modal-body #printer_id_e').val(printer_id)
            modal.find('.modal-body #zone_id_e').val(zone_id)
            modal.find('.modal-body #printer_name_e').val(printer_name)
            modal.find('.modal-body #given_name_e').val(given_name)
            modal.find('.modal-body #port_e').val(port)
            modal.find('.modal-body #time_one_pg_e').val(time_one_pg)
            modal.find('.modal-body #driver_name_e').val(driver_name)
            modal.find('.modal-body #current_status_e').val(current_status)
        })
    </script>
@endsection
{{---------------------------------------JavaScript Section Ends--------------------------------}}
