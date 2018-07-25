<?php 
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    $errormessage = "";
    if (isset($_POST['submit'])){
        $percentage = test_input($_POST['perc']);
        $time = test_input($_POST['time']);
        $description = test_input($_POST['desc']);
    
    $sql = "INSERT INTO fine (percentage,time,description) VALUES('$percentage','$time','$description')";
        $result = mysqli_query($con,$sql);
        if ($result){
            $errormessage = "Successfully Inserted";
        }else{
            $errormessage = "Error in insertion. CHECK : ".mysqli_error($con);
        }
    }
}else{
    header('location:login.php');
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
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
                    <h2 style="padding-left:20px">Charge</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> " >
                        <table>
                            <tr>
                                <th><label for="perc">Percentage Number</label></th>
                                <td><input type="text" name="perc" id="perc" required></td>
                            </tr>
                            <tr>
                                <th><label for="time">Time</label></th>
                                <td><input type="text" name="time" id="time" required></td>
                            </tr>
                            <tr>
                                <th><label for="desc">Description</label></th>
                                <td><input type="text" name="desc" id="desc"></td>
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