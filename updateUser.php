<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(isset($_POST["id"]))
{
    $cust_id = mysqli_real_escape_string($connection, $_POST["id"]);
    $sql = "SELECT * FROM customer INNER JOIN users using (cust_id) INNER JOIN address USING (addr_id) WHERE customer.cust_id = '$cust_id'";
    $result = mysqli_query($connection, $sql);
    $n = mysqli_num_rows($result);
    if($n > 0){
        $row = mysqli_fetch_assoc($result);
        $res = array(

            'cust_id' => $row['cust_id'],
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'tele_no' => $row['tele_no'],
            'addr_id' => $row['addr_id'],
            'email' => $row['email'],
            'dob' => $row['dob'],
            'username' => $row['username'],
            'verified' => $row['verified'],
            'addr_ln1' => $row['addr_ln1'],
            'addr_ln2' => $row['addr_ln2'],
            'addr_city' => $row['addr_city'],
            'addr_country' => $row['addr_country'],
            'addr_postcode' => $row['addr_postcode'],
        );
        exit(json_encode($res));
    }
}
?>