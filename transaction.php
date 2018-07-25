<?php
 //$value = $_POST['selected_choice'];
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    
    $errormessage = $departure_date = $fare = $fuel_charge = "";
    $flid = $_SESSION['flid'];
    $depart_date = $_SESSION['depart_date'];
    $passenger_id = $_SESSION['psid'];
    $flight = $_SESSION['flid'];
    
    //total price calculation
    $total_num = $_SESSION['adult_num']+$_SESSION['child_num'];
    
    //Three tables natural join
    $sql = "SELECT * FROM flight_schedule JOIN route ON flight_schedule.routecode=route.routecode JOIN airfare ON route.id=airfare.route WHERE flight_schedule.flid = '$flight' ";
    $result =  mysqli_query($con,$sql);
    if ($result){
        while($row = mysqli_fetch_array($result)){
            $fare = $row['fare'];
            $fuel_charge = $row['fuel_charge'];
        }
    }
    else{
        echo "Error in selection .Check:".mysqli_error($con);
    }
    
    $amount = $total_num * ($fare + $fuel_charge);
    $amount = 1.13 * $amount;
    $_SESSION['pay_amount'] = $amount;
    
    
    $sql = "SELECT * FROM flight_schedule WHERE flid='$flid'";
    $result = mysqli_query($con,$sql);
    if ($result){
        while($row = mysqli_fetch_array($result)){
            $departure_date = $row['departure'];
        }
    }
    else{
        echo "Error in selection CHECK:".mysqli_error($con);
    }
    
  $sql = "INSERT INTO transaction (departure_date,passenger_id,flight_id,total) VALUES ('$depart_date','$passenger_id','$flight','$amount')";
    $result = mysqli_query($con,$sql);
    if (!$result){
        echo "Error in insertion in transaction. CHECK:".mysqli_error($con);
    }
    header('location:payment.php'); 
    
}else{
    header('location:login.php');
}

?>
