<?php 
include "includes/connect.php";
session_start();
$_SESSION['role']="";
$errormessage = "All fields are compulsary to be filled.";
$country = $state = $street = $cell = $telephone = $email =  "";
if (isset($_POST['submit'])){
        $country = test_input(strtolower($_POST['country']));
        $state = test_input($_POST['state']);
        $street = test_input($_POST['street']);
        $email = test_input($_POST['email']);
        $cell = test_input($_POST['cell']);
        $telephone = test_input($_POST['telephone']);
        $username = $_SESSION['user_name'];
    
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errormessage = "Invalid Email";
    }else{
        if (strlen($cell) == '10'){
            $sql = "INSERT INTO country (country_name,username) VALUES ('$country','$username')";
            $result = mysqli_query($con,$sql);
        if($result){
            $last_id = mysqli_insert_id($con);
            $sql1 = "INSERT INTO address (state,street,country) VALUES ('$state','$street','$last_id')";
            $result1 = mysqli_query($con,$sql1);
            
            if ($result1){
                    $last_id = mysqli_insert_id($con);
                    $sql2 = "INSERT INTO contact_details (email,cell,telephone,address) VALUES ('$email','$cell','$telephone','$last_id')";
                    $result2 = mysqli_query($con,$sql2);
                        
                        if ($result2){
                            $errormessage = "Registration Successfull! SIgnin to continue!...";
                            echo "<script>alert('Successfully Registered! Login to continue!')</script>";
                            header('refresh:0; url="logout.php"');
                        }else{
                            $errormessage = "Error in insertion in table contact_details CHECK: ".mysqli_error($con);
                        }
            }else{
                $errormessage = "Error in insertion in table address.CHECK:".mysqli_error($con);
            }
        }else{
            $errormessage = "Error in insertion in table country Check:".mysqli_error($con);
        }
    
    }else{
        $errormessage = "Invalid Cell Number";   
    }
        
    }
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
		<title>Airline management system</title>
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

			
				<div id="container">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post" enctype="multipart/form-data" >
						<table>
                            <tr>
                                <th>Country:</th>
                                <td><input type="text" name="country" placeholder='Country Name...' required></td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td><input type="text" name="state" placeholder="State Name..." required></td>
                            </tr>
                            <tr>
                                <th>Street:</th>
                                <td><input type="text" name="street" placeholder="Street Number..." required></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><input type="text" name="email" placeholder="Email..." required></td>
                            </tr>
                            <tr>
                            <th>Cell:</th>
                                <td><input type="text" name="cell" placeholder="Cell Number..." required></td>
                            </tr>
                            <tr>
                                <th>Telephone:</th>
                                <td><input type="text" name="telephone" placeholder="Telephone Number..." required></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><input type="submit" name="submit"><input type="reset"></td>
                            </tr>
                            
													
						</table>
					</form>
				</div>
				

				<div id="footer">
					<?php echo $errormessage; ?>
				</div>
			</div>
        <script type="text/javascript">
            function get(){
                result = localStorage.getItem('username');
                document.getElementById('username').value = result;
                document.getElementById('footer').innerHTML = result;
            }
        </script>
	</body>
</html>