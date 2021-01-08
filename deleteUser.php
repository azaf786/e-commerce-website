<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection){
    echo "no connection";
}

if(isset($_POST["id"]))
{
    $query = "DELETE FROM users WHERE cust_id = '".$_POST["id"]."';";
    if(mysqli_query($connection, $query))
    {
        $query1 = "DELETE FROM customer WHERE cust_id = '".$_POST["id"]."';";
        if(mysqli_query($connection, $query1)){
            echo 'Data Deleted';
        }
    }
    else{
        echo 'Data NOT Deleted';
    }
}
?>