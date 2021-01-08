<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection){
    echo "no connection";
}

if(isset($_POST["id"]))
{
    $query = "DELETE FROM category WHERE cat_id = '".$_POST["id"]."';";
    if(mysqli_query($connection, $query))
    {
        echo 'Data Deleted';
    }
    else{
        echo 'Data NOT Deleted';
    }
}
?>