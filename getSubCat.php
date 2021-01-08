<?php
require_once 'credentials.php';


$q = intval($_GET['q']);

$sql="Select sub_cat from category WHERE cat_id = '".$q."' ";
$result = mysqli_query($connection,$sql);
echo "<select class='custom-select' style='width:100%; margin-top: 3px;' name='sub_cat' onchange='subSub(this.value)'>";
echo "<option selected disabled hidden>select sub-sub-cat</option>";
while ($row = mysqli_fetch_array($result))
{
    echo "<option  name='{$row["sub_cat"]}' >" . htmlspecialchars($row["sub_cat"]) . "</option>";
}
echo "</select>";
//?>