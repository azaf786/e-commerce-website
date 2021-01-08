<?php
require_once 'header1.php';
require_once 'credentials.php';
$prod_id = $_GET['prodId'];
$sql = "SELECT * FROM products where prod_id = '$prod_id'";
$result = mysqli_query($connection, $sql);
$n = mysqli_num_rows($result);
if($n> 0) {
    $row = mysqli_fetch_assoc($result);
    $cat_id = $row['cat_id'];
    $sql2 = "SELECT * FROM category WHERE cat_id = '$cat_id'";
    $result2 = mysqli_query($connection, $sql2);
    $catRow = mysqli_fetch_assoc($result2);
    $cat_title =  $catRow['cat_title'];
    $sub_cat =  $catRow['sub_cat'];
    $sub_sub_cat =  $catRow['sub_sub_cat'];

// $row2 = mysqli_fetch_assoc($result2);

    ?>
    <div class="wrapper">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-area breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content text-center">
                                <h1 class="breadmome-name breadcrumbs-title">Category</h1>
                                <nav class="" role="navigation" aria-label="breadcrumbs">
                                    <ul class="breadcrumb-list">
                                        <li><a href="#"><?php echo$cat_title?></a></li>
                                        <li><a href="#"><?php echo$sub_cat?></a><span><?php echo $sub_sub_cat?></span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main>
            <?php
            $active = 0;
            $notActive = 0;

            for($i=0; $i <$n; $i++)
            {
            $prod_title = $row['prod_title'];
            $prod_price = $row['price'];
            $prod_dscr = $row['prod_dscr'];

            $sql = "SELECT * FROM images WHERE prod_id = '$prod_id'";
            $result3 = mysqli_query($connection, $sql);
            $nImg = mysqli_num_rows($result3);
            if($nImg > 0)
            {
                $rowImg = mysqli_fetch_assoc($result3);
                $images = $rowImg['file_name'];
                $img_id = $rowImg['img_id'];
            }

            ?>
            <div id="shopify-section-product-template" class="shopify-section">
                <div class="single-product-area mt-80 mb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="product-details-large" id="ProductPhoto">
                                    <img id="ProductPhotoImg" class="product-zoom" data-image-id="<?php echo $img_id?>" alt="Main Product Image" data-zoom-image="images/<?php echo $images?>" src="images/<?php echo $images?>">
                                </div>
                                <div id="ProductThumbs" class="product-thumbnail owl-carousel">
                                    <?php

                                    $thumbQuery = "SELECT * FROM images WHERE prod_id = '$prod_id'";
                                    $result4 = mysqli_query($connection, $thumbQuery);
                                    $result5 = mysqli_query($connection, $thumbQuery);
                                    $allImgs = mysqli_num_rows($result4);
                                    if($allImgs > 0)
                                    {
                                        $oneImage = mysqli_fetch_assoc($result4);
                                        $oneImageSrc = $oneImage['file_name'];
                                        $oneImageID = $oneImage['prod_id'];

                                        ?>

                                        <?php

                                        for($s = 0; $s < $allImgs; $s++)
                                        {

                                            $rowImg = mysqli_fetch_assoc($result5);
                                            $allImages = $rowImg['file_name'];
//                                            echo "|".$s."=".$allImages;
                                            $product_id = $rowImg['prod_id'];
                                            if($active ==0){
//                                    ?>
                                                <a class="product-single__thumbnail active" href="images/<?php echo $images?>" data-image="images/<?php echo $oneImageSrc?>" data-zoom-image="images/<?php echo $oneImageSrc?>" data-image-id="<?php echo $oneImageID?>">
                                                    <img src="images/<?php echo $oneImageSrc?>" alt="Carousel Images"></a>
                                                <?php $active++;} else{$notActive = 1;}

                                            if($notActive ==1){
                                                ?>


                                                <a class="product-single__thumbnail "
                                                   data-image="images/<?php echo $allImages?>" data-zoom-image="images/<?php echo $allImages?>" data-image-id="<?php echo $product_id?>">
                                                    <img src="images/<?php echo $allImages?>" alt="product image"></a>

                                                <?php
                                            }}


                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="single-product-content">
                                    <form method="post" id="AddToCartForm" accept-charset="UTF-8" class="shopify-product-form" enctype="multipart/form-data">
                                        <input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
                                        <div class="product-details">
                                            <h1 id="title" class="single-product-name"><?php echo $prod_title?></h1>
                                            <div class="single-product-price">
                                                <div class="product-discount"><span class="price" id="ProductPrice"><span class=money>£<?php echo $prod_price ?></span></span></div>
                                            </div>
                                            <div class="product-info"><?php echo $prod_dscr?></div>

                                            <div class="single-product-action">
                                                <div class="product-variant-option">
                                                    <script>
                                                        jQuery(function() {
                                                            jQuery('.swatch :radio').change(function() {
                                                                var optionIndex = jQuery(this).closest('.swatch').attr('data-option-index');
                                                                var optionValue = jQuery(this).val();
                                                                jQuery(this)
                                                                    .closest('form')
                                                                    .find('.single-option-selector')
                                                                    .eq(optionIndex)
                                                                    .val(optionValue)
                                                                    .trigger('change');
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                <style>.product-variant-option .selector-wrapper{display: none;}</style>

                                                <div class="product-add-to-cart">
                                                    <span class="control-label">Quantity</span>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                                                    </div>
                                                    <div class="add">

                                                            <button name="addCart" type="submit" class="add-to-cart ajax-spin-cart" id="AddToCart">
                                                                <i class="ion-bag"></i>
                                                                <span class="list-cart-title cart-title" id="AddToCartText">Add to cart</span>
                                                            </button>


                                                        <div class="single-product-wishlist">
                                                            <a class="add-to-cart action-wishlist wishlist" href="#" title="Wishlist"><i class="fa fa-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="secure-payment"><img src="images/sec.jpg"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>


                <style type="text/css">.product-details .countdown-timer-wrapper{display: none !important;}</style>

                <script>$(document).ready(function() {$('.fancybox').fancybox();});</script>
                <script>function productZoom(){
                        $(".product-zoom").elevateZoom({
                            gallery: 'ProductThumbs',
                            galleryActiveClass: "active",
                            zoomType: "inner",
                            cursor: "crosshair"
                        });$(".product-zoom").on("click", function(e) {
                            var ez = $('.product-zoom').data('elevateZoom');
                            $.fancybox(ez.getGalleryList());
                            return false;
                        });

                    };
                    function productZoomDisable(){
                        if( $(window).width() < 767 ) {
                            $('.zoomContainer').remove();
                            $(".product-zoom").removeData('elevateZoom');
                            $(".product-zoom").removeData('zoomImage');
                        } else {
                            productZoom();
                        }
                    };

                    productZoomDisable();

                    $(window).resize(function() {
                        productZoomDisable();
                    });
                </script>
                <script>
                    $('.product-thumbnail').owlCarousel({
                        loop: false,
                        center: false,
                        nav: true,dots:false,
                        margin:10,
                        autoplay: false,
                        autoplayTimeout: 5000,
                        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                        item: 3,
                        responsive: {
                            0: {
                                items: 2
                            },
                            480: {
                                items: 3
                            },
                            992: {
                                items: 3,
                            },
                            1170: {
                                items: 3,
                            },
                            1200: {
                                items: 3
                            }
                        }
                    });
                </script>
            </div>
        </main>
    </div>

<?php
if(isset($_POST['addCart'])){
    $row['prod_qty'] = $_POST['quantity'];
     array_push($_SESSION['basket'], $row);
//    echo '<pre>'; var_dump($_SESSION); echo '</pre>';
}
}
?>