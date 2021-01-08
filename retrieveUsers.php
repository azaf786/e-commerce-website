<?php
require_once "credentials.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$columns = array('cust_id', 'firstName', 'lastName', 'tele_no', 'addr_id', 'email', 'dob', 'username', 'verified', 'addr_ln1', 'addr_ln2', 'addr_city', 'addr_country', 'addr_postcode', 'password');
if (!$connection)
{
    if (isset($mysqli_connect_error)) {
        die("Connection failed: " . $mysqli_connect_error);
    }
}

$query = "SELECT * FROM customer INNER JOIN users using (cust_id) INNER JOIN address USING (addr_id)";

if(isset($_POST["search"]["value"]))
{
    $query .= '
 WHERE customer.cust_id LIKE "%'.$_POST["search"]["value"].'%" 
 OR customer.firstName LIKE "%'.$_POST["search"]["value"].'%" 
 OR customer.lastName LIKE "%'.$_POST["search"]["value"].'%"
 OR customer.tele_no LIKE "%'.$_POST["search"]["value"].'%"
 OR customer.addr_id LIKE "%'.$_POST["search"]["value"].'%"
 OR customer.email LIKE "%'.$_POST["search"]["value"].'%"
 OR customer.dob LIKE "%'.$_POST["search"]["value"].'%"
 OR users.verified LIKE "%'.$_POST["search"]["value"].'%"
 OR users.username LIKE "%'.$_POST["search"]["value"].'%"
 OR address.addr_ln1 LIKE "%'.$_POST["search"]["value"].'%"
 OR address.addr_postcode LIKE "%'.$_POST["search"]["value"].'%"
 OR address.addr_country LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
    $query .= 'ORDER BY cust_id DESC ';
}

$query1 = '';


$number_filter_row = mysqli_num_rows(mysqli_query($connection, $query));

$result = mysqli_query($connection, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $sub_array = array();
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="cust_id">' . $row["cust_id"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="firstName">' . $row["firstName"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="lastName">' . $row["lastName"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="tele_no">' . $row["tele_no"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="addr_id">' . $row["addr_id"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="addr_ln1">' . $row["addr_ln1"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="addr_ln2">' . $row["addr_ln2"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="addr_city">' . $row["addr_city"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="addr_postcode">' . $row["addr_postcode"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="addr_country">' . $row["addr_country"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="username">' . $row["username"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="email">' . $row["email"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="dob">' . $row["dob"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="verified">' . $row["verified"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["cust_id"].'" data-column="password">' . $row["password"] . '</div>';
    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" data-id3="'.$row["cust_id"].'" data-column="cust_id"><i class="fas fa-user-minus"></i> Delete</button>';
    $sub_array[] = '<button type="button" name="update" class="btn btn-warning btn-xs update" data-id3="'.$row["cust_id"].'" data-column="cust_id"><i class="fas fa-user-edit"></i> Update</button>';
    $data[] = $sub_array;
}

function get_all_data($connection)
{
    $query = "SELECT * FROM customer INNER JOIN users using (cust_id) INNER JOIN address USING (addr_id)";
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
