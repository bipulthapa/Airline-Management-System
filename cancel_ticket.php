<?php 
session_start();
require_once('includes/connect.php');
$psid = $_SESSION['psid'];

//Fine table implementation starts here

$sql_c = "SELECT * FROM passenger where passenger_id='$psid'";
$result_c = mysqli_query($con,$sql);

/*if ($result_c){
    while ($row = mysqli_fetch_array($result_c)){
        $depart_date = $row['departure_date'];
        $timestamp = strtotime($depart_date);
        $curr_timestamp = time();
        $difference = $timestamp-$curr_timestamp;
        $day = floor($difference/(86400));
        
        $sql_f = "SELECT * FROM fine ORDER BY id DESC";
        $result_f = mysqli_query($con,$sql_f);
        if ($result_f){
            while ($row_f = )
        }else{
            echo 'Error in select statement on fine table';
        }
        
    }
    
    
}else{
    echo '<script>alert("Error! CHECK :';
    echo mysqli_error.'")</script>';
}
*/

$sql = "DELETE FROM passenger WHERE psid='$psid'";
$sql1= "DELETE FROM transaction WHERE passenger_id='$psid'";
$sql2 = "DELETE FROM information WHERE psid = '$psid'";
$result = mysqli_query($con,$sql);
$result1 = mysqli_query($con,$sql1);
$result2 = mysqli_query($con,$sql2);
if ($result and $result1 and $result2){
    echo '<script>alert("Ticket has been cancelled! Redirecting...")</script>';
    header('refresh:0,url=confirm.php');
}else{
    echo '<script>alert("Couldnt delete!Check';
    echo mysqli_error($con).'");</script>';
}

?>