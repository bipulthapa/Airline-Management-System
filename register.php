<!doctype html>
<html>
	<head>
		<title>Airline management system</title>
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
					<form action=" " method="post" enctype="multipart/form-data">
						
						<table>
							
							<tr>
								<td>Name:</td>
								<td><input type="text" name="name" placeholder="Name" autocomplete="off"></td>
							</tr>

							<tr>
								<td>Username</td>
								<td><input type="text" name="username" placeholder="Username" autocomplete="off"></td>
							</tr>

							<tr>
								<td>Password:</td>
								<td><input type="password" name="password" placeholder="password" autocomplete="off"></td>
							</tr>

							<tr>
								<td>Confirm Password:</td>
								<td><input type="password" name="confirm" placeholder="Confirm password" autocomplete="off"></td>
							</tr>
							
							<tr>
								<td>Mobile:</td>
								<td><input type="text" name="mobile" placeholder="Mobile" autocomplete="off"></td>
							</tr>
							
							<tr>
								<td>Email:</td>
								<td><input type="email" name="email" placeholder="E-mail" autocomplete="off"></td>
							</tr>
							
							<tr>
								<td>Date Of Birth:</td>
								<td><input type="text" name="date" placeholder="Date of birth" autocomplete="off"></td>
							</tr>

							<tr>
								<td>Address Line 1</td>
								<td><input type="text" name="Line 1" placeholder="Address Line 1" autocomplete="off"></td>
							</tr>

							<tr>
								<td>Address Line 2</td>
								<td><input type="text" name="Line 2" placeholder="Adderss Line 2 " autocomplete="off"></td>
							</tr>

							<tr>
				   				<td>City:</td>
				   				
				   				<td>
				   				<select>
				   					<option disabled="on" selected>Please Select Your City</option>
				   					<option>Kathmandu</option>
				   					<option>Biratnagar</option>
				   					<option>Vairawa</option>

				   				</select>
				   				</td>
			   				<tr>

							<tr>
				   				<td>State:</td>
				   				
				   				<td>
				   				<select>
				   					<option disabled="on" selected>Please Select Your State</option>
				   					<option>EDR</option>
				   					<option>CDR</option>
				   					<option>FWDR</option>

				   				</select>
				   				</td>
			   				</tr>
							
							<tr>
								<td>Country:</td>
								<td><input type="text" name="country" placeholder="country" autocomplete="off"></td>
							</tr>

							<tr>
								<td>Photo</td>
								<td><input type="file" name="image"></td>
							</tr>

							<tr>
								<td>
									<input type="submit" name="submit" value="Submit">
									<input type="submit" name="reset" value="Reset">
								</td>
							</tr>
						
						</table>
					</form>
				</div>
				

				<div id="footer">
					copyright @ designed by sangam pokharel
				</div>
			</div>
	</body>
</html>