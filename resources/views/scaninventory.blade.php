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

                    {{ __('Scan Inventory') }}

                        <div class="col-sm-1 offset-md-4" >
                            <button type="button" class="btn btn-primary" id="addsample"><i class="fa fa-plus"></i> Add Sample </button>
                        </div>

                        <div class="col-sm-1" style='margin-left:10%;' >
                            <button type="button" class="btn btn-success" resetitemtatus><a class="text text-light text-decoration-none" href="resetitemtatus"><i class="fa fa-play"></i> Start Scan </a></button>
                        </div>

                        <div class="col-sm-1" style='margin-left:4%;' >
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#scan_result_modal"><i class="fa fa-stop"></i> Stop Scan </button>
                        </div>
 
                        
                        <div class="col-sm-1" style='margin-left:4%;'>
                            <button type="button" class="btn btn-danger" id="resetscan" style='margin-right:10%;'><i class="fa fa-undo"></i> Reset Scan </button>
                        </div>
                        
                    </div>

                </div>
                
                <div class="card-body">
                    <table id="example" class="table table-hover table-sm nowrap" style="width:100%">
                        <thead class="thead-dark" style='text-align: center'>
                            <tr>
                                <th style="width:20%">No</th>
                                <th style="width:40%">Item Code</th>
                                <th style="width:40%">Status</th>
                            </tr>
                        </thead>
                        <tbody id="rfid" style='text-align: center'>

                        </tbody>
                    </table>

                    <span id="response"></span>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection


{{--Firebase Tasks--}}

<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>

<script>

    // Initialize Firebase
    var config = {
        apiKey: "{{ config('services.firebase.apiKey') }}",
        authDomain: "{{ config('services.firebase.authDomain') }}",
        projectId: "{{ config('services.firebase.projectId') }}",
        storageBucket: "{{ config('services.firebase.storageBucket') }}",
        messagingSenderId: "{{ config('services.firebase.messagingSenderId') }}",
        appId: "{{ config('services.firebase.appId') }}",
        measurementId: "{{ config('services.firebase.measurementId') }}",
        databaseURL: "{{ config('services.firebase.databaseURL') }}"
    };

    firebase.initializeApp(config);
    var database = firebase.database();
    var lastIndex = 0;

    // Get Data
    firebase.database().ref('RoadRunner/').on('value', function (snapshot) {

        var value = snapshot.val();
        var htmls = [];
        var item_no = 1;

        $.each(value, function (index, value) {

            if (value) {

                htmls.push('<tr>\
                <td>' + item_no + '</td>\
                <td>' + value.rfid + '</td>\
        		<td>' + "<div class='badge badge-success'>Found</div>"  + '</td>\
        	    </tr>');

            }

            item_no++;
            lastIndex = index;

        });

        $('#rfid').html(htmls);

    });


    $(document).on('click','#resetscan',function(){

        firebase.database().ref('RoadRunner').remove();

    });


    $(document).on('click','#addsample',function(){


        firebase.database().ref('RoadRunner').push({ "rfid": "A19238192"})
        firebase.database().ref('RoadRunner').push({ "rfid": "A19238132"})
        

    });


</script>

<script>

    function Send_Data(){

        var ref = database.ref('RoadRunner');
        ref.on('value',gotData,errData);

        function gotData(data){

            //console.log(data.val());
            var RoadRunner = data.val();
            var keys = Object.keys(RoadRunner);
            //console.log(keys);

            for (var i=0; i<keys.length; i++){

                var k = keys[i];
                var initials = RoadRunner;
                
                var rfid = RoadRunner[k].rfid; 
                //console.log(rfid);

                var httpr = new XMLHttpRequest();
                httpr.open("POST", "./ajax/scan_update.blade.php", true);
                httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                
                httpr.onreadystatechange = function () {
                    if(httpr.readyState == 4 && httpr.status == 200) {
                        document.getElementById("response").innerHTML=httpr.responseText;
                    }
                }

                httpr.send("rfid=" + rfid);

            }

        }

    }

    function errData(){

        console.log('Error!');
        console.log(err);
    }

</script>


<!-- View Scan Results Modal -->
<div class="modal fade" id="scan_result_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Scan Completed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Click view results to see scan results
                    </br>
                    </br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="resetscan"><i class="fa fa-undo"></i> Scan Again </button>
                    <button type="button" class="btn btn-primary" onclick="Send_Data()" ><a class="text text-light text-decoration-none" href="scanresult"><i class="far fa-file-alt"></i> View Results </a></button>
                </div>

        </div>
    </div>
</div>


