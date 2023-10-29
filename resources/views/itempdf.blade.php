<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Item Details</title>

    <style>

        h2,h3,h5 {
            text-align: center;
            font-family: arial, sans-serif;
        }

        .rfidtext {
            color: #828282;
        }


        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
            width: 90%;
            font-size:18px;
        }

        td,th {
            border: 1px solid #4B4B4B;
            text-align: left;
            padding: 15px;
            height: 3%;
        }

        .square {
            
            margin: auto;
            margin-top: 70px;
            height: 300px;
            width: 300px;
            border-style: solid;
            border-width: 1px;
            border-radius: 10px;
            border-color: #828282;

            text-align: center;
        }

        
        
    </style>
</head>

<body>
    <h2>PRESTIGE ATLANTIC ASIA</h2>
    <h3>Pallet Label</h3>
    <br>
    <br>

    <table>
        <tr>
            <th>Item Name</th>
            <td>{{$item->item_name}}</td>
        </tr>
        <tr>
            <th>Item Code</th>
            <td>{{$item->rfid_id}}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{$item->quantity}}</td>
        </tr>
        <tr>
            <th>Customer</th>
            <td>{{$item->customer}}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td></td>
        </tr>
        <tr>
            <th>Check In Date</th>
            <td>{{date('d-m-Y h:i A', strtotime($item->checkInDate))}}</td>
        </tr>
        <tr>
            <th>Check Out Date</th>
            <td>{{date('d-m-Y h:i A', strtotime($item->checkOutDate))}}</td>
        </tr>

    </table>

    <div class="square">
        <h3 class="rfidtext"> RFID </h3>
        <h5 class="rfidtext"> {{$item->rfid_id}} </h5>
    </div>

</html>