<?php 
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    $errormessage="";
}else{
    header('location:login.php');
}

?>

<!doctype html>
<html>
	<head>
		<title>Air line management system</title>
		<link rel="stylesheet" href="css/style.css">
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
			<div id="container">
				<h2 style="margin:10px">Flight Booking</h2>
                
                <form action="searched.php" method="post">
                    <label for="radio2">One Way</label> 
                    <input type="radio" name="radio" checked="checked" id="radio2" onclick="hide()" value="2">
                    <label for="radio1">Round Trip</label>
                    <input type="radio" name="radio" id="radio1" onclick="display()" value="1">&nbsp;&nbsp;&nbsp;
                    <div>
                    <select onchange = "document.getElementById('from').value = this.options[this.selectedIndex].text" required>
                        <option value="" disabled selected>Leaving From...</option>
                        <option value="1">Kathmandu</option>
                        <option value="2">Pokhara</option>
                        <option value="3">Biratnagar</option>
                        <option value="4">Lukla</option>
                        <option value="5">Simara</option>
                        <option value="6">Bharatpur</option>
                    </select>
                    &nbsp; &nbsp;
                    <select onchange="document.getElementById('to').value=this.options[this.selectedIndex].text" required>
                        <option value="" selected disabled>Going to...</option>
                        <option value="1">Kathmandu</option>
                        <option value="2">Pokhara</option>
                        <option value="3">Biratnagar</option>
                        <option value="4">Lukla</option>
                        <option value="5">Simara</option>
                        <option value="6">Bharatpur</option>
                    </select>
                    
                    <br>
                    <label for="depart">Depart Date:</label>
                    <input type="date" id="depart" style="width:20%; margin:10px;" name="depart_date" required><br>
                    <label for="return" id="return_label">Return Date:</label>
                    <input type="date" id="return" style="width:20%; margin:10px;" name="arrival_date">
                    <br>
                    <select required onchange="document.getElementById('adult').value=this.options[this.selectedIndex].text">
                        <option value="" disabled selected>Adult</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br>
                    <select onchange="document.getElementById('child').value=this.options[this.selectedIndex].text">
                        <option value="" disabled selected>Child</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </div>
                    <br>
                    <input type="hidden" name="from" id="from" >
                    <input type="hidden" name="to" id="to">
                    <input type="hidden" name = "adult" id="adult">
                    <input type="hidden" name="child" id="child">
                    
                    &nbsp;<input type="submit"  name="submit">
                </form>
			</div>

			<!--main_section-->

			<div id="main_section">
				<div id="content">
					Content goes here!
				</div>

				<div id="aside">
					<?php include("includes/sidebar.php"); ?>
				</div>
			</div>

			<div id="footer">
				Message
                <?php echo $errormessage; ?>

			</div>

		</div>
        <script type="text/javascript">
            window.onload = hide;
            function display(){
                document.getElementById("return").required = true;
                document.getElementById("return").style.display = "block";
                document.getElementById("return_label").style.display = "block";
                
            }
            
            function hide(){
                document.getElementById("return").required = false;
                document.getElementById("return").style.display = "none";
                document.getElementById("return_label").style.display = "none";
            }
        </script>
	</body>
</html>