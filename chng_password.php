<?php 
    session_start();
    require_once('includes/connect.php');

    if (isset($_SESSION['username'])){
            $msg = "Change Password!!";
            $username = $curr_pass = $new_pass = $re_newpass = "";
            if (isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $curr_pass = $_POST['curr_pass'];
                    $new_pass = $_POST['new_pass'];
                    $re_newpass = $_POST['renew_pass'];
                
                    if (!preg_match("/^[a-zA-Z0-9._]*$/",$username)){
                        $msg = "Invalid username";
                    }
                    else{
                            if ($new_pass === $re_newpass){
                                if (md5($curr_pass) != $_SESSION['password']){
                                $msg = "Invalid Current Password";
                            }else{
                                 $pass = md5($new_pass); 
                                $sql = "SELECT username FROM register WHERE username='$username' ";
                            $result = mysqli_query($con,$sql);
                                if ((mysqli_num_rows($result) == 0) or ($username == $_SESSION['username']))
                                {
                                    $user = $_SESSION['username'];
                                    $sql = "UPDATE register SET username='$username', password = '$pass' WHERE username = '$user' ";
                                    $result = mysqli_query($con,$sql);
                                    if ($result){
                                        $msg = "Successfully changed..";
                                        echo "
                                        <script>
                                        alert('Updated Profile!Log in again!');
                                        </script>
                                        ";
                                        header('refresh:0 ; url="logout.php"');
                                    }
                                }else{
                                    $msg = "Sorry username already exists. Try another";
                                }
                                }
                            }
                            else{
                                $msg = "New password donot match";
                            }
                    }
            }     
    }
    else{
        header('Location:login.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <table>
                                <tr>
                                <td>Username:</td>
                                <td><input type="text" name="username" value = "<?php echo $_SESSION['username'] ?>" autocomplete="off"></td> 
                                </tr>    
                                <tr>
                                    <td>Current Password:</td>
                                    <td><input type="password" name="curr_pass" placeholder = "Current Password..." ></td>
                                </tr>
                                <tr>
                                    <td>New Password:</td>
                                    <td><input type="password" name = "new_pass" placeholder="New Password..."></td>
                                </tr>
                                <tr>
                                    <td>Re-New Password:</td>
                                    <td><input type="password" name = "renew_pass" placeholder="Re-Enter New Password..."></td>
                                </tr>
                        	<tr>
                                <td><input type="submit" name="submit" value="Change"></td>
                                <td><input type="submit" name="reset" value="Reset"></td>

						</tr>
                        </table>
                    </form>
				</div>

				<div id="aside">
					<?php include("includes/sidebar.php"); ?>
				</div>
			</div>

			<div id="footer">
				<?php echo $msg; ?>

			</div>

		</div>

    </body>
</html>