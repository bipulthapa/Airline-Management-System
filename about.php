<!doctype html>
<html>
	<head>
		<title>Air line management system</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	
		<div id="wrapper">
			<!-- Header -->
			<div id="header">
				<?php include("includes/header.php"); ?>
			</div>

			<!-- nav-->
			<div id="nav">
				<?php include("includes/nav.php"); ?>
			</div>

			<div id="main_section">
				<div id="content">
					<?php 
						$con=@mysql_connect("localhost","root","")or die("sorry the connection couldnot be established");
						$db=@mysql_select_db("airline",$con)or die("sorry the database couldnot be selected");
						$query="SELECT * FROM `about`";
						$result=mysql_query($query);
						while($row=mysql_fetch_array($result))
						{
							$id1=$row[0];
							$title1=$row[1];
							$content1=$row[2];
					?>	
							<h3 style="color:#39F"><?php echo $title1 ?></h3>
							<?php echo $content1 ?>
					
				  <?php }?>
				</div>

				<div id="aside">
					
						The Fares data store contains fare tariffs, rule sets, routing maps, class of service tables, and some tax information that construct the price – "the fare". Rules like booking conditions (e.g. minimum stay, advance purchase, etc.) are tailored differently between different city pairs or zones, and assigned a class of service corresponding to its appropriate inventory bucket. Inventory control can also be manipulated manually through the availability feeds, dynamically controlling how many seats are offered for a particular price by opening and closing particular classes
					
				</div>
			</div>

				<div id="footer">
					copyright @ designed by sangam pokharel
				</div>


		</div>
	
</html>