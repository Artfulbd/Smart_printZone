@extends('layouts.student_layout')
@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Print Queue</h4>
                    <p class="card-description"> Description : <code>File to be Printed</code> </p>
                    @if($data['found'])
                        <table class="col-lg-12 table table-responsive">
                            <thead>
                            <tr>
                                <th > # </th>
                                <th > File name </th>
                                <th > Page Count </th>
                                <th > Size </th>
                                <th > Upload Time </th>
                                <th > Action </th>
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
                                        <form method="POST" action="{{route('student.cancel_print')}}">
                                            @csrf
                                            <input type="hidden" name="file_id" value="{{$p->id}}">
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                            <input type="hidden" name="file_name" value="{{$p->file_name}}">
                                            <button class="btn btn-danger btn-rounded btn-sm">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2 class="text-center text-warning my-5">No Files to Print ! </h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection



