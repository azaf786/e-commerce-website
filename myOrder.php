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
        <a href="myProfile.php">View my Orders</a>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 mt-20">
            <div class="tab-regular">
                <ul class="nav nav-tabs justify-content-center " id="myTab" role="tablist">
                    <!--                <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tab Title #1</a> </li>-->
                    <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" >My Profile</a></li>
                </ul>

                    <div class="card-body" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="post">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <strong>ID:</strong> <input type="text" name="Id"
                                                                placeholder="Id"
                                                                class="form-control"
                                                                value="<?php echo $myCustId ?>"
                                                                disabled/>
                                </div>
                                <div class="form-group col-lg-6">
                                    <strong>Username:</strong> <input type="text"
                                                                      name="username"
                                                                      placeholder="Username"
                                                                      class="form-control"
                                                                      value="<?php echo $myUsername ?>"
                                                                      required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <strong>First Name:</strong> <input type="text" name="firstName"
                                                                        placeholder="First Name"
                                                                        class="form-control"
                                                                        value="<?php echo $firstName ?>"
                                                                        required/>
                                </div>
                                <div class="form-group col-lg-6">
                                    <strong>Last Name:</strong> <input type="text"
                                                                       name="lastName"
                                                                       placeholder="Last Name"
                                                                       class="form-control"
                                                                       value="<?php echo $lastName ?>"
                                                                       required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <strong>Email:</strong> <input type="email" name="email"
                                                                   placeholder="Email" required
                                                                   class="form-control"
                                                                   value="<?php echo $email ?>"
                                    />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <strong>DOB:</strong> <input type="date" name="dob"
                                                                 placeholder="DOB"
                                                                 class="form-control"
                                                                 value="<?php echo $dob ?>"
                                                                 required/>
                                </div>
                                <div class="form-group col-lg-6">
                                    <strong>Phone:</strong> <input type="number"
                                                                   name="tele_no"
                                                                   placeholder="Phone"
                                                                   class="form-control"
                                                                   value="<?php echo $tele_no ?>"
                                                                   required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <strong>Address Line 1:</strong> <input type="text" name="addrln1"
                                                                            placeholder="Address Line 1"
                                                                            class="form-control"
                                                                            value="<?php echo $addr_ln1 ?>"
                                                                            required/>
                                </div>
                                <div class="form-group col-lg-6">
                                    <strong>Address Line 2:</strong> <input type="text"
                                                                            name="addrln2"
                                                                            placeholder="Address Line 2"
                                                                            class="form-control"
                                                                            value="<?php echo $addr_ln2 ?>"
                                                                            required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <strong>City:</strong> <input type="text" name="city"
                                                                  placeholder="City"
                                                                  class="form-control"
                                                                  value="<?php echo $addr_city ?>"
                                                                  required/>
                                </div>
                                <div class="form-group col-lg-6">
                                    <strong>Country:</strong> <input type="text"
                                                                     name="country"
                                                                     placeholder="Country"
                                                                     class="form-control"
                                                                     value="<?php echo $addr_country ?>"
                                                                     required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <strong>Postcode:</strong> <input type="text" name="postcode"
                                                                      placeholder="Postcode"
                                                                      class="form-control"
                                                                      value="<?php echo $addr_postcode ?>"
                                                                      required/>
                                </div>
                                <div class="form-group col-lg-6">
                                    <center><strong>Click here to Update Profile</strong></center>


                                    <input type="submit" name="update"
                                           class="btn btn-dark btn-md btn-block"
                                           value="Update Profile"/>
                        </form>
                    </div>
                </div>
            </div>

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
