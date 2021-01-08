<?php

echo <<<_END
<style>
body{
    font-family: 'Circular Std Book';
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    color: #71748d;
    background-color: #efeff6;
    -webkit-font-smoothing: antialiased

}
</style>

_END;

require_once "headerZashas2.php";
require_once "credentials.php";
if (isset($_SESSION['loggedIn'])) {
    $username = $_SESSION['username'];

    $selectUser = "SELECT * FROM users WHERE username = '$username'";
    $resultUser = mysqli_query($connection, $selectUser);
    $nUser = mysqli_num_rows($resultUser);
    $user_row = mysqli_fetch_assoc($resultUser);

    $myUsername = $user_row['username'];
    $myCustId = $user_row['cust_id'];

//////////////////////////////////////////////////////////////////////////////////////////
///
    $selectCust = "SELECT * FROM customer WHERE cust_id = '$myCustId'";
    $resultCust = mysqli_query($connection, $selectCust);
    $nCust = mysqli_num_rows($resultCust);
    $customer_row = mysqli_fetch_assoc($resultCust);

    $firstName = $customer_row['firstName'];
    $lastName = $customer_row['lastName'];
    $tele_no = $customer_row['tele_no'];
    $addr_id = $customer_row['addr_id'];
    $email = $customer_row['email'];
    $dob = $customer_row['dob'];

//////////////////////////ADDRESSS/////////////////////////////////////////////////
    $selectAddr = "SELECT * FROM address WHERE addr_id = '$addr_id'";
    $resultAddr = mysqli_query($connection, $selectAddr);
    $nAddr = mysqli_num_rows($resultAddr);
    $addr_row = mysqli_fetch_assoc($resultAddr);

    $addr_ln1 = $addr_row['addr_ln1'];
    $addr_ln2 = $addr_row['addr_ln2'];
    $addr_city = $addr_row['addr_city'];
    $addr_country = $addr_row['addr_country'];
    $addr_postcode = $addr_row['addr_postcode'];

//for($i=0;$i<$nSearch;$i++) {
//}


    ?>
    <!--<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'>-->

<!--    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>-->

    <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>-->


    <div class="container">
    <a href="myOrder.php">View my Profile</a>
    </div>
    <div class="container d-flex justify-content-center">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 mt-20">
            <div class="tab-regular">
                <ul class="nav nav-tabs justify-content-center " id="myTab" role="tablist">
                    <!--                <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tab Title #1</a> </li>-->

                    <li class="nav-item"><a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                            role="tab" aria-controls="contact" >My Orders</a></li>
                </ul>




            <div class="card-body" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <?php
                if($_SESSION['username'] === 'admin')
                {
                    $selectViewOrder = "SELECT * FROM orders";
                }
                else
                {
                    $selectViewOrder = "SELECT * FROM orders WHERE cust_id = '$myCustId'";
                }

//                echo $selectViewOrder;
                $resultViewOrder = mysqli_query($connection, $selectViewOrder);
                $nViewOrder = mysqli_num_rows($resultViewOrder);


                for($i = 0; $i < $nViewOrder; $i++)
                {
                    $view_order_row = mysqli_fetch_assoc($resultViewOrder);

                    $view_order_id = $view_order_row['order_id'];
                    $view_order_total = $view_order_row['total'];
//                    echo $nViewOrder;




                ?>
                <div class="alert alert" role="alert">
                    <hr>


                </div>

                    <div class="bg-light rounded-pill px-1 py-1 text-uppercase font-weight-bold" style="max-height: 45px">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-8">
                        <a href="view_order.php?order_id=<?php echo $view_order_id. "&order_total=". $view_order_total ?>"> <h5 style="color: dodgerblue">Order no:<?php echo $view_order_id ?></h5></a>
                            </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                        <p style="color: #3c3c3c; font-size: 13px; margin-top: 3px"> <strong>Total: </strong> <?php echo " £".$view_order_total ?></p>
                        </div>
                    </div>
                    </div>


                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php

    if (isset($_POST['update'])) {

        $usernameU = $_POST['username'];
        $firstnameU = $_POST['firstName'];
        $lastnameU = $_POST['lastName'];
        $emailU = $_POST['email'];
        $dobU = $_POST['dob'];
        $phoneU = $_POST['tele_no'];
        $addr1U = $_POST['addrln1'];
        $addr2U = $_POST['addrln2'];
        $cityU = $_POST['city'];
        $countryU = $_POST['country'];
        $postcodeU = $_POST['postcode'];
//    $postcodeU = $_POST['postcode'];
        $usernameU = $_POST['username'];

        $updateUser = "UPDATE users SET username = '$usernameU' WHERE cust_id ='$myCustId' ";
        $updateCust = "UPDATE customer SET firstName = '$firstnameU', lastName = '$lastnameU', tele_no = '$phoneU', email = '$emailU', dob = '$dobU' WHERE cust_id ='$myCustId' ";
        $updateAddr = "UPDATE address SET addr_ln1 = '$addr1U', addr_ln2 = '$addr2U', addr_city = '$cityU', addr_country = '$countryU', addr_postcode = '$postcodeU' WHERE addr_id = '$addr_id'";
        $_SESSION['username'] = $usernameU;

        echo $updateAddr;
        echo $updateCust;
        echo $updateUser;

        $resultUpdateUser = mysqli_query($connection, $updateUser);
        $resultUpdateCust = mysqli_query($connection, $updateCust);
        $resultUpdateCust = mysqli_query($connection, $updateAddr);

        ?>
        <script type="text/javascript">
            window.location.href = 'myProfile.php';
        </script>
        <?php

    }
}
else{
    echo "Please Log in to view this page";
}


require_once 'footer.php';
