<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$columns = array('cat_id', 'cat_title', 'sub_cat', 'sub_sub_cat');
if (!$connection)
{
    if (isset($mysqli_connect_error)) {
        die("Connection failed: " . $mysqli_connect_error);
    }
}
$query = "SELECT * FROM category ";

if(isset($_POST["search"]["value"]))
{
    $query .= '
 WHERE cat_id LIKE "%'.$_POST["search"]["value"].'%" 
 OR cat_title LIKE "%'.$_POST["search"]["value"].'%" OR sub_cat LIKE "%'.$_POST["search"]["value"].'%"
 OR sub_sub_cat LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
    $query .= 'ORDER BY cat_id DESC ';
}

$query1 = '';


$number_filter_row = mysqli_num_rows(mysqli_query($connection, $query));

$result = mysqli_query($connection, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $sub_array = array();
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cat_id"].'" data-column="cat_id">' . $row["cat_id"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cat_id"].'" data-column="cat_title">' . $row["cat_title"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cat_id"].'" data-column="sub_cat">' . $row["sub_cat"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cat_id"].'" data-column="sub_sub_cat">' . $row["sub_sub_cat"] . '</div>';
    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" data-id3="'.$row["cat_id"].'" data-column="cat_id">Delete</button>';
    $sub_array[] = '<button type="button" name="update" class="btn btn-warning btn-xs update" data-id3="'.$row["cat_id"].'" data-column="cat_id">Update</button>';
    $data[] = $sub_array;
}

function get_all_data($connection)
{
    $query = "SELECT * FROM category";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "recordsTotal"  =>  get_all_data($connection),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);

?>
