<?php 
session_start();
require_once("includes/connect.php");

if(!isset($_SESSION['username'])){
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
                width:100%;
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

			
			<!--main_section-->

			<div id="main_section">
                <h2>Available Flights</h2>
                <a href="addflight.php" style="display:inline-block"><h3>Add Flight</h3></a>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" style="display:inline">
                    <input type="submit" name="submit" style="float:right; margin:0px 10px;">
                    <input type="search" name="search" style="float:right" placeholder="Search...">
                </form>
				<table>
                    <tr>
                        <th>S.N</th>
                        <th>Aircraft Number</th>
                        <th>Capacity</th>
                        <th>Manufactured By</th>
                        <th>Manufactured On</th>
                    </tr>
                    <?php
                        $errormessage = "";
                        $sql ="SELECT * FROM aircrafts";
                        $i=1;
                        $result = mysqli_query($con,$sql);
                        if($result){
                            if (isset($_POST['submit'])){
                                $searched_key = $_POST['search'];
                                $sql = "SELECT * FROM aircrafts WHERE ac_number LIKE '%$searched_key%' or capacity LIKE '%$searched_key%' or mfdby LIKE '%$searched_key%' or mfdon LIKE '%$searched_key%' order by ac_id DESC";
                                $result = mysqli_query($con,$sql);
                            if ($result){
                                $i = 1;
                            while($row=mysqli_fetch_array($result)){
                                echo "<tr>
                                    <td>". $i++ ."</td>
                                    <td>". $row['ac_number'] ."</td>
                                    <td>". $row['capacity'] ."</td>
                                    <td>". $row['mfdby'] ."</td>
                                    <td>". $row['mfdon'] ."</td>
                                    </tr>
                                ";
                            }
                            }else{
                                $errormessage ="Error in displaying. CHECK:".mysqli_error($con);
                            }
                                
                            }else{
                            while($row=mysqli_fetch_array($result)){
                                echo "
                                    <tr>
                                    <td>". $i++ ."</td>
                                    <td>". $row['ac_number'] ."</td>
                                    <td>". $row['capacity'] ."</td>
                                    <td>". $row['mfdby'] ."</td>
                                    <td>". $row['mfdon'] ."</td>
                                    </tr>
                                ";
                            }
                        }
                        }else{
                            $errormessage = "Error in displaying data CHECK".mysqli_error($con);
                        }
                    ?>
                <?php    
                 ?>
                </table>

				<div id="aside">
					<?php include("includes/sidebar.php"); ?>
				</div>
			</div>

			<div id="footer">
				Message
                <?php echo $errormessage; ?>

			</div>

		</div>

	</body>
</html>