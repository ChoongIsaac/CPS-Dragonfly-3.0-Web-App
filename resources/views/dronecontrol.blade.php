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
                            <button type="button" class="btn btn-danger" id="land" data-toggle="modal" data-target="#scan_result_modal"><i class="fa fa-stop"></i> Land </button>
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
    @include('pathrow')
</div>
<script>
    document.getElementById('takeoff').addEventListener('click', async function() {
        event.preventDefault();

        try {
            // Make an asynchronous POST request to the takeoff endpoint
            const response = await fetch('http://127.0.0.1:5000/takeoff', {
                method: 'POST',
               
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
    document.getElementById('land').addEventListener('click', async function() {
        event.preventDefault();

        try {
            // Make an asynchronous POST request to the takeoff endpoint
            const response = await fetch('http://127.0.0.1:5000/land', {
                method: 'POST',
            
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

    document.addEventListener('keydown', function(event) {
            console.log('Key pressed: ' + event.key); // Add this line

            var command = '';
            switch (event.key) {
                case 'ArrowUp':
                    command = 'move_forward';
                    break;
                case 'ArrowDown':
                    command = 'move_backward';
                    break;
                case 'ArrowLeft':
                    command = 'move_left';
                    break;
                case 'ArrowRight':
                    command = 'move_right';
                    break;
                case 'i':
                    command = 'move_up';
                    break;
                case 'k':
                    command = 'move_down';
                    break;
                case 'j':
                    command = 'rotate_left';
                    break;
                case 'l':
                    command = 'rotate_right';
                    break;
            }

            if (command) {
                fetch('http://127.0.0.1:5000/send_command', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            command: command
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            console.log('Command sent: ' + command);
                        } else {
                            console.error('Failed to send command: ' + command);
                        }
                    });
            }
        });

        
window.addEventListener("keydown", function(e) {
    if(["ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);
</script>
@endsection