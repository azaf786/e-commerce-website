<?php
//require_once "credentials.php";
//$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//
//if(isset($_POST["id"]))
//{
//    $value = mysqli_real_escape_string($connection, $_POST["value"]);
//    $query = "UPDATE category SET ".$_POST["column"]." = '".$value."' WHERE cat_id = '".$_POST["id"]."'";
//    if(mysqli_query($connection, $query))
//    {
//        echo 'Category Updated';
//    }
//    else{
//        echo "Error occured while Updating";
//    }
//}
//


require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(isset($_POST["id"]))
{
    $sql = "SELECT * FROM category WHERE cat_id =  '".$_POST["id"]."'";
    $result = mysqli_query($connection, $sql);
    $n = mysqli_num_rows($result);

    if($n > 0){
        $row = mysqli_fetch_assoc($result);
        $res = array(
            'cat_id' => $row['cat_id'],
            'cat_title' => $row['cat_title'],
            'sub_cat' => $row['sub_cat'],
            'sub_sub_cat' => $row['sub_sub_cat']
        );
        exit(json_encode($res));
    }
}
?>