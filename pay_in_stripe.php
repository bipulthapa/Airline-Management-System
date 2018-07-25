<?php
session_start();
require_once('stripe/init.php');
require_once('includes/connect.php');


if ($_POST) {
  Stripe\Stripe::setApiKey("sk_test_cgpkhAp1Nr6SExRThM8ycLen");
  $error = '';
  $success = '';
  try {
      
    
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
    \Stripe\Charge::create(array("amount" => ($_SESSION['pay_amount']*100),
                                "currency" => "NPR",
                                "card" => $_POST['stripeToken']));
    $success = 'Your payment was successful.';
  }
  catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }

    if($success){
    echo "Payment Successfull Amount Paid:".$_SESSION['pay_amount'];
    $psid = $_SESSION['psid'];
    $sql = "UPDATE passenger SET status='paid' WHERE psid='$psid'";
    $result = mysqli_query($con,$sql);
    if($result){
        header('location:ticket.php');
    }else{
        echo "Error in update of passanger table. CHECK:".mysqli_error($con);
    }
}


}

