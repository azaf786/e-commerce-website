<?php
require_once 'header1.1.php';
require_once 'credentials.php';


$prod_id = $_GET['prodId'];
$sql = "SELECT * FROM products where prod_id = '$prod_id'";
$result = mysqli_query($connection, $sql);
$n = mysqli_num_rows($result);
if($n> 0) {
    $row = mysqli_fetch_assoc($result);
    $cat_id = $row['cat_id'];
    $prod_qty = $row['prod_qty'];
    $sql2 = "SELECT * FROM category WHERE cat_id = '$cat_id'";
    $result2 = mysqli_query($connection, $sql2);
    $catRow = mysqli_fetch_assoc($result2);
    $cat_title =  $catRow['cat_title'];
    $sub_cat =  $catRow['sub_cat'];
    $sub_sub_cat =  $catRow['sub_sub_cat'];

// $row2 = mysqli_fetch_assoc($result2);

    ?>
    <link href="http://cdn.shopify.com/s/files/1/0067/5617/1846/t/2/assets/timber.scss.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <style>

        .breadcrumb-list > li {
            font-size: 14px;
            list-style: none;
            display: inline;
        }
        .breadcrumb-list > li a:after {
            content: "/";
            vertical-align: middle;
            margin: 0 5px;
            color: #7a7a7a;
        }
        .action-wishlist:hover,
        .action-wishlist:focus{
            color:#fff;
        }
        .add-to-cart.action-wishlist {
            width: 50px;
            text-align: center;
            padding: 0;
        }
        .add-to-cart.action-wishlist i {
            margin-right: 0px;
        }
        .product-add-to-cart .cart-title,
        .product-add-to-cart .cart-title:hover,
        .product-list-action .cart-title,
        .product-list-action .cart-title:hover {
            background-color: transparent;
            border-bottom: none;
            color: inherit;
        }
        .product-add-to-cart .pro-add-btn i,
        .product-list-action .pro-add-btn i {
            margin-right: 10px;
            font-size: 18px;
        }
        .add-to-cart {
            display: inline-block;
        }
        .action-wishlist:hover,
        .action-wishlist:focus{
            color:#fff;
        }
        .add-to-cart.action-wishlist i {
            margin-right: 0px;
        }
        .product-add-to-cart {
            float: none;
        }
        .single-product-wishlist{
            display: inline-block;
            position: relative;
            margin-left: 20px;
        }
        .product-thumbnail .owl-nav  {display: none;}
        .breadcrumb-area {
            padding: 30px 0;
            background-color: #f3f3f3;
        }
        .breadmome-name {
            color: #ff6a00;
            font-size: 24px;
            font-weight: 500;
            text-transform: capitalize;
            margin: 0 0 18px;
        }
        .breadcrumb-content > ul > li {
            display: inline-block;
            list-style: none;
            position: relative;
            font-size: 14px;
            color: #333;
        }
        .breadcrumb-content > ul > li.active{
            color: #ff6a00;
        }
        .breadcrumb-content > ul > li:after {
            content: "/";
            vertical-align: middle;
            margin: 0 5px;
            color: #7a7a7a;
        }
        .breadcrumb-content > ul > li:last-child:after{
            display: none;
        }
        .mt-80 { margin-top: 80px }.mb-80 { margin-bottom: 80px }
        .single-product-name {
            font-size: 22px;
            text-transform: capitalize;
            font-weight: 900;
            color: #444;
            line-height: 24px;
            margin-bottom: 15px;
        }
        .single-product-reviews {
            margin-bottom: 10px;
        }
        .single-product-price {
            margin-top: 25px;
        }
        .single-product-action {
            margin-top: 30px;
            padding-bottom: 30px;
            border-top: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
            float: left;
            width: 100%;
        }
        .product-discount {
            display: inline-block;
            margin-bottom: 20px;
        }
        .product-discount span.price {
            font-size: 28px;
            font-weight: 900;
            line-height: 30px;
            display: inline-block;
            color: #008bff;
        }
        .product-info {
            color: #333;
            font-size: 14px;
            font-weight: 400;
        }
        .product-info p {
            line-height: 30px;
            font-size: 14px;
            color: #333;
            margin-top: 30px;
        }
        .product-add-to-cart span.control-label {
            display: block;
            margin-bottom: 10px;
            text-transform: capitalize;
            color: #232323;
            font-size: 14px;
        }
        .product-add-to-cart {
            overflow: hidden;
            margin: 20px 0px;
            float: left;
            width: 100%;
        }
        .cart-plus-minus-box {
            border: 1px solid #e1e1e1;
            border-radius: 0;
            color: #3c3c3c;
            height: 49px;
            text-align: center;
            width: 50px;
            padding: 5px 10px;
        }
        .product-add-to-cart .cart-plus-minus {
            margin-right: 25px;
        }
        .cart-plus-minus {
            position: relative;
            width: 75px;
            float: left;
            padding-right: 25px;
        }
        .add-to-cart {
            background: #008bff;
            border: 0;
            border-bottom: 3px solid #0680e5;
            color: #fff;
            box-shadow: none;
            padding: 0 30px;
            border-radius: 3px;
            font-weight: 400;
            cursor: pointer;
            font-size: 14px;
            text-transform: capitalize;
            height: 50px;
            line-height: 50px;
        }
        .add-to-cart:hover {
            background: #ff6a00;
            border-color: #e96405;
        }
    </style>

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
                                        <li><a href="view_products.php?category=<?php echo$cat_title?>"><?php echo$cat_title?></a><?php echo$sub_cat?></a><span>/ <?php echo $sub_sub_cat?></span></li>
                                        <!--                                        <li><a href="#">--><?php //echo$sub_cat?><!--</a><span>--><?php //echo $sub_sub_cat?><!--</span></li>-->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['basketAlert'] == true) {

                ?>

                <br>
                <div class="alert alert-success" role="alert">
                    Item has been <strong>added to Basket</strong>
                </div>

                <?php

            }}
        $_SESSION['basketAlert'] =false;

        ?>


        <?php
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['wishAlert'] == true) {

                ?>

                <br>
                <div class="alert alert-info" role="alert">
                    Item has been <strong>added to your Saved Items</strong>
                </div>


                <?php

            }}
        $_SESSION['wishAlert'] =false;

        ?>
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
                                    <img style="min-height: 600px; max-height: 600px;"  class="product-zoom" data-image-id="<?php echo $img_id?>" alt="Main Product Image" data-zoom-image="images/<?php echo $images?>" src="images/<?php echo $images?>">
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
                                                    <img style="max-height: 18vh; min-height: 18vh" src="images/<?php echo $oneImageSrc?>" alt="Carousel Images"></a>
                                                <?php $active++;} else{$notActive = 1;}

                                            if($notActive ==1){
                                                ?>


                                                <a class="product-single__thumbnail"
                                                   data-image="images/<?php echo $allImages?>" data-zoom-image="images/<?php echo $allImages?>" data-image-id="<?php echo $product_id?>">
                                                    <img style="max-height: 18vh; min-height: 18vh" src="images/<?php echo $allImages?>" alt="product image"></a>

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


                                                <div class="product-add-to-cart">
                                                    <span class="control-label">Quantity</span>
                                                    <div class="cart-plus-minus">
                                                        <input max="<?php echo $prod_qty ?>" min="1" class="cart-plus-minus-box" type="number" name="quantity" value="1" required>
                                                    </div>
                                                    <div class="add">

                                                        <button name="addCart" type="submit" class="add-to-cart ajax-spin-cart" id="AddToCart">
                                                            <i class="ion-bag"></i>
                                                            <span class="list-cart-title cart-title" id="AddToCartText">Add to cart</span>
                                                        </button>


                                                        <div class="single-product-wishlist">
                                                            <button type="submit" name="wish" class="add-to-cart action-wishlist wishlist" title="Wishlist"><i class="fa fa-heart"></i></button>
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
        $_SESSION['basketAlert'] =true;
        echo <<<_END
 <script type="text/javascript">
        window.location.href = 'product.php?prodId={$prod_id}';
    </script>
_END;
//   echo '<pre>'; var_dump($_SESSION); echo '</pre>';
    }

    if(isset($_POST['wish'])){
        $row['prod_qty'] = $_POST['quantity'];
        array_push($_SESSION['wishlist'], $row);
        $_SESSION['wishAlert']=true;
        echo <<<_END
 <script type="text/javascript">
        window.location.href = 'product.php?prodId={$prod_id}';
    </script>
_END;
//        echo '<pre>'; var_dump($_SESSION); echo '</pre>';
    }
}

require 'footer.php'
?>