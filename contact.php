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

			<div id="container">
				<form>
					<table>
						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" placeholder="Name" autocomplete="off"></td>
						</tr>

						<tr>
							<td>Company:</td>
							<td><input type="text" name="name" placeholder="Company" autocomplete="off"></td>
						</tr>

						<tr>
							<td>E-mail:</td>
							<td><input type="text" name="name" placeholder="E-mail" autocomplete="off"></td>
						</tr>

						<tr>
							<td>Price:</td>
							<td><input type="text" name="name" placeholder="Price" autocomplete="off"></td>
						</tr>

						<tr>
							<td>Message:</td>
							<td><textarea></textarea></td>
						</tr>

						<tr>
							<td><input type="submit" name="submit" value="Submit"></td>
							<td><input type="submit" name="reset" value="Reset"></td>
						</tr>
					</table>
				</form>
			</div>

			<div id="footer">
				copyright@-Designed by Sangam Pokharel
			</div>


		</div>
	</body>