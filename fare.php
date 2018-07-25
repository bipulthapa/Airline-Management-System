<?php 
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    $errormessage = $fare = $fuel_charge = "";
    
    if (isset($_POST['submit'])){
        $fare = $_POST['fare'];
        $fuel_charge = $_POST['fuel_charge'];
        $route = $_SESSION['last_id'];
        $sql = "INSERT INTO airfare (route,fare,fuel_charge) VALUES ('$route','$fare','$fuel_charge')";
        $result =  mysqli_query($con,$sql);
        if($result){
            $errormessage = "Successfully added!";
        }else{
            $errormessage = "Error in addition CHECK:".mysqli_error($con);
        }
    }

}else{
    header('location:login.php');
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
            input[type="text"],input[type="date"]{
                width:75%;
                display: inline-block;
                margin: 8px 0px;
                padding: 12px 2px;
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
				<div id="form">
                    <h2 style="padding-left:20px">Route</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> " >
                        <table>
                            <tr>
                            <th>    
                            <label for="fare">Fare:</label></th><td><input type="text" name="fare" id="fare" placeholder="Fare..." autocomplete="off" required>
                            </td>    
                            </tr>    
                            <tr>
                            <th>    
                            <label for="fuel_charge">Fuel Charge:</label></th>
                            <td>
                            <input type="text" name="fuel_charge" id="fuel_charge" placeholder="Fuel Charge..." autocomplete="off" required>
                            </td>    
                            </tr>
                            <tr>
                            <td></td>
                            <td><input type="submit" name="submit"><input type="reset"></td>    
                            </tr>
                        </table>    
                    </form>
                </div>
                
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