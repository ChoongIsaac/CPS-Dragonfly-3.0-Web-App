<!-- resources/views/missions/show.blade.php -->

@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mission Detail</div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Mission ID</h6>
                            <strong>{{$missions->mission_id}}</strong>
                        </div>

                      

                    <div class="row">
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Mission Start time</h6>
                            <strong>{{$missions->start_time}}</strong>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Flight Path</h6>
                            <strong>{{ json_encode($missions->flight_path) }}</strong>
                        </div>
                       
                    </div>

    
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Detected QR Codes</h6>
                            
                            <strong>{{$missions}}</strong>
                           

                            
                        </div>

                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Detected time</h6>
                            
                        </div>
                    </div>

                   
                </div>
            </div>

            <div class="container row" style='padding-top:1rem;'>

                <div class="clo-sm-1">
                    <button type="button" class="btn btn-secondary"><a class="text text-light text-decoration-none" href="flightreview"><i class="fa fa-chevron-left"></i>  Back</a></button>
                </div>



            </div>

        </div>
    </div>
</div>
@endsection





