<?php 
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
   $errormessage = $source = $dest = $depart_date = $arrival_date = $adult_num = $child_num =$search_key_1 = $code_dept = $search_key_2 = $code_return = "";    
    if (isset($_POST['submit'])){
            $checked = $_POST['radio'];
            $source = test_input($_POST['from']);
            $dest = test_input($_POST['to']);
            $depart_date = $_POST['depart_date'];
            $arrival_date = $_POST['arrival_date'];
            
            $_SESSION['depart_date'] = $depart_date;                                //depart date session variable storage
            $_SESSION['adult_num'] = $_POST['adult'];
            $_SESSION['child_num'] = $_POST['child'];
        
        $date_depart=strtotime($depart_date);
        $search_key_1 = strtolower(date('l',$date_depart));
        
        //code-generated for search
        
        $source = ucfirst(strtolower(substr($source,0,4)));
        $dest = ucfirst(strtolower(substr($dest,0,4)));
        $code_dept = $source."-".$dest;
        
         if ($checked =='1'){
        $date_arrival = strtotime($arrival_date);
        $search_key_2 = date('l',$date_arrival);
        $code_return = $dest."-".$source;
         }
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
                width:100%;
                border-collapse: collapse;
            }
            th,td {
                height: 50px;
                text-align: center;
                
            }
            tr{
               width:100%; 
            }
            th{
                background-color: #39F;
            }
            
            tr:nth-child(even){
                background-color:#f1f1f3;
            }
            
            a{
                margin:10px;
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

	       <div id="result">
                <h2>Search Results:</h2>
               
               <table>
                <tr>
                    <th>Flight No.</th>
                    <th>Depart</th>
                    <th>Arrive</th>
                    <th>Fare</th>
                    <th>Select</th>
                </tr>
                <?php 
                   
                //****** Natural join of 3 tables *********
                   
                $sql = "SELECT * FROM flight_schedule JOIN route ON flight_schedule.routecode=route.routecode JOIN airfare ON route.id=airfare.route WHERE flight_schedule.flight_day='$search_key_1' AND flight_schedule.routecode='$code_dept' ORDER BY departure";
                   $result = mysqli_query($con,$sql);
                   if ($result){
                       echo "<form action='passenger_info.php' method='post'>";
                       while($row=mysqli_fetch_array($result)){
                           $fare = $row['fare']+$row['fuel_charge'];
                       echo "
                        <tr>
                        <td>".$row['aircraft']."</td>
                        <td>".$row['departure']."</td>
                        <td>".$row['arrival']."</td>
                        <td>".$fare."</td>
                        <td><input type='radio' name='selected_choice' value='".$row['flid']."' required><td>
                        </tr>
                       ";
                          
                   }
                    echo "
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    <input type='submit' name='submit'>
                    <input type='reset'>
                    </td>
                    </tr>
                    </form>
                    ";   
                   }else{
                       $errormessage = "Error in displaying result CHECK: ".mysqli_error($con);
                   }
                       
                   ?>   
               </table>
            </div>

			<!--main_section-->

			<div id="main_section">


				<div id="aside">
					<?php include("includes/sidebar.php"); ?>
				</div>
			</div>

			<div id="footer">
                Message
				<?php echo $errormessage; ?>

			</div>

		</div>

	</body>
</html>