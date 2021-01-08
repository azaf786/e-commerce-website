<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection){
    echo "no connection";
}
$cat_title = $_POST['cat_title'];
$sub_cat = $_POST['sub_cat'];
$sub_sub_cat = $_POST['sub_sub_cat'];

if(!isset($_POST["insert"]))
{
    $cat_title = mysqli_real_escape_string($connection, $_POST['cat_title']);
    $sub_cat = mysqli_real_escape_string($connection, $_POST['sub_cat']);
    $sub_sub_cat = mysqli_real_escape_string($connection, $_POST['sub_sub_cat']);
    $query = "INSERT INTO category (cat_title, sub_cat, sub_sub_cat) VALUES ('$cat_title','$sub_cat', '$sub_sub_cat')";
    if(mysqli_query($connection, $query))
    {
        echo 'New Category Inserted';
    }else{
        echo "DATA INSERTION UNSUCCESSFUL";
    }
}

?>
