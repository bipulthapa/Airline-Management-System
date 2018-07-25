<?php 
session_start();
if(isset($_SESSION['username'])){
    $errormessage="";
}else{
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Air line management system </title>
        <link rel="stylesheet" href="css/style.css">
        <style>
            table{
                width:70%;
                margin: 0 auto;
                border: 1px solid black;
                border-collapse: collapse;
                border-radius: 100px;
            }
            #title{
                padding-left:90px;
            }
            th{
                border-bottom: 1px solid black;
                background-color: #39F;
                height: 50px;
            }
            td{
                padding:20px 20px 20px 30px;
                background-color: #f0f8ff;
            }
            
            .booking{
                position: relative;
                background-image: linear-gradient(#7dc5ee,#008cdd 85%,#30a2e4);
                padding: 0 2px;
                height: 30px;
                line-height: 30px;
                text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
                box-shadow: inset 0 1px 0 rgba(255,255,255,0.25);
                border-radius: 4px;
                font-size: 14px;
                color: #fff;
                font-weight: bold;
                width: 45%;
            }
            
            a{
                text-decoration: none;
                color: #fff;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <?php include("includes/header.php"); ?>
        </div>
        <div id="title"><h2 style="color=#222; text-shadow: 0px 2px 3px #555;">Book Your Flight Online!</h2></div>
        <div id="aside">
            <?php include("includes/sidebar.php"); ?>
        </div>
        <div id="main_section">
    <table>
        <tr>
        <th>Select Payment Method</th>
            <th></th>
        </tr>
        <tr>
        <td>    
        <form action="pay_in_stripe.php" method="POST">
          <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_s65pXdqVqN2JjEiqwgNGp1jP"
            data-amount="<?php echo $_SESSION['pay_amount']; ?>"
            data-name="Demo Site"
            data-description="Widget"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
          </script>
        </form>
        </td>    
        <td>    
        <div class="booking"><a href="booking.php" onclick="alert('Successfully Booked!')">Only Booking</a></div>    
        </td>    
        </tr>    
    </table>        
        </div>
        
       
    
</body>        
</html>