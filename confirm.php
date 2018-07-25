<?php 
    session_start();
    require_once('includes/connect.php');
    if (isset($_SESSION['username'])){
        $errormessage = "";

    }
    else{
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Airline management system</title>
		<link rel="stylesheet" href="css/style.css">
                <style>
            table{
                width:100%;
                border-collapse: collapse;
            }
            th,td {
                height: 50px;
                text-align: center;
                
            }
            tr{
               width:100%; 
            }
            th{
                background-color: #39F;
            }
            
            tr:nth-child(even){
                background-color:#f1f1f3;
            }
            
            a{
                margin:10px;
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

			<!-- container-->
			<div id="result">
				<h2>Confirm Flights</h2>
                <table>
                    <tr>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Departure Date</th>
                        <th>Select</th>
                    </tr>
                    <?php 
                    $contact_id = $_SESSION['contact_id'];
                    //***********************NATURAL JOIN**********************
                        $sql = "SELECT * FROM passenger JOIN transaction ON passenger.psid = transaction.passenger_id JOIN flight_schedule ON transaction.flight_id = flight_schedule.flid JOIN route ON route.routecode = flight_schedule.routecode WHERE passenger.contact = '$contact_id' AND passenger.status='paid' ORDER BY departure_date ";
                        $result = mysqli_query($con,$sql);
                    if ($result){
                        echo "<form action='ticket.php' method='post'>";
                        
                        while ($row = mysqli_fetch_array($result)){
                            echo "
                            <tr>
                            <td>".$row['airport']."</td>
                            <td>".$row['destination']."</td>
                            <td>".$row['departure_date']."</td>
                            <td><input type='radio' name='selected_booking' value='".$row['passenger_id']."'</td>
                            </tr>
                            ";
                        }
                    }else{
                        $errormessage = "Error in displaying check:".mysqli_error($con);
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="submit" name="submit">
                            <input type="reset"></td>
                    </tr>
				</table>
				

		 <div id="footer">
				Message Section
            <?php echo $errormessage; ?>
			</div>	
		</div>
           
	</body>
</html>
