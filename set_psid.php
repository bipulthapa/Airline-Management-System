<?php
session_start();
require_once('includes/connect.php');
if ($_POST['submit']){
    $fare = $fuel_charge = "";
    $psid = $_POST['selected_booking'];
    $_SESSION['psid'] = $psid;
    
   //Three tables natural join
    $sql = "SELECT * FROM transaction JOIN flight_schedule on transaction.flight_id=flight_schedule.flid JOIN route ON flight_schedule.routecode=route.routecode JOIN airfare ON route.id=airfare.route WHERE transaction.passenger_id = '$psid' ";
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
    $amount = ($fare + $fuel_charge);
    $amount = 1.13 * $amount;
    $_SESSION['pay_amount'] = $amount; 
    header('location:payment.php'); 
}
?>