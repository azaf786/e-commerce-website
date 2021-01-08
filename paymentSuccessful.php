<?php
include 'credentials.php';
include 'headerZashas2.php';
$username= $_SESSION['username'];
?>
<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>


</style>
<!------ Include the above in your HEAD tag ---------->
<?php
$selectUserId= "SELECT cust_id FROM users WHERE username = '$username'";
$resultUserId = mysqli_query($connection, $selectUserId);
$user_id_row = mysqli_fetch_assoc($resultUserId);
$user_id_selected = $user_id_row['cust_id'];


$selectCust= "SELECT * FROM customer WHERE cust_id = '$user_id_selected'";
$resultCust = mysqli_query($connection, $selectCust);
$cust_row = mysqli_fetch_assoc($resultCust);
$fname = $cust_row['firstName'];
$lname = $cust_row['lastName'];
$email = $cust_row['email'];

$OrderQuery = "SELECT * FROM orders WHERE cust_id = '$user_id_selected' ORDER BY order_id DESC";
$resultOrder = mysqli_query($connection, $OrderQuery);
$order_row = mysqli_fetch_assoc($resultOrder);
$order_total = $order_row['total'];
$orderNo = $order_row['order_id'];






?>




<div class="cardss bg" style="background-color: #01718f">
    <h1 class="card__msg" style="color: #ccfdce">Payment Complete</h1>
    <h2 class="card__submsg" style="color: #ccfdce">Thank you for your transfer</h2>
    <div class="successful-card" style="padding-right: 35px" >


        <div style="padding-right: 50px" class="card__body">
            <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                <div class="swal2-success-circular-line-left" style="background-color: #f8f6f6;"></div>
                <span  class="swal2-success-line-tip"></span>
                <span  class="swal2-success-line-long"></span>
                <div class="swal2-success-ring"></div>
                <div class="swal2-success-fix" style="background-color: #f8f6f6;"></div>
                <div class="swal2-success-circular-line-right" style="background-color: #f8f6f6;"></div>

            </div>
            <center><a class="btn btn-block" style="color: white; background-color: lightgreen" href="myProfile.php"><strong>View Order</strong></a></center>
            <br>

            <div class="recipient-info">
                <p class="recipient"><?php echo $fname." " . $lname ?></p>
                <p class="email"><?php echo $email ?></p>
            </div>

            <h1 class="cardPrice"><span>£</span><?php echo $order_total ?></h1>
            <p class="cardMethod">Payment method</p>
            <div class="card__payment">
                <div class="card__card-details">
                    <p class="card__card-type">Credit / debit card</p>
                    <p class="card__card-number">Visa ending in **89</p>
                </div>
            </div>
        </div>

        <div class="card__tags">
            <span class="card__tag" style="color: #ccfdce">completed</span>
            <span class="card__tag" style="color: #ccfdce">#<?php echo $orderNo ?></span>
        </div>

    </div>

</div>

<?php
require_once 'footer.php';
?>