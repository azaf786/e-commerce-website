<?php
// execute the header script:
require_once "headerZashas2.php";
require_once "credentials.php";
require_once "helper.php";

// setup variables to help with funcionality and validation of data
$showLogin = true;
$username = $password = "";
// error messages to display about each field to be used for combination of all server-side errors
$username_errors = $password_errors = $errors = "";
$message = "";
if(isset($_SESSION['loginAlert']))
{
    if ($_SESSION['loginAlert'] == true)
    {
        echo <<<_END
        <div class="alert alert-danger" role="alert">
            This is a danger alert—check it out!
        </div>
_END;
        $_SESSION['loginAlert'] = false;
    }
}

if (isset($_SESSION['loggedIn']))
{
    $showLogin = false;
    // user is already logged in, just display a message:
    echo <<<_END
                   <div class="loginDialog"><fieldset><legend><h2>Already Logged In</h2></legend>
                   <table align="center" border="0" cellpadding="2"><tr><td>
                   <br>You are already logged in, please <a href="logout.php">log out</a> first.<br><br><br>
                   </td></tr></table></fieldset></div>
_END;
    echo "<br>";

}


//$_SESSION['basket'] = array();
else if (isset($_POST['username'])) {
    // user has just tried to log in, check form data against database:
    // take copies of the credentials the user submitted:
    $username = $_POST['username'];
    // apply the SALT and HASH to the paswword entered
    $password = $_POST['password'];

    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }

    //////// SERVER-SIDE VALIDATION /////////
    // First, sanitise the user input (functions in helper.php)
    //    $username = sanitise($username, $connection);
    //    $password = sanitise($password, $connection);
    // Next, validate the user input (functions in helper.php)
    $username_errors = validateString($username, 1, 16);
    $password_errors = validateString($password, 6, 40);
    // concatenate the errors from both validation calls
    $errors = $username_errors . $password_errors;

    $sql = "select * from users where username = '$username' ";

    echo "<br>";
    $result = mysqli_query($connection, $sql);
    $n = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($n === 1 )
    {

        $decryptedPassword = password_verify($password, $row['password']);
        if (password_verify($password, $row['password'])) {

            // check for a row in our members table with a matching username and password:
            $inpassword = $row['password'];
            $query = "SELECT * FROM users WHERE username='$username' AND password='$inpassword';";

            // this query can return data ($result is an identifier):
            $result = mysqli_query($connection, $query);
            // how many rows came back? (can only be 1 or 0 because usernames are the primary key in our table):
            $n = mysqli_num_rows($result);

            // fetch the data about this user
            $user_row = mysqli_fetch_assoc($result);

            // if there was a match then set the session variables and display a success message:
            if ($n === 1) {

                $customer = $row['cust_id'];
                $sql = "SELECT * FROM customer WHERE cust_id = '$customer';";
                $result = mysqli_query($connection, $sql);
                $n = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
                if($n === 1) {
                    // set a session variable to record that this user has successfully logged in:
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['basketAlert'] = false;
                    $_SESSION['wishAlert'] = false;
                    $_SESSION['basket'] = array();
                    $_SESSION['wishlist'] = array();
                    // and copy their username into the session data for use by our other scripts:
                    $_SESSION['username'] = $username;
                    // add the user's picture link as a session variable
                    // add the first name as a session var
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['verified'] = $user_row['verified'];
                    $verify = $_SESSION['verified'];
                    // hide the form
                    $showLogin = false;
                    if ($verify == 0) {

                        $showLogin = false;
                        echo <<<_END
                     <div class="alert alert-warning alert-dismissible fade show btn-block" role="alert">
                                   You need to verify your email address!
                                   Sign into your email account and click
                                   on the verification link we just emailed you
                                   at: <strong>{$_SESSION['email']}</strong>
                                 
                    </div>
        <br>
        <br>
        <br>
_END;
                    } else {
                        // update the last login date
                        $lastLogin = date("Y-m-d");
                        $sql = "UPDATE users SET lastLogin='$lastLogin' WHERE username='$username' AND password='$password'";
                        // no data, just true/false: we're tring to update a field, not request a value back
                        $result = mysqli_query($connection, $sql);

                        // show a successful signin message:
                        echo <<<_END

                        <script type="text/javascript">
                           window.location.href = 'index.php';
                        </script>
       
_END;
                    }
                }
            }
        }
        else {
            $message = "Sign in failed, please try again";
            echo <<<_END
            <hr>
            <div style="background-color: #303030" class="alert alert" role="alert">
                <h2 style="padding-left: 10px; color: white; text-align: center"><strong>$message</strong></h2>
            </div>
            <hr>
_END;
            $showLogin = true;
        }
        mysqli_close($connection);
    }
    else {
        $message = "Log in Failed";
        echo <<<_END
            <hr>
            <div style="background-color: #303030" class="alert alert" role="alert">
                <h2 style="padding-left: 10px; color: white; text-align: center"><strong>$message</strong></h2>
            </div>
            <hr>
_END;

        $_SESSION['loginAlert'] = true;
        $showLogin = true;
    }
}

