<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(isset($_POST["id"]))
{
    $prod_id = mysqli_real_escape_string($connection, $_POST["id"]);
    $sql = "SELECT * FROM products WHERE prod_id = '$prod_id'";
    $result = mysqli_query($connection, $sql);
    $n = mysqli_num_rows($result);
    if($n > 0){
        $row = mysqli_fetch_assoc($result);
        $res = array(
            'prod_id' => $row['prod_id'],
            'prod_title' => $row['prod_title'],
        );
        exit(json_encode($res));
    }
}
?>