<?php

require_once 'headerZashas2.php';
require_once 'credentials.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($connection, $sql);
$ns = mysqli_num_rows($result);
if($n> 0) {

    $row = mysqli_fetch_assoc($result);
    $prod_id = $row["prod_id"];
    $img = "SELECT * FROM images WHERE prod_id = '$prod_id' ";
    $imgRes = mysqli_query($connection, $img);
    $n = mysqli_num_rows($imgRes);
?>
<nav class="product-filter">
    <div class="sort">

        <div class="collection-sort">
            <label>Filter by:</label>
            <select>
<?php
    for($i=0; $i<$n; $i++)
    {
        $row = mysqli_fetch_assoc($result);
       // $prod_title = $row['prod_title'];
        $prod_qty = $row['prod_qty'];
        $prod_dscr = $row['prod_dscr'];
        //$prod_price = $row['price'];
        $prod_qty = $row['prod_qty'];
        $prod_cat = $row['prod_cat'];
?>
        <option value="<?php echo $prod_cat ?>"><?php echo $prod_cat ?></option>
    <?php } ?>
      </select>
    </div>

    <div class="collection-sort">
      <label>Sort by:</label>
      <select>
        <option value="/">Featured</option>
          <option value="/">Newly Listed</option>
      </select>
    </div>

  </div>

</nav>

<div class="container">
    <h3 class="h3">All Products</h3>
    <div class="row">

    <?php
    for($w=0; $w<$ns; $w++)
    {
        $img = "SELECT * FROM images WHERE prod_id = '$prod_id' ";
        $imgRes = mysqli_query($connection, $img);
    $row = mysqli_fetch_assoc($result);
    $prod_id = $row['prod_id'];
    $prod_title = $row['prod_title'];
    $prod_price = $row['price'];

    $imgRow = mysqli_fetch_assoc($imgRes);
    $images = $imgRow["file_name"];

    ?>
        <div class="col-md-3 col-sm-6 prod_card">
            <div class="product-grid2">
                <div class="product-image2">
                    <a href="product.php?prodId<?php echo "=".$prod_id ?>">
                        <img class="pic-1" src="images/<?php echo $images?>">
                    </a>
                    <ul class="social">
                        <li><a href="#" data-tip="Add to Wishlist"><i class="fas fa-shopping-basket"></i></i></a></li>
                        <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                    </ul>
                    <a class="add-to-cart" href="">Buy Now</a>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="product.php?prodId<?php echo "=".$prod_id ?>"><?php echo $prodtitlesubstr = substr($prod_title,0, 50);
                    $str =  strlen($prodtitlesubstr);
                    if($str == 50)
                    {
                        echo "...";
                    }
                    ?></a></h3>
                    <?php $url = "product.php?prodId=$prod_id" ?>
                    <form action="<?php echo $url ?>" method="post">
                    <div class = 'priceButton'>
                        <button class="glow-on-hover" type="submit">£<?php echo $prod_price ?></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
<?php } ?>
    <!-- more products -->

        </div>
    </div>

<?php }
else{
    echo"select products query failed";
}?>

<?php
require_once 'footer.php';
?>