<style>
    <?php include 'styling/home.css'; ?>
</style>
<?php
require_once "credentials.php";
require_once "header.php";
require_once "helper.php";
require_once "controllers/sendEmails.php";


echo <<<_END
<link rel="stylesheet" href="styling/home.css">
_END;

$preSalt = "Ajs23k";
$postSalt = "2sAk09";

$showLogin = false;
$username = $password = "";

$username_errors = $password_errors = $firstName_errors = $lastName_errors = $email_errors = $dob_errors = $telephone_errors = $errors = "";
$message = "";

if (isset($_SESSION['loggedIn']))
{
    echo <<<_END
            <div class="loginDialog"><fieldset><legend><h2> Status: Logged In</h2></legend>
            <table align="center" border="0" cellpadding="2"><tr><td>
            <br>Please <a href="signout.php">sign out</a> first.<br><br><br>
            </td></tr></table></fieldset></div>
_END;
    echo "<br>";
}

elseif (isset($_POST['username']))
{
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $token = bin2hex(random_bytes(50)); // generates unique

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // exit the script with a useful message if there was an error:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }

    /////////////////////////////////////////
    //////// SERVER-SIDE VALIDATION /////////
    /////////////////////////////////////////
    $username = sanitise($username, $connection);
    $password = sanitise($password, $connection);
    $firstName = sanitise($firstName, $connection);
    $lastName = sanitise($lastName, $connection);
    $dob = sanitise($dob, $connection);
    $email = sanitise($email, $connection);
    $telephone = sanitise($telephone, $connection);
    // Next, validate the user input (functions in helper.php)
    $username_errors = validateString($username, 1, 32);
    $password_errors = validateString($password, 6, 40);
    $firstName_errors = validateString($firstName, 1, 32);
    $lastName_errors = validateString($lastName, 1, 64);
    $telephone_errors = validateString($telephone, 0, 25);
    $email_errors = validateEmail($email);
    $dob_errors = validateDOB($dob);


    $errors = $username_errors . $password_errors . $firstName_errors . $lastName_errors . $telephone_errors . $email_errors . $dob_errors;

    if ($errors == "")
    {
        $lastLogin = date("Y-m-d");
        $password = sha1($preSalt . $password . $postSalt);

        $sql = "INSERT INTO USERS (username, password, firstName, lastName, email, telephone, dob, lastLogin, token)
            VALUES ('$username', '$password', '$firstName', '$lastName', '$email', '$telephone', '$dob', '$lastLogin' ,'$token')";
        echo "hello world . $sql";
        if (mysqli_query($connection, $sql)) {
            sendVerificationEmail($email, $token);
//            $row = mysqli_fetch_assoc($sql);
//            $userId = $row["userId"];
//            $_SESSION['userId'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            //header('location: verify_index.php');
        }
        else {
            die("Error inserting row: " . mysqli_error($connection));
        }
        mysqli_close($connection);
    }

    else {
        $showLogin = true;
    }
}
else {
    $showLogin = true;
}

if ($showLogin) {
    echo <<<_END
        <form action="signup.php" method="post" enctype="multipart/form-data">
             <div class="generalInfo"><fieldset><legend><h2>Register Here</h2></legend>
             <table class="sign_up_table">
                 <tr><th>First Name</th>
                 <td>
                    <input size="30" type="text" minlength="1" maxlength="32" name="firstName" required><b>$firstName_errors</b></td></tr>
                 <tr><th>Last Name</th><td><input size="30" type="text" minlength="1" maxlength="64" name="lastName" required><b>$lastName_errors</b></td></tr>
                 <tr><th align="right">Username</th><td><input size="30" type="text" minlength="1" maxlength="32" name="username" required><b>$username_errors</b></td></tr>
                 <tr><th>Password</th><td><input size="30" type="password" minlength="6" maxlength="40" name="password" required><b>$password_errors</b></td></tr>
                 <tr><th>DOB</><td><input name="dob" type="date" required></td><b>$dob_errors</b></tr>
                 <tr><th>Email</th><td><input size="30" type="email" minlength="3" maxlength="64" name="email" required><b>$email_errors</b></td></tr>
                 <tr><th>Contact no</th><td><input size="30" type="text" minlength="1" maxlength="25" name="telephone"><b>$telephone_errors</b></td></tr>
             </table>
                 <input type="submit" value="Submit">
             </fieldset>
            </div>
        </form>

_END;

}

?>

<?php
require_once 'footer.php';
?>