elseif(isset($_POST['email'])){

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
            echo $username;
            $sql = "SELECT * FROM customer WHERE email = '$email'";
            $cust_result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($cust_result);
            $cust_id = $row['cust_id'];
            if($cust_result){

                $sql = "INSERT INTO users (cust_id, username, password, verified, verification_key) VALUES ('$cust_id', '$username', '$hashedPassword', 0, '$verification_key')";
                echo $sql;
                $result = mysqli_query($connection, $sql);

            }else{echo "DIDNT WORK";}
            sendVerificationEmail($email, $verification_key);
            echo "I am email: ".$email;
            echo "<br>";
            echo "I am verification key: ".$verification_key;
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



            echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';



        } else {
            die("Error inserting row: " . mysqli_error($connection));
        }
        // we're finished with the database, close the connection:
        mysqli_close($connection);
    }
}

elseif (isset($_GET['clear'])) {
    setcookie('firstName', "", time() - 2592000, '/');
    $message = "Welcome!<br>";
    $showLogin = true;
}

elseif (isset($_COOKIE['firstName']) && isset($_COOKIE['username'])) {
    $message = "<br>Welcome back, {$_COOKIE['firstName']}<br>please sign-in...<br>Not you? <a href='login.php?clear=y'>Click Here</a>";
    $username = $_COOKIE['username'];
    $showLogin = true;
}


else
{
    $showLogin = true;
}

if ($showLogin) {
    //    echo <<<_END
    //
    //<div class="wrapper fadeInDown" id = "formContext">
    //  <div id="formContent">
    //    <!-- Tabs Titles -->
    //
    //    <!-- Icon -->
    //    <div class="fadeIn first">
    //      <legend>Login</legend>
    //    </div>
    //
    //    <!-- Login Form -->
    //    <b>$message</b>
    //    <form action="login.php" method="post">
    //      <input type="text" id="login" class="fadeIn second" name="username" value= "$username"  placeholder="Username">
    //      <input type="password" id="password" class="fadeIn third" name="password" value="$password" placeholder="Password">
    //      <input type="submit"  name="login-btn" class="fadeIn fourth" value="Log In">
    //    </form>
    //
    //    <!-- Remind Passowrd -->
    //    <div id="formFooter">
    //       <p>Don't yet have an account? <a href="register.php">Register here</a></p>
    //    </div>
    //
    //  </div>
    //</div>
    //
    //_END;

//    echo <<<_END
//
//<div class="container">
//    <div class="inner">
//        <h1>Login</h1>
//        <h3>Welcome Back!</h3>
//        <b>$message</b>
//
//        <form action="login.php" method="post">
//            <legend>Login to your account</legend><br>
//            <label><span class="glyphicon glyphicon-user"></span></label>
//            <input type="text" placeholder='Username' name="username" class="input" value="$username" /><br>
//            <label><span class="glyphicon glyphicon-lock"></span></label>
//            <input type="password" placeholder="password" name="password" class="input" value="$password" /><br>
//            <button type="submit" class="button">Sign in</button>
//        </form>
//        <h6>Don't have an account? Register <a href="register.php">here</a></h6>
//    </div>
//</div>
//_END;

    echo <<<_END

    <div class="col-4 login">
            <div class="login-card-light p-3 shadow-lg rounded">
                <div class="pt-3">
                    <h2 class="text-info">Login</h2>
                </div>

                <form class="mt-5" action="login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" minlength="5" class="form-control form-control-sm" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" minlength="3" class="form-control form-control-sm" placeholder="Password" required>
                    </div>

                    <div class="mt-5">
                        <button class="btn btn-sm btn-info col">
                            Login
                        </button>
                    </div>
                    <div class="mt-5">
                        <p class="text-center">
                            Don't have an account?
                            <a href="register.php">Click here to register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
_END;
}
require_once 'footer.php';
?>
