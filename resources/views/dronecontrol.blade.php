@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">
                
                    <div class="container row">

                    {{ __('Drone Control') }}

                        <div class="col-sm-1 offset-md-4" >
                            <button type="button" class="btn btn-primary" id="test"><i class="fa fa-plus"></i> Test </button>
                        </div>

                        <div class="col-sm-1" style='margin-left:10%;' >
                            <button type="button" class="btn btn-success" ><a class="text text-light text-decoration-none" href=""><i class="fa fa-play"></i> Takeoff </a></button>
                        </div>

                        <div class="col-sm-1" style='margin-left:4%;' >
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#scan_result_modal"><i class="fa fa-stop"></i> Land </button>
                        </div>
 
                        
                        <div class="col-sm-1" style='margin-left:4%;'>
                            <button type="button" class="btn btn-danger" id="arm" style='margin-right:10%;'><i class="fa fa-undo"></i> Arm </button>
                        </div>
                        
                    </div>

                </div>
                
                <div class="card-body">
                    <table id="example" class="table table-hover table-sm nowrap" style="width:100%">
                        <thead class="thead-dark" style='text-align: center'>
                            <tr>
                                <th style="width:20%">Drone's battery</th>
                                <th style="width:40%">Drone's Connection</th>
                                <th style="width:40%">Drone's Altitude</th>
                            </tr>
                        </thead>
                        <tbody id="drone" style='text-align: center'>

                        </tbody>
                    </table>

                    <span id="response"></span>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection