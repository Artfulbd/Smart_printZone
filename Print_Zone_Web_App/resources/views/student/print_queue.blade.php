@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title font-weight-bold">Print Queue</h3>
                    <p class="card-description"> Description : <code>This Files are going to be printed</code> </p>
                    <table class="table table-responsive ">
                        <thead class="mw-100">
                        <tr>
                            <th scope="col"> # </th>
                            <th scope="col"> File name </th>
                            <th scope="col"> Page Count </th>
                            <th scope="col"> Size </th>
                            <th scope="col"> Upload Time </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($count = 0)
                        @foreach($data['data'] as $p)
                            <tr>
                                <td>{{++$count}}</td>
                                <td>
                                    @if(strlen($p->file_name) > 80)
                                        {{substr($p->file_name, 0, 80)}}.....
                                    @else
                                        {{$p->file_name}}.pdf
                                    @endif
                                </td>
                                <td>{{$p->pg_count}}</td>
                                <td>{{ceil($p->size/1024)}} mb</td>
                                <td>{{(new DateTime($p->created_at))->format("Y-m-d h:i A")}}</td>
                                <td>
                                    <form action="post" action="{{route('student.cancel_print')}}">
                                        @csrf
                                        <button class="btn btn-danger btn-rounded btn-sm">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection




