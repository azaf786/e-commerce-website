<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection){
    echo "no connection";
}

if(!isset($_POST["insert"]))
{
    $prod_title = mysqli_real_escape_string($connection, $_POST['prod_title']);
    $prod_dscr = mysqli_real_escape_string($connection, $_POST['prod_dscr']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $prod_qty = mysqli_real_escape_string($connection, $_POST['prod_qty']);
    $query = "INSERT INTO products (prod_title, prod_dscr, price, prod_qty) VALUES ('$prod_title', '$prod_dscr', '$price', '$prod_qty')";
    if(mysqli_query($connection, $query))
    {
        echo 'New Product Inserted';
    }else{
        echo "DATA INSERTION UNSUCCESSFUL";
    }
}

?>
