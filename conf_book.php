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
                <h1>Transaction</h1>
                <table>
                    <tr>
                   <td>
                        <h2><a href="confirm.php">Confirm Flights </a></h2>   
                    </td>
                        <td><h2><a href="booking.php">Bookings</a></h2></td>
                    </tr>
				</table>
				

		 <div id="footer">
				Message Section
            <?php echo $errormessage; ?>
			</div>	
		</div>
           
	</body>
</html>
