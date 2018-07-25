<?php
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    $errormessage = "";

}else{
    header('location:login.php');
}

if (isset($_POST['selected_booking'])){
    $_SESSION['psid'] = $_POST['selected_booking'];
}

function test_input($data){
    $data = stripslashes($data);
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!doctype html>
<html>
	<head>
		<title>Air line management system</title>
		<link rel="stylesheet" href="css/style.css">
        <style>
            table{
                width: 100%;
            }
            th{
                background-color: #39F;
                height: 50px;
                text-align: left;
            }
            
            input[type="text"],input[type="date"],select{
                width:75%;
                display: inline-block;
                margin: 8px 0px;
                padding: 12px 2px;
            }
            
            tr:nth-child(even){
                background-color: #f1f1f3;
            }
            table tr td input[type="reset"]
                {
                    outline:none;
                    border:none;
                    padding:4px;
                    box-shadow:2px 2px 2px 2px #666;
                    border-radius:3px;
                    margin:5px;
                    position:relative;
                    transition:0.3s;
                }
            
            
           
        </style>
	</head>

	<body>
		<div id="wrapper">
			<!-- Header -->
			<div id="header">
				<?php include("includes/header.php"); ?>
			</div>

			<!-- nav-->
			<div id="nav">
				<?php include("includes/nav.php"); ?>
			</div>

			
			<!--main_section-->

			<div id="main_section">
                <div>
                <div style="font-size:24px;font-weight:bold;float:left">E-Ticket</div>
                <div style="float:right; margin-right:20%; padding:10px; background-color: #39f; cursor:pointer;" class="cancel"><a href="cancel_ticket.php" style="text-decoration:none" onclick="return confirm('Are you sure want to cancel Ticket?Once you click OK you will no longer be a ticket holder for this flight... ')">Cancel Ticket</a></div>
                    <div style="clear:both"></div>
                </div>
                <br><br>
    
                <?php 
                $psid = $_SESSION['psid'];                
                $sql = "SELECT * FROM transaction JOIN information ON transaction.passenger_id = information.psid JOIN flight_schedule ON transaction.flight_id = flight_schedule.flid JOIN route ON flight_schedule.routecode = route.routecode where psid='$psid'";
                $result = mysqli_query($con,$sql);
                if($result){
                    while($row = mysqli_fetch_array($result)){
                    ?>
                    <hr>
                    <span style="color:red"; font-size:32px;>Company</span><span style="color:blue; font-size:32px;">Airlines</span>
                    <br><br>
                    <h3>Boarding Pass</h3>
                    <br>
                    <h4>PASSENGER NAME</h4>
                    <?php 
                        $title = $row['title'];
                        $fname = $row['fname'];
                        $mname = $row['mname'];
                        $lname = $row['lname'];
                        $name = $title ." ". $fname ." ". $mname ." ".$lname;
                        echo $name;
                    ?>
            <table>
                <tr>
                    <td>FROM:</td>
                    <td>FLIGHT</td>
                    <td>DATE</td>
                    <td>DEPARTS</td>
                </tr>
                <tr>
                <th><?php echo $row['airport']; ?></th>
                <th>
                    <?php echo $row['aircraft']; ?> 
                </th>
                <th>
                    <?php echo $row['departure_date']; ?>    
                </th>
                <th>
                    <?php echo $row['departure']; ?>
                </th>
                </tr>
                <tr>
                    <td>TO</td>
                    <td>GATE</td>
                    <td>BOARDING TIME</td>
                    <td>SEAT</td>
                </tr>
                <tr>
                    <th><?php echo $row['destination']; ?></th>
                    <th>---</th>
                    <th><?php 
                        $time = $row['departure'];
                        $value = strtotime($time);
                        $new_value = $value - (2*3600);
                        $board_time = date('H:i',$new_value);
                        echo $board_time;
                        ?></th>
                        <th>---</th>
                </tr>
            </table>
                    <?php
                    }
                    
                    
                }else{
                    $errormessage = "Error in select operation CHECK: ".mysqli_error($con);
                }
                ?>
                
				<div id="aside">
					<?php include("includes/sidebar.php"); ?>
				</div>
			</div>

			<div id="footer">
                Message &nbsp;&nbsp;
				<?php echo $errormessage; ?>

			</div>

		</div>

	</body>
</html>