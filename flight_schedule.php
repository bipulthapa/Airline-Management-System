<?php 
session_start();
require_once("includes/connect.php");

if(isset($_SESSION['username'])){
    $errormessage = $flight_day = $departure = $arrival = "";
        
    if (isset($_POST['submit'])){
        $flight_day = strtolower($_POST['flight_day']);
        $departure = $_POST['departure'];
        $arrival = $_POST['arrival'];
        $aircraft_num = $_POST['aircraft_num'];
        $source = ucfirst(strtolower($_POST['source']));
        $dest = ucfirst(strtolower($_POST['dest']));
        $route_code = $source."-".$dest; 
        
        $sql = "INSERT INTO flight_schedule (flight_day,departure,arrival,aircraft,routecode) VALUES('$flight_day','$departure','$arrival','$aircraft_num','$route_code')";
        $result = mysqli_query($con,$sql);
        if ($result){
            $errormessage = "Successfully Added !";
            echo "
            
            <script>
                alert('Successfully Added');
            </script>
            
            ";
        }else{
            $errormessage = "Error in Insertion! Check:".mysqli_error($con);
        }
    }

}else{
    header('location:login.php');
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

			
			<!--main_section-->

			<div id="main_section">
				<div id="form">
                    <h2 style="padding-left:20px">Flight Schedule</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> " name="formName">
                        <table>
                            <tr>
                                <th>Aircraft Num:</th>
                                <td><input type="text" name="aircraft_num" placeholder="Aircraft Num..." maxlength="4"></td>
                            </tr>
                            <tr>
                            <th>Flight Week Day:</th>
                            <td><input type="text" name="flight_day" placeholder="Flight Day..."></td>    
                            </tr>    
                            <tr>
                                <th>Departure</th>
                                <td><input type="time" name="departure"></td>
                            </tr>
                            <tr>
                                <th>Arrival</th>
                                <td><input type="time" name="arrival"></td>
                            </tr>
                            <tr>
                                <th>Route Code:</th>
                                <td><input type="text" name="source" style="width:5.5%" maxlength="4" size="4" oninput="autotab(this,document.formName.dest)" placeholder="____ " required>&nbsp; - &nbsp;
                               <span style="display:inline-block"><input type="text" name="dest" maxlength="4" size="4" placeholder="____" required></span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th><input type="submit" name="submit">
                                <input type="reset" name="reset">
                                </th>
                                
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
        <script type="text/javascript">
        function autotab(current,to){
            if (current.getAttribute("maxlength")==current.value.length){
                to.focus();
            }
        }
           
        </script>
	</body>
</html>