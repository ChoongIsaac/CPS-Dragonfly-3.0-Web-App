@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
        .warning-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffcccc;
            color: #cc0000;
            text-align: center;
            padding: 10px;
        }
        .success-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #d4edda; /* Bootstrap success alert background color */
    color: #155724; /* Bootstrap success alert text color */
    text-align: center;
    padding: 10px;
    border-top: 1px solid #c3e6cb; /* Bootstrap success alert border color */
}

    </style>

<script>
    var droneStartTime = '';
    var droneEndTime = '';
    var detectedBarcodes = [];
    var detectedTimes = [];
    var detectedBarcodesWithTime = [];
    var missionNo = "{{$missionNo}}";

    function formatDateTime(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  const seconds = String(date.getSeconds()).padStart(2, '0');

  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

</script>
<div style="padding-top:30px;" class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">
                
                    <div class="container row">
                    <div style="padding: 5px;">

                    {{ __('Drone Control') }} 

                        <button type="button" class="btn btn-outline-info btn-sm" style="width:2rem; height:2rem; padding-right:0.2rem;" data-toggle="modal" data-target="#info_modal" ><i class="fa fa-info"></i></button>
                    </div>
                        <div class="col-sm-1 offset-md-4" >
                            <button type="button" class="btn btn-danger" id="reset"><i class="fa fa-undo"></i> Reset</button>
                        </div>

                        <div class="col-sm-1" style='margin-left:4%;' >
                            <button type="button" class="btn btn-success" id="takeoff" ><a class="text text-light text-decoration-none" href=""><i class="fa fa-play"></i> Takeoff </a></button>
                        </div>

                        <div class="col-sm-1" style='margin-left:4%;' >
                            <button type="button" class="btn btn-danger" id="land" data-toggle="modal" ><i class="fa fa-stop"></i> Land </button>
                        </div>
 
                        
                        <div class="col-sm-1" style='margin-left:4%;'>
                            <button type="button" class="btn btn-primary" id="qr_navigate" style='margin-right:10%;'><i class="fas fa-qrcode "></i> QR Navigate</button>
                        </div>
                        
                    </div>

                </div>
                <span id="response"></span>
                <div class="card-body">
                    <table id="example" class="table table-hover table-sm nowrap" style="width:100%">
                        <thead class="thead-dark" style='text-align: center'>
                            <tr>
                                <th style="width:50%">Detected QR Codes</th>
                                <th style="width:50%">Dectected time</th>
                                
                            </tr>
                        </thead>
                        <tbody id="result" style='text-align: center'>
                                
                        </tbody>
                    </table>

                    
                    <div class="container row">
                        <div class="col-sm-1" style='margin-left:90%;' >
                            <button type="button" class="btn btn-success" id="upload" data-toggle="modal" data-target="#save_result_modal" ><i class="fas fa-cloud-upload-alt"></i> Upload</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2> Monitor Drone </h2>
            <img id="video-stream" src="http://127.0.0.1:5000/video_feed" alt="Video Stream is not available, drone is disconnected" width="720" height="420">
        </div>
        <div class="col-md-4 " >
            @include('pathplanning')
        </div>
    </div>

    <div class="modal fade" id="info_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                    <h5 class="modal-title">How to control your drone?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div id="drone-instructions">
                        <ul>
                            <li>Press Arrow UP to move forward</li>
                            <li>Press Arrow DOWN to move backward</li>
                            <li>Press Arrow LEFT to move left</li>
                            <li>Press Arrow RIGHT to move right</li>
                            <li>Press I to move upward</li>
                            <li>Press k to move downward</li>
                            <li>Press J to rotate left</li>
                            <li>Press L to rotate right</li>
                        </ul>
                    <p> Please put the drone to 58.5 cm away to get optimized scanning</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- View Scan Results Modal -->
<div class="modal fade" id="save_result_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Flight Completed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Click Save results to save results into database
                    </br>
                    <div class="form-group">
                    <label for="missionId">Mission ID:</label>
                    <input type="text" class="form-control" id="missionId" placeholder="Enter Mission ID" required>
                    <small class="text-danger" id="missionIdError"></small>

                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveresult" ><a class="text text-light text-decoration-none" href="flightreview"><i class="far fa-file-alt"></i> Save Results </a></button>
                </div>

        </div>
    </div>
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
            startTime = new Date();
            droneStartTime = formatDateTime(startTime);
            console.log(droneStartTime);

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
            // Make an asynchronous POST request to the land endpoint
            const response = await fetch('http://127.0.0.1:5000/land', {
                method: 'POST',
            
            });

            const data = await response.json();
            endTime = new Date();
            droneEndTime = formatDateTime(endTime);
            // Handle the response data if needed
            console.log(data);
            document.getElementById('response').innerText = 'Land request sent!';
        } catch (error) {
            // Handle errors
            console.error('Error:', error);
            document.getElementById('response').innerText = 'Error sending LANDING request';
        }
    });

    document.getElementById('qr_navigate').addEventListener('click', async function() {
        event.preventDefault();
        startTime = new Date();
        droneStartTime = formatDateTime(startTime);

        try {
            // Make an asynchronous POST request to the takeoff endpoint
            const response = await fetch('http://127.0.0.1:5000/qrcode_navigate', {
                method: 'POST',
            //     headers: {
            //     'Content-Type': 'application/json', 
            // },
            
            });

            // const data = await response.json();

            // Handle the response data if needed
            // console.log(data);
            document.getElementById('response').innerText = 'QR_CONTROL request sent!';
        } catch (error) {
            // Handle errors
            console.error('Error:', error);
            document.getElementById('response').innerText = 'Error sending QR_CONTROL request';
        }
        endTime = new Date();
        droneEndTime = formatDateTime(endTime);
    });
   

