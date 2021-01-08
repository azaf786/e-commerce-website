<?php

require_once 'headerZashas2.php';
require_once 'credentials.php';
$searchedFor = $_GET['search'];

$selectSearch = "SELECT * FROM products WHERE prod_title LIKE '%$searchedFor%'";
$resultSearch = mysqli_query($connection, $selectSearch);


$nSearch = mysqli_num_rows($resultSearch);

?>

<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">

    <hgroup class="mb20">
        <h1>Search Results</h1>
        <h2 class="lead"><strong class="text-danger"><?php echo $nSearch ?></strong> results were found for the search for <strong class="text-danger"><?php echo $searchedFor ?></strong></h2>
    </hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
        <?php

        for($i=0;$i<$nSearch;$i++) {
            $search_prod_row = mysqli_fetch_assoc($resultSearch);
            $product_id = $search_prod_row['prod_id'];
            $product_title = $search_prod_row['prod_title'];
            $product_dscr = $search_prod_row['prod_dscr'];
            $product_cat_id = $search_prod_row['cat_id'];

            $selectCat = "SELECT * FROM category WHERE cat_id = '$product_cat_id'";
            $resultCat = mysqli_query($connection, $selectCat);
            $search_cat_row = mysqli_fetch_assoc($resultCat);
            $cat_title= $search_cat_row['cat_title'];
            $sub_cat= $search_cat_row['sub_cat'];
            $sub_sub_cat= $search_cat_row['sub_sub_cat'];

            $img = "SELECT * FROM images WHERE prod_id = '$product_id' LIMIT 1";
            $resImg = mysqli_query($connection, $img);
            $imgRow = mysqli_fetch_assoc($resImg);
            $images = $imgRow['file_name'];


            ?>
            <article class="search-result row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <a href="product.php?prodId=<?php echo $product_id ?>" title="Lorem ipsum" class="thumbnail"><img style = "max-height: 30vh; max-width: 30vh" src="images/<?php echo $images ?>" alt="Lorem ipsum" /></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <ul class="meta-search">
                        <li><i class="glyphicon glyphicon-calendar"></i> <span><?php echo $cat_title ?></span></li>
                        <li><i class="glyphicon glyphicon-time"></i> <span><?php echo $sub_cat ?></span></li>
                        <li><i class="glyphicon glyphicon-tags"></i> <span><?php echo $sub_sub_cat ?></span></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                    <h3><a href="product.php?prodId=<?php echo $product_id ?>" title=""><?php echo $product_title ?></a></h3>
                    <p><?php echo $product_dscr ?></p>
                    <!--                <span class="plus"><a href="#" title="Lorem ipsum"><i class="glyphicon glyphicon-plus"></i></a></span>-->
                </div>
                <span class="clearfix borda"></span>
            </article>


        <?php } ?>


    </section>
</div>

<?php
require_once 'footer.php';
?>