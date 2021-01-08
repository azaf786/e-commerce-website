<?php
require_once "credentials.php";


if(isset($_POST["id"])) {
    $cat_id = mysqli_real_escape_string($connection, $_POST["id"]);
    $cat_title = mysqli_real_escape_string($connection, $_POST["cat_title"]);
    $sub_cat = mysqli_real_escape_string($connection, $_POST["sub_cat"]);
    $sub_sub_cat = mysqli_real_escape_string($connection, $_POST["sub_sub_cat"]);
    $query = "UPDATE category SET cat_title = '$cat_title', sub_cat = '$sub_cat', sub_sub_cat = '$sub_sub_cat' WHERE cat_id = '$cat_id';";
    if (mysqli_query($connection, $query)) {
        echo 'Category Updated' . $query;
    } else {
        echo "Error occured while Updating";
    }
}
else{
    exit('Id not Found.');
}
?>