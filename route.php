<?php 
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    $errormessage = $airport = $destination = $routecode = "";
    if (isset($_POST['submit'])){
        $airport = $_POST['airport'];
        $destination = $_POST['destination'];
        
        /*unique code generation*/
        
        $src = substr($airport,0,4);
        $src = ucfirst($src);
        $dest = substr($destination,0,4);
        $dest = ucfirst($dest);
        $routecode = $src ."-". $dest ;
        $sql = "INSERT INTO route (airport,destination,routecode) VALUES ('$airport','$destination','$routecode')";
        $result = mysqli_query($con,$sql);
        $_SESSION['last_id'] = mysqli_insert_id($con);
        if ($result){
            $errormessage = "Successfully added. Proceeding...Please Wait...";
            header('refresh:1,url=fare.php');
        }else{
            $errormessage = "Error in adding. CHECK:".mysqli_error($con);
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
                            <label for="airport">Airport:</label></th><td><input type="text" name="airport" id="airport" placeholder="Airport..." autocomplete="off" required>
                            </td>    
                            </tr>    
                            <tr>
                            <th>    
                            <label for="destination">Destination:</label></th>
                            <td>
                            <input type="text" name="destination" id="destination" placeholder="Destination..." autocomplete="off" required>
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