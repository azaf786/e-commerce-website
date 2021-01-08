<?php
require_once "credentials.php";
if(isset($_POST['id']))
{
    $id = mysqli_real_escape_string($connection, $_POST["id"]);
    $firstName = mysqli_real_escape_string($connection, $_POST["firstName"]);
    $lastName = mysqli_real_escape_string($connection, $_POST["lastName"]);
    $tele_no = mysqli_real_escape_string($connection, $_POST["tele_no"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $dob = mysqli_real_escape_string($connection, $_POST["dob"]);
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $verified = mysqli_real_escape_string($connection, $_POST["verified"]);
    $addr_ln1 = mysqli_real_escape_string($connection, $_POST["addr_ln1"]);
    $addr_ln2 = mysqli_real_escape_string($connection, $_POST["addr_ln2"]);
    $addr_city = mysqli_real_escape_string($connection, $_POST["addr_city"]);
    $addr_country = mysqli_real_escape_string($connection, $_POST["addr_country"]);
    $addr_postcode = mysqli_real_escape_string($connection, $_POST["addr_postcode"]);
    $query = "UPDATE users SET username = '$username', verified = '$verified' WHERE cust_id = '$id';";
    if (mysqli_query($connection, $query)) {
        $query2 = "UPDATE customer SET firstName = '$firstName', lastName = '$lastName', tele_no = '$tele_no', email = '$email', dob = '$dob' WHERE cust_id = '$id';";
        if (mysqli_query($connection, $query2)) {
            $query3 = "UPDATE address SET addr_ln1 = '$addr_ln1', addr_ln2 = '$addr_ln2', addr_city = '$addr_city', addr_country = '$addr_country', addr_postcode = '$addr_postcode' WHERE addr_id = '$id'";
            if (mysqli_query($connection, $query3)) {
                echo "User updated successfully.";
            }
        }
    } else {
        echo "Update Failed!";
    }
}
else{
    exit('no id');
}
?>