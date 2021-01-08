<?php


// execute the header script:
require_once "controllers/sendEmails.php";
require_once "headerZashas2.php";
require_once "helper.php";
require_once "credentials.php";

// some styling for the tables
echo <<<_END
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 4px;
}
</style>
_END;


// setup variables to help with funcionality and validation of data
$showLogin = false;
$username = $password = "";
// error messages to display about each field to be used for combination of all server-side errors
$username_errors = $password_errors = $firstName_errors = $lastName_errors = $email_errors = $dob_errors = $telephone_errors = $errors = "";
$message = "";


if (isset($_SESSION['loggedIn'])) {
    // user is already logged in, just display a message:
    echo <<<_END
                <div class="loginDialog"><fieldset><legend><h2>Already Logged In</h2></legend>
                <table align="center" border="0" cellpadding="2"><tr><td>
                <br>You are already logged in, please <a href="logout.php">log out</a> first.<br><br><br>
                </td></tr></table></fieldset></div>
_END;
    echo "<br>";
} elseif (isset($_POST['username'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];


    // connect to the host:
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // exit the script with a useful message if there was an error:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }

    // concatenate the errors from both validation calls
    $errors = $username_errors . $password_errors . $firstName_errors . $lastName_errors . $telephone_errors . $email_errors . $dob_errors;

    if ($errors == "") {
        $lastLogin = date("Y-m-d");
//        $options = array("cost"=>4);
        $hashedPassword = password_hash($password,PASSWORD_BCRYPT, array("cost"=>4));

        $verification_key = bin2hex(random_bytes(50)); // generate unique token

//        $sql = "INSERT INTO users (username, password, firstName, lastName, email, telephone, dob, lastLogin, verification_key)
//            VALUES ('$username', '$hashedPassword', '$firstName', '$lastName', '$email', '$telephone', '$dob', '$lastLogin', '$verification_key')";

        $sql = "INSERT INTO customer (firstName, lastName, tele_no, email, dob, addr_id) VALUES('$firstName', '$lastName', '$telephone', '$email', '$dob', 1)";
        $result = mysqli_query($connection, $sql);


        // no data returned, we just test for true(success)/false(failure):
        if ($result)
        {
//            echo $username;
            $sql = "SELECT * FROM customer WHERE email = '$email'";
            $cust_result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($cust_result);
//            echo $row['cust_id'];
//            echo "<br>";
            $cust_id = $row['cust_id'];
            if($cust_result){

                $sql = "INSERT INTO users (cust_id, username, password, verified, verification_key) VALUES ('$cust_id', '$username', '$hashedPassword', 0, '$verification_key')";
                $result = mysqli_query($connection, $sql);

            }else{echo "DIDNT WORK";}
            sendVerificationEmail($email, $verification_key);
//            echo "I am email: ".$email;
//            echo "<br>";
//            echo "I am verification key: ".$verification_key;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'Sign up Successful.';
            $_SESSION['type'] = 'alert-success';

            echo"<h4>Hello,</h4>";

            echo $_SESSION['username'];

            echo <<<_END
             <br>Your account has been created. 
             <br> You need to verify your email address!
                    Sign into your email account and click
                    on the verification link we just emailed you
                    at: 
_END;
            echo "<strong>".$_SESSION['email'] . "</strong>";



//            echo '<pre>';
//            var_dump($_SESSION);
//            echo '</pre>';



        } else {
            die("Error inserting row: " . mysqli_error($connection));
        }
        // we're finished with the database, close the connection:
        mysqli_close($connection);
    } else {
        /// deal with server side errors";
        /// show form again, highlighting problems
        $showLogin = true;
    }
}


else {
    $showLogin = true;
}

if ($showLogin) {

    echo <<<_END

<div class="col-4 register">
            <div class="login-card-light p-3 shadow-lg rounded">
                <div class="pt-3">
                    <h2 class="text-info">Register</h2>
                </div>

                <form class="mt-5" action="register.php" method="post">
                    <div class="form-group">
                        <input type="text" name="firstName" class="form-control form-control-sm" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastName" class="form-control form-control-sm" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" minlength="5" class="form-control form-control-sm" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control form-control-sm" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" minlength="6" class="form-control form-control-sm" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwordConf" class="form-control form-control-sm" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group dob">
                        <input type="date" name="dob" class="form-control form-control-sm" placeholder="Date of Birth" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="telephone" class="form-control form-control-sm" placeholder="Contact Number" required>
                    </div>
                    <div class="mt-5">
                        <button class="btn btn-sm btn-info col">
                            Register
                        </button>
                    </div>
                    <div class="mt-5">
                        <p class="text-center">
                            Already have an account?
                            <a href="login.php">Click here to Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

<!--  -->
<!--<div class="wrapper fadeInDown" id = "formContextRegister">-->
<!--  <div id="formContent">-->
<!--    &lt;!&ndash; Tabs Titles &ndash;&gt;-->

<!--    &lt;!&ndash; Icon &ndash;&gt;-->
<!--    <div class="fadeIn first">-->
<!--      <legend>Register</legend>-->
<!--    </div>-->

<!--        <form action="register.php" method="post">-->
<!--          <div>-->
<!--                <input type="text" name="firstName" class="fadeIn first" placeholder="First Name">-->
<!--          </div>-->
<!--            <div>-->
<!--                <input type="text" name="lastName" class="fadeIn second" placeholder="Last Name">-->
<!--            </div>-->
<!--          <div>-->
<!--                 <input type="text" name="username" class="fadeIn third" placeholder="Username">-->
<!--          </div>-->
<!--          <div>-->
<!--                <input type="text" name="email" class="fadeIn fourth" placeholder="email">-->
<!--          </div>-->
<!--          <div>-->
<!--                <input type="password" name="password" class="fadeIn fifth" placeholder="Password">-->
<!--          </div>-->
<!--          <div>-->
<!--                <input type="password" name="passwordConf" class="fadeIn sixth" placeholder="Confirm Password">-->
<!--          </div>-->
<!--          <div>-->
<!--                <input type="date" name="dob" class="fadeIn seventh">-->
<!--          </div>-->
<!--          <div>-->
<!--                <input type="number" name="telephone" class="fadeIn eighth" placeholder="Contact Number">-->
<!--          </div>-->
<!--          <div>-->
<!--            <input type="submit"  name="signup-btn" class="fadeIn ninth" value="Register">-->
<!--          </div>-->
<!--        </form>-->
<!--       <div id="formFooter">-->
<!--       <p>Already have an account? <a href="login.php">Login here</a></p>-->
<!--    </div>-->

<!--  </div>-->
<!--</div>-->
<!--        -->
<!--        </form>-->

_END;

}


require_once 'footer.php';



