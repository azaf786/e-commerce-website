<?php
/*<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">*/
//session_start();
require_once "helper.php";
require_once "sendEmails.php";

$lastName = "";
$firstName = "";
$username = "";
$email = "";
$password = "";
$dob = "";
$telephone = "";
$errors = [];
$decrypted_password = "";

$conn = new mysqli('localhost', 'root', '', 'project');
if (!$conn) {
    die("Connection failed: " . $mysqli_connect_error);
}
// SIGN UP USER
if (isset($_POST['signup-btn']))
{
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username required.';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required.';
    }
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = 'First name required.';
    }
    if (empty($_POST['lastname'])) {
        $errors['lastname'] = 'Last name required.';
    }
    if (empty($_POST['lastname'])) {
        $errors['lastname'] = 'Last name required.';
    }
    if (empty($_POST['dob'])) {
        $errors['dob'] = 'Date Of birth required.';
    }
    if (empty($_POST['telephone'])) {
        $errors['telephone'] = 'Contact number required.';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required.';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'Passwords do not match.';
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $verification_key = bin2hex(random_bytes(50)); // generate unique token
    $options = array("cost"=>4);
    $hashedPassword = password_hash($password,PASSWORD_BCRYPT,$options);
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $dob = $_POST['dob'];
    $telephone = $_POST['telephone'];
    /////////////////////////////////////////
    //////// SERVER-SIDE VALIDATION /////////
    /////////////////////////////////////////
    // First, sanitise the user input (functions in helper.php)
//    $username = sanitise($username, $conn);
//    $password = sanitise($password, $conn);
//    $firstName = sanitise($firstName, $conn);
//    $lastName = sanitise($lastName, $conn);
//    $dob = sanitise($dob, $conn);
//    $email = sanitise($email, $conn);
//    $telephone = sanitise($telephone, $conn);

//    $username_errors = validateString($username, 1, 32);
//    $password_errors = validateString($password, 6, 40);
//    $firstName_errors = validateString($firstName, 1, 32);
//    $lastName_errors = validateString($lastName, 1, 64);
//    $telephone_errors = validateString($telephone, 0, 25);
//    $email_errors = validateEmail($email);
//    $dob_errors = validateDOB($dob);




    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Email already exists. Please use another one.";
    }
    if (mysqli_num_rows($result) > 0) {
        $errors['username'] = "Username already exists. Please use another one.";
    }

    if (count($errors) === 0)
    {
        $lastLogin = date("Y-m-d");
        $query = "INSERT INTO users SET username=?, email=?, verification_key=?, password=?, dob=?, telephone=?, firstname=?, lastname=? , lastlogin=? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssss', $username, $email, $verification_key, $hashedPassword, $dob, $telephone, $firstName, $lastName, $lastLogin);
        $result = $stmt->execute();

        if ($result)
        {
            $user_id = $stmt->insert_id;
            $stmt->close();
            echo "</br>";
            echo "$result has worked";
            // TO DO: send verification email to user
            sendVerificationEmail($email, $verification_key);
            $_SESSION['loggedIn'] = false;
            echo "</br>";
            echo "I am a session: ".$_SESSION['loggedIn'];
            $_SESSION['user_id'] = $user_id;
            echo "</br>";
            echo $_SESSION['user_id'];
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'Sign up Successful.';
            $_SESSION['type'] = 'alert-success';

            echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';

            header('location: http://localhost:8080/zashas/verify_index.php');
        } else
            {
            echo $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}

// LOGIN
if (isset($_POST['login-btn']))
{
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }

    if (count($errors) === 0)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "select * from users where username = '$username'";
        $result = mysqli_query($conn, $sql);
        $n = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        //$row = mysqli_query($conn, $result);
        if($n > 0)
        {
            echo "hello";
            echo "</br>";
            echo "<a href='/zashas/index.php'>Visit W3Schools</a>";
            echo "</br>";
            echo "I am just a password: ".$password;
            echo "</br>";
            echo "I am a row password: ".$row['password'];
            if (password_verify($password, $row['password']))
            {
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['verified'] = $row['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: index.php');
            } else
            {
                echo '<script language="javascript">';
                echo 'alert("Incorrect Password")';
                echo '</script>';
            }
        } else {
            echo "No User found";
        }
    }
    else{
        echo "there are errors";
    }


if (isset($_SESSION['loggedIn']))
{
    echo <<<_END
                <div class="loginDialog"><fieldset><legend><h2>Already Logged In</h2></legend>
                <table align="center" border="0" cellpadding="2"><tr><td>
                <br>You are already logged in, please <a href="logout.php">log out</a> first.<br><br><br>
                </td></tr></table></fieldset></div>
_END;
    echo "<br>";

}
}