<?php
require_once 'credentials.php';
$q = $_GET['q'];

$sql="Select sub_sub_cat from category WHERE sub_cat = '".$q."' ";
$result = mysqli_query($connection,$sql);
echo "<select class='custom-select' style='width:100%;  margin-top: 3px; margin-bottom: 3px;' name='sub_sub_cat'>";
while ($row = mysqli_fetch_array($result))
{
    echo "<h1>Select Sub-Sub-Category</h1>";
    echo "<option name='{$row["sub_sub_cat"]}' >" . htmlspecialchars($row["sub_sub_cat"]) . "</option>";
}

echo "</select>";



//?>