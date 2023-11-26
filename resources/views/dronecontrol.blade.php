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
                            <button type="button" class="btn btn-success" id="takeoff" ><a class="text text-light text-decoration-none" href=""><i class="fa fa-play"></i> Takeoff </a></button>
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
    <img id="video-stream" src="http://127.0.0.1:5000/video_feed" alt="Video Stream is not available, drone is disconnected" width="960" height="720">

</div>
<script>
    document.getElementById('takeoff').addEventListener('click', async function() {
        console.log("takeoff is clicked");
        event.preventDefault();

        try {
            // Make an asynchronous POST request to the takeoff endpoint
            const response = await fetch('http://127.0.0.1:5000/test', {
                method: 'GET',
                //mode: 'no-cors'
                // Add headers if needed
                // headers: {
                //     'Content-Type': 'application/json',
                //     // other headers...
                // },
                // Add body if needed
                // body: JSON.stringify({ key: 'value' }),
            });

            const data = await response.json();

            // Handle the response data if needed
            console.log(data);
            document.getElementById('response').innerText = 'Takeoff request sent!';
        } catch (error) {
            // Handle errors
            console.error('Error:', error);
            document.getElementById('response').innerText = 'Error sending takeoff request';
        }
    });
</script>
@endsection