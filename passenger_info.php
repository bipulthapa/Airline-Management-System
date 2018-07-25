<?php
 //$value = $_POST['selected_choice'];
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    
    $errormessage = "";
    if (isset($_POST['submit'])){
        $_SESSION['flid'] = $_POST['selected_choice'];                                              //User selected choice flight id
    }
    if (isset($_POST['continue'])){
        for ($i=0; $i<$_SESSION['adult_num']; $i++){
            $title[$i] = $_POST["title$i"];
            $firstname[$i] = test_input($_POST["firstname$i"]);
            $middlename[$i] = test_input($_POST["middlename$i"]);
            $lastname[$i] = test_input($_POST["lastname$i"]);
            $age[$i] = $_POST["age$i"];
            $nationality[$i] = $_POST["nationality$i"];
        }
        
        for ($j=0; $j<$_SESSION['child_num']; ++$j){
            $ch_title[$j] = $_POST["ch_title$j"];
            $ch_firstname[$j] = test_input($_POST["ch_firstname$j"]);
            $ch_middlename[$j] = test_input($_POST["ch_middlename$j"]);
            $ch_lastname[$j] = test_input($_POST["ch_lastname$j"]);
            $ch_age[$j] = $_POST["ch_age$j"];
            $ch_nationality[$j] = $_POST["ch_nationality$j"];
        }
        $username = $_SESSION['username'];
        $sql =  "SELECT * FROM country JOIN address ON country.id=address.country JOIN contact_details ON contact_details.address=address.country WHERE country.username = '$username'";
        $result = mysqli_query($con,$sql);
        if($result){
            while($row=mysqli_fetch_array($result)){
                $_SESSION['contact_id'] = $row['cnt_id'];
            }
        }
        $contact_id = $_SESSION['contact_id'];
        
        $sql = "INSERT INTO passenger(contact,status) VALUES ('$contact_id','booking') ";
        $result = mysqli_query($con,$sql);
        $last_id = mysqli_insert_id($con);
        $_SESSION['psid'] = $last_id;                                                           //stores last passenger id
        if (!$result){
            $errormessage = "Error in insertion in passenger table CHECK".mysqli_error($con);
        }
        for ($i=0; $i<$_SESSION['adult_num']; ++$i){
            $sql = "INSERT INTO information (psid,title,fname,mname,lname,age,nationality) VALUES ('$last_id','$title[$i]','$firstname[$i]','$middlename[$i]','$lastname[$i]','$age[$i]','$nationality[$i]')";
            $result = mysqli_query($con,$sql);
            if(!$result){
                $errormessage = "Error in insertion Check:".mysqli_error($con);
            }
        }
        
        for($j=0; $j<$_SESSION['child_num'];++$j){
            $sql = "INSERT INTO information (psid,title,fname,mname,lname,age,nationality) VALUES ('$last_id','$ch_title[$j]','$ch_firstname[$j]','$ch_middlename[$j]','$ch_lastname[$j]','$ch_age[$j]','$ch_nationality[$j]')";
            $result = mysqli_query($con,$sql);
            if(!$result){
                echo "Error in insertion Check:".mysqli_error($con);
            }
        }
        header('location:transaction.php');
    }

}else{
    header('location:login.php');
}

function test_input($data){
    $data = stripslashes($data);
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
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
            th{
                background-color: #39F;
                height: 50px;
            }
            input[type="text"],input[type="date"],select{
                width:75%;
                display: inline-block;
                margin: 8px 0px;
                padding: 12px 2px;
            }
            
            tr:nth-child(even){
                background-color: #f1f1f3;
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
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> " >
                        <input type="hidden" name="title" id="title" value=""> 
                        <input type="hidden" name="nationality" id="nationality" value="">
                        <table>
                               <tr>
                                <th></th>
                               <th>Title</th>
                               <th>First Name</th>
                               <th>Middle Name</th>
                               <th>Last Name</th>
                               <th>Age</th>
                               <th>Nationality</th>
                                </tr>
                            <?php 
                               for($i=0;$i<$_SESSION['adult_num'];++$i){
                               ?>
                               <tr>
                               <td>Adult <span style="color:red">Required</span></td>
                               <td>
                               <select onchange="document.getElementsByClassName('title')[<?php echo $i;?>].value = this.options[this.selectedIndex].text">
                                <option value="" disabled selected>--Title--</option>
                                   <option value="1">Mr.</option>
                                   <option value="2">Mrs.</option>
                                   <option value="3">Ms.</option>
                               </select>
                               </td>
                               <td>
                                    <input type="text" name="firstname<?php echo $i; ?>" placeholder="First Name..." required>   
                               </td>
                               <td>
                                <input type="text" name="middlename<?php echo $i; ?>" placeholder="Middle Name..." >
                               </td>
                                <td>
                                <input type="text" name="lastname<?php echo $i; ?>" placeholder="Last Name..." required>
                               </td>
                                 <td>
                                <input type="text" name="age<?php echo $i; ?>" placeholder="Age..." required>
                               </td>   
                                <td>
                                <select onchange="document.getElementsByClassName('nationality')[<?php echo $i; ?>].value = this.options[this.selectedIndex].text">
                                    <option value="">--Nationality--</option> 
                                    <option value="1">Nepali</option>
                                    <option value="2">Others</option>
                                </select>
                               </td>
                               </tr>
                            <input type="hidden" class="title" name="title<?php echo $i;?>" value="">
                            <input type="hidden" class="nationality" name="nationality<?php echo $i; ?>" value="">
                               <?php
                               }
                               
                          for ($j=0 ; $j<$_SESSION['child_num'];++$j){
                              ?>
                               <tr>
                               <td>Child <span style="color:red">Required</span></td>
                               <td>
                               <select onchange="document.getElementsByClassName('ch_title')[<?php echo $j; ?>].value = this.options[this.selectedIndex].text">
                                <option value="" disabled selected>--Title--</option>
                                   <option value="1">Mstr.</option>
                                   <option value="2">Miss.</option>
                               </select>
                               </td>
                               <td>
                                    <input type="text" name="ch_firstname<?php echo $j; ?>" placeholder="First Name..." required>   
                               </td>
                               <td>
                                <input type="text" name="ch_middlename<?php echo $j; ?>" placeholder="Middle Name..." >
                               </td>
                                <td>
                                <input type="text" name="ch_lastname<?php echo $j; ?>" placeholder="Last Name..." required>
                               </td>
                                 <td>
                                <input type="text" name="ch_age<?php echo $j; ?>" placeholder="Age..." required>
                               </td>   
                                <td>
                                <select onchange="document.getElementsByClassName('ch_nationality')[<?php echo $j ?>].value = this.options[this.selectedIndex].text">
                                    <option value="" >--Nationality--</option>
                                    <option value="1">Nepali</option>
                                    <option value="2">Others</option>
                                </select>
                               </td>
                               </tr>
                                <input type="hidden" class="ch_title" name="ch_title<?php echo $j;?>" value="">
                                <input type="hidden" class="ch_nationality" name="ch_nationality<?php echo $j;?>" value="">
                               <?php
                               }
                               ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="submit" name="continue" value="Continue"></td>
                                    <td><input type="reset"></td>
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