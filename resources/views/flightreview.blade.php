

@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Mission Flight Review') }}</div>
                <div class="card-body">
                    <table id="example" class="table table-hover table-sm nowrap" style="width:100%">
                        <thead class="thead-dark" style='text-align: center'>
                            <tr>
                                <th>No</th>
                                <th>@sortablelink('mission_id', 'Mission_id', ['filter' => 'active, visible'], ['class' => 'text text-light text-decoration-none'])</th>
                                <th>@sortablelink('start_time', 'Start_time', ['filter' => 'active, visible'], ['class' => 'text text-light text-decoration-none'])</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody style='text-align: center'>
                            
                            @php ($i = 1)
                            @if ($missions->count())
                            @foreach ($missions as $mission)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$mission->mission_id}}</td>
                                <td>{{$mission->start_time}}</td>
                                <td>
                                    <a class="btn btn-outline-info btn-sm" style="width:2rem; height:2rem; padding-right:0.2rem;" href="{{ route('viewmission', $mission->mission_id) }}" ><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>


                    <style>
                        .w-5{
                            display:none;
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