// Example usage

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



var videoStream = document.getElementById("video-stream");
        //var barcodeList = document.getElementById("barcode-list");
        var tableBody = document.getElementById("result");

            function updateBarcode() {
                fetch("http://127.0.0.1:5000/read_scan_code")
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() !== "") {
                            if (!detectedBarcodes.includes(data)) {
                                detectedBarcodes.push(data);
                                time = new Date();
                                detectedTime = formatDateTime(time);
                                
                                // Create a new object with detected QR code and time
                            var barcodeObject = {
                                detected_qr_code: data,
                                detected_time: detectedTime
                            };


                                 // Add the object to your array
                                detectedBarcodesWithTime.push(barcodeObject);

                                 // Create a new table row
                                var row = tableBody.insertRow(0);

                                // Create cells for QR Codes and Detected time
                                var cell1 = row.insertCell(0);
                                var cell2 = row.insertCell(1);

                                // Set the text content of the cells
                                cell1.textContent = data;
                                cell2.textContent = barcodeObject.detected_time;
                                detectedTimes.push(barcodeObject.detected_time);
                            }
                        }
                    });

            }
        
        // Update barcode data every 1 second
         setInterval(updateBarcode, 1000);
        
        console.log(detectedBarcodes);

        // Reset detectedBarcodes array when the page is unloaded (refresh button clicked)
        window.addEventListener('unload', function() {
            detectedBarcodes = [];
            
            const reset = fetch('http://127.0.0.1:5000/reset_scan_code', {
                method: 'POST',
                async: false,  // Make the request synchronous
            });

            if (reset.ok) {
                console.log('QR reset');
            } else {
                console.error('Failed to reset frame');
            }

            
        });

        // Register click event for the button
        document.getElementById('reset').addEventListener('click', function() {
        
            // Reload the page
            location.reload();
        });

        document.getElementById('saveresult').addEventListener('click', async function() {
         event.preventDefault();
         const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
         

        try {
             // Assuming drone start and end times are stored in JavaScript variables
            // const droneStartTime = '2023-12-10 12:00:00'; // Replace with your actual value
            // const droneEndTime = '2023-12-10 13:00:00'; // Replace with your actual value

            // Call the drone backend API to get the flight path
            const droneApiResponse = await fetch('http://127.0.0.1:5000/flight_path');
            const  flight_path = await droneApiResponse.json();
            console.log('flightPath:', flight_path);

            // Get the detected barcodes from the JavaScript array
            const detectedBarcodes = getDetectedBarcodes(); // Replace with your actual function
            const missionIdInput = document.getElementById('missionId');
            const missionId = missionIdInput.value;
            // Validate Mission ID
        if (!missionId.trim()) {
            missionIdError.textContent = 'Mission ID is required.';
            return;
        } else {
            missionIdError.textContent = ''; // Clear error message
        }
            // Trigger API call to save results to your Laravel backend
            const saveResponse = await fetch("{{ route('saveresult') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Add any other headers needed
                    'X-CSRF-TOKEN': csrfToken
                },
                
                body: JSON.stringify({
                    mission: {
                         mission_id: missionId,
                         start_time: droneStartTime,
                         end_time: droneEndTime,
                         flight_path: flight_path
                    },
                    flight_details: getFlightDetailsObject().flight_detail
                }),
            });

            if (!saveResponse.ok) {
            throw new Error(`HTTP error! Status: ${saveResponse.status}`);
        }

        // Display success banner
        showSuccessBanner('Request successful. Flight results saved.');

        // Dismiss the modal
        const closeButton = document.querySelector('#save_result_modal .close');
        if (closeButton) {
            closeButton.click();
        }

            // const saveResult = await saveResponse.json();

            // Perform actions after saving to the database if needed

            // Log or display the result of saving
            // console.log(saveResult);

        } catch (error) {
            // Handle errors
            showWarningBanner(error);
            console.error('Error:', error);
        }
    });

    function showWarningBanner(message) {
    // Create a div element for the warning banner
    const warningBanner = document.createElement("div");
    warningBanner.className = "warning-banner";
    warningBanner.textContent = message;

    // Append the warning banner to the body
    document.body.appendChild(warningBanner);

    // Set a timeout to remove the banner after a certain period (e.g., 5 seconds)
    setTimeout(() => {
        document.body.removeChild(warningBanner);
    }, 5000); // Adjust the time as needed
}
function showSuccessBanner(message) {
    const successBanner = document.createElement("div");
    successBanner.className = "success-banner";
    successBanner.textContent = message;

    // Append the success banner to the body
    document.body.appendChild(successBanner);

    // Remove the success banner after a few seconds (adjust the timeout as needed)
    setTimeout(() => {
        document.body.removeChild(successBanner);
    }, 5000); // 5000 milliseconds (5 seconds)
}
    function getDetectedBarcodes() {
        return detectedBarcodes; // Replace with your logic
    }

    function getDetectedTimes(){
        return getDetectedTimes;
    }
    function getFlightDetailsObject() {
    return {
        flight_detail: detectedBarcodesWithTime
    };
}


</script>



<!-- Include the Socket.IO library -->
<script src="https://cdn.socket.io/4.1.3/socket.io.min.js"></script>

<script>
    // Connect to the Flask server's Socket.IO endpoint
    const socket = io('http://your-flask-server-address');

    // Listen for the 'battery_status' event
    socket.on('battery_status', function (batteryStatus) {
        console.log('Battery Status:', batteryStatus);
        // Handle the battery status as needed (update UI, etc.)
    });
</script>

@endsection