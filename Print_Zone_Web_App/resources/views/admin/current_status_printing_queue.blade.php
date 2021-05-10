@extends('layouts.admin_layout')
@section('custom_style')
    <link href="{{asset('/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        th,td {
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

                    <p class="card-description"><code class="text-success">Available Files in Current Status</code></p>

                    <div class="table-responsive">
                        <table class="table table-striped zero-configuration" id="print_queue_table">
                            <thead>
                            <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                <th class="text-white"> Printer Name </th>
                                <th class="text-white"> Zone Name </th>
                                <th class="text-white"> User ID </th>
                                <th class="text-white"> Required Time </th>
                                <th class="text-white"> User Required Time </th>
                                <th class="text-white"> Abort </th>
                            </tr>
                            </thead>
                            <tbody id="queue_data_tbody">

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection




{{---------------------------------------JavaScript Section Starts--------------------------------}}
@section('extra_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery CDN -->
    <script type='text/javascript'>
        $(document).ready(function(){
            // Fetch all records
            fetchRecords();


            setInterval(function(){
                fetchRecords();
            }, 4000);


            $('body').on('click', '.abort', function () {
                var u_id = $(this).data("id");
                $.ajax({
                    type: "GET",
                    url: "/abort_from_current_status_print_queue/"+u_id,
                    data: {
                        _token: "{{csrf_token()}}"
                    },
                    success: function (response) {
                        //$("#row_id_" + u_id).remove();
                    },
                    error: function (response) {
                        console.log('Error:', response.success);
                    }
                });
            });
        });
        function fetchRecords(){
            $.ajax({
                url: '{{route('admin.get_current_status_print_queue_data')}}',
                type: 'get',
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function(response){
                    $("#queue_data_tbody").empty();
                    // Current Status
                    $.each(response.data, function (key, value) {
                        var abort = '<td><a href="javascript:void(0)" id="abort" data-id="'+ value.u_id +'" class="btn btn-danger abort">Abort</a></td>'
                        $("#queue_data_tbody").append('<tr id="row_id_'+ value.u_id  +'" ><td class="text-uppercase">' + value.given_name + '</td><td class="text-uppercase">' + value.zone_name + '</td><td>' + value.u_id + '</td><td>' + value.required_time + '</td><td>' + value.u_required_time + '</td>'+ abort +'</tr>');
                    });
                }
            });
        }
    </script>


    {{--<script src="{{asset('/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>




    <script>

        $('#print_queue_table').DataTable( {
            initComplete: function () {
                this.api().columns([0,1]).every( function () {
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

    </script>--}}
@endsection
{{---------------------------------------JavaScript Section Ends--------------------------------}}
