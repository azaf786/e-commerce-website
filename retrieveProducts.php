<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$columns = array('prod_id', 'prod_title', 'prod_dscr', 'price', 'prod_qty');
if (!$connection)
{
    if (isset($mysqli_connect_error)) {
        die("Connection failed: " . $mysqli_connect_error);
    }
}
$query = "SELECT * FROM products";

if(isset($_POST["search"]["value"]))
{
    $query .= '
 WHERE prod_id LIKE "%'.$_POST["search"]["value"].'%" 
 OR prod_title LIKE "%'.$_POST["search"]["value"].'%" OR prod_dscr LIKE "%'.$_POST["search"]["value"].'%"
 OR price LIKE "%'.$_POST["search"]["value"].'%" OR prod_qty LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
    $query .= 'ORDER BY prod_id DESC ';
}

$query1 = '';


$number_filter_row = mysqli_num_rows(mysqli_query($connection, $query));

$result = mysqli_query($connection, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $sub_array = array();
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["prod_id"].'" data-column="prod_id">' . $row["prod_id"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["prod_id"].'" data-column="prod_title">' . $row["prod_title"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["prod_id"].'" data-column="prod_dscr">' . $row["prod_dscr"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["prod_id"].'" data-column="price">' . $row["price"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["prod_id"].'" data-column="prod_qty">' . $row["prod_qty"] . '</div>';
    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" data-id3="'.$row["prod_id"].'" data-column="prod_id"><i class="fas fa-trash-alt"></i> Delete</button>';
    $sub_array[] = '<button type="button" name="update" class="btn btn-warning btn-xs update" data-id3="'.$row["prod_id"].'" data-column="prod_id"><i class="fas fa-edit"></i> Update</button>';
    $data[] = $sub_array;
}

function get_all_data($connection)
{
    $query = "SELECT * FROM products";
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
