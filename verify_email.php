<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'project');

if (isset($_GET['verification_key'])) {
    $verification_key = $_GET['verification_key'];
    $sql = "SELECT * FROM users WHERE verification_key ='$verification_key' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE verification_key='$verification_key'";

        if (mysqli_query($conn, $query)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            $_SESSION['message'] = "Your email address has been verified successfully";
            $_SESSION['type'] = 'alert-success';
            header('location: verify_index.php');
            exit(0);
        }
    } else {
        echo "User not found!";
    }
} else {
    echo "No token provided!";
}
?>