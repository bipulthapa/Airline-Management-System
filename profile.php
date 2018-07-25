<?php 
    session_start();
    require_once("includes/connect.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Air Line management system</title>
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

			
			<!--main_section-->

			<div id="main_section">
				<div id="content">
				    <a href="chng_password.php">Change Password</a>
                    <a href="edit_profile">Edit Profile</a>
				</div>

				<div id="aside">
					<?php include("includes/sidebar.php"); ?>
				</div>
			</div>

			<div id="footer">
				This is footer part.

			</div>

		</div>

    </body>
</html>