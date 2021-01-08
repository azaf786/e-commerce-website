<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection){
    echo "no connection";
}
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$tele_no = $_POST['tele_no'];
$addr_ln1 = $_POST['addr_ln1'];
$addr_ln2 = $_POST['addr_ln2'];
$addr_city = $_POST['addr_city'];
$addr_postcode = $_POST['addr_postcode'];
$addr_country = $_POST['addr_country'];
$username = $_POST['username'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$verified = $_POST['verified'];
$password = $_POST['password'];
$hashedPassword = password_hash($password,PASSWORD_BCRYPT, array("cost"=>4));

$verification_key = bin2hex(random_bytes(50)); // generate unique token

if(!isset($_POST["insert"])) {
    $query = "INSERT INTO address (addr_ln1, addr_ln2, addr_country, addr_postcode, addr_city)
               VALUES ('$addr_ln1', '$addr_ln2', '$addr_country', '$addr_postcode', '$addr_city')";
    $addrResult = mysqli_query($connection, $query);
    if ($addrResult) {
        $selectAddr = "SELECT * FROM address WHERE addr_postcode = '$addr_postcode'";
        $resAddr = mysqli_query($connection, $selectAddr);
        $nAddress = mysqli_num_rows($resAddr);
        if ($nAddress > 0) {
            $rowAddr = mysqli_fetch_assoc($resAddr);
            $addr_id = $rowAddr['addr_id'];
            $insCust = "INSERT INTO customer (firstName, lastName, tele_no, email, dob, addr_id) 
            VALUES ('$firstName','$lastName', '$tele_no', '$email', '$dob', '$addr_id')";
            if (mysqli_query($connection, $insCust)) {
                $selectCust = "SELECT * FROM customer WHERE email = '$email'";
                $resCust = mysqli_query($connection, $selectCust);
                $nCust = mysqli_num_rows($resCust);
                if($nCust > 0) {
                    $rowCust = mysqli_fetch_assoc($resCust);
                    $cust_id = $rowCust['cust_id'];
                    $insUsers = "INSERT INTO users (username, verified, password, verification_key, cust_id) VALUES ('$username', '$verified', '$hashedPassword', '$verification_key', '$cust_id')";
                    if (mysqli_query($connection, $insUsers)) {
                        echo "User has been inserted successfully";
                    }
                }
            } else {
                "Customer not inserted";
            }
        } else {
            echo "No address found.";
        }
    }
}

?>