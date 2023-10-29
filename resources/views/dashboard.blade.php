@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row justify-content-center">
        
        <div class="container">
            <div class="card text-white bg-dark mb-3">

                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    You are Logged In
                </div>
            </div>
        </div>
        
        <div style="padding-top:15px;" class="container-fluid">
            <div class="row">

                <div class="card text-white bg-primary mb-3" style="margin:10px; padding:2px; width:23%; height:8rem;">
                    <div class="card-body">
                        <div class="row">
                            <i style="padding:10px;" class="fa fa-box-open fa-4x"></i>
                            <div class="col">
                                <h5 class="card-title">Total Items</h5>
                                <h1 class="card-text">{{$items->count()}}</h1>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card text-white bg-success mb-3" style="margin:10px; padding:2px; width:23%; height:8rem;">
                    <div class="card-body">
                        <div class="row">
                            <i style="padding:10px; padding-left:30px;" class="fa fa-clipboard-check fa-4x"></i>
                            <div class="col">
                                <h5 class="card-title">Available</h5>
                                <h1 class="card-text">{{$items->where('status','=', 'Available')->count()}}</h1>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card text-white bg-warning mb-3" style="margin:10px; padding:2px; width:23%; height:8rem;">
                    <div class="card-body">
                        <div class="row">
                            <i style="padding:10px; padding-left:30px;" class="fa fa-question fa-4x"></i>
                            <div class="col">
                                <h5 class="card-title">Unresolved</h5>
                                <h1 class="card-text">{{$items->where('status','=', 'Unresolved')->count()}}</h1>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card text-white bg-danger mb-3" style="margin:10px; padding:2px; width:23%; height:8rem;">
                    <div class="card-body">
                        <div class="row">
                            <i style="padding:10px; padding-left:20px;" class="fa fa-search fa-4x"></i>
                            <div class="col">
                                <h5 class="card-title">Missing</h5>
                                <h1 class="card-text">{{$items->where('status','=', 'Lost')->count()}}</h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

