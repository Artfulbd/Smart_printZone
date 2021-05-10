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
                <h2 class="card-title font-weight-bold text-primary">Printing Queue</h2>
                @if($data['found'])
                    <p class="card-description"><code class="text-success">Available oredrs in Print Queue</code></p>
                @else
                    <p class="card-description"><code class="text-danger">No data to show</code></p>
                @endif
                @if($data['found'])
                    <div class="table-responsive">
                        <table class="table table-striped zero-configuration" id="print_queue_table">
                            <thead>
                            <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                <th class="text-white"> Priority </th>
                                <th class="text-white"> Student ID </th>
                                <th class="text-white"> Printer Name </th>
                                <th class="text-white"> Zone Name </th>
                                <th class="text-white"> Required Time </th>
                                <th class="text-white"> Wait Time </th>
                                <th class="text-white"> Insertion Time </th>
                                <th class="text-white"> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['data'] as $all)
                                <tr>
                                    <td>{{$all->num}}</td>
                                    <td>{{$all->u_id}}</td>
                                    <td>{{$all->printer_name}}</td>
                                    <td>{{$all->zone_name}}</td>
                                    <td>{{$all->time}} Sec</td>
                                    <td>{{$all->wait_time}} Sec</td>
                                    <td>{{(new DateTime($all->insertion_time))->format("h:i:s A")}}</td>
                                    <td>
                                        <form action="{{route('admin.abort_from_card_punched_print_queue')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="u_id" value="{{$all->u_id}}">
                                            <button type="submit" class="btn btn-danger btn-rounded btn-sm">Abort</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection




{{---------------------------------------JavaScript Section Starts--------------------------------}}
@section('extra_js')
    <script src="{{asset('/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>




    <script>

        $('#print_queue_table').DataTable( {
            initComplete: function () {
                this.api().columns([2,3]).every( function () {
                    var column = this;
                    var select = $('<br><select class="mt-1 form-control"><option value=""></option></select>')
                        .appendTo( $(column.header()))
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );

    </script>
@endsection
{{---------------------------------------JavaScript Section Ends--------------------------------}}
