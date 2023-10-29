<?php

if(isset($_POST['rfid'])){

    $rfid=$_POST['rfid'];

    $conn = mysqli_connect("localhost", "root", "", "cps");

    $sql = "UPDATE items SET status='Available' WHERE rfid_id='$rfid'";

    $result=mysqli_query($conn,$sql);

    /*
    
    if($result==true){

        echo "<h5>Updated</h5>";

    }
    else{
        echo "<h3>Error!</h3>";

    }

    */
}

?>