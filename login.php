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
				<form action=" " method="post">
					<table>
						<tr>
							<td>Username:</td>
							<td><input type="text" name="username" placeholder="Username" autocomplete="off"></td>
						</tr>
						
						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" placeholder="password" autocomplete="off"></td>
						</tr>


						<tr>
							<td><input type="submit" name="submit" value="Submit"></td>
							<td><input type="submit" name="reset" value="Reset"></td>

						</tr>

						<tr>
							<td><a href="register.php">Register your account</a></td>
						</tr>
					</table>

				</form>
				<div id="footer">
					copyright@ Designed by sangam pokharel
				</div>
			</div>
		</div>
	</body>

