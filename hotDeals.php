<?php

require_once 'headerZashas2.php';
require_once 'credentials.php';


?>

<link rel="stylesheet" href="../package/css/swiper.min.css">
<hr>
<div style="background-color: #303030" class="alert alert" role="alert">
    <h2 style="padding-left: 10px; color: white"><strong>Hot Deals!</strong> </h2>
</div>
<hr>


<?php


$prod = "SELECT * FROM products WHERE price < 50 ORDER BY price ASC LIMIT 10 ";
$resProd = mysqli_query($connection, $prod);
$nProd = mysqli_num_rows($resProd);
if($nProd){

    ?>

    <script>
        $(document).ready(function() {
            $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
            $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
        });
    </script>





    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <div class="btn-group">
                    <button style="background-color: #3c3c3c" class="btn btn-info" id="list">
                        List View
                    </button>
                    <button style="background-color: #4e555b"  class="btn btn-danger" id="grid">
                        Grid View
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
    <div id="products" class="row view-group">
        <?php
        for($i = 0; $i < $nProd; $i++){
            $rowProd = mysqli_fetch_assoc($resProd);
            $prod_id = $rowProd['prod_id'];
            $prod_title = $rowProd['prod_title'];
            $prod_price = $rowProd['price'];
            $prod_dscr = $rowProd['prod_dscr'];
            $img = "SELECT * FROM images WHERE prod_id = '$prod_id' LIMIT 1";
            $resImg = mysqli_query($connection, $img);
            $imgRow = mysqli_fetch_assoc($resImg);
            $images = $imgRow['file_name'];
            ?>

        <div class="item col-xs-4 col-md-4 p-3 productIndex grow">

            <div style="min-height: 10vh; max-height: 10vh" class=" product-grid2 ">
                <div class="card"  id="cardheight" style="">

                <div class="img-event">
                        <a href="product.php?prodId<?php echo "=".$prod_id ?>"><img id="cardh" class="group list-group-image h- img-fluid" src="images/<?php echo $images?>" alt="images"/></a>
                    </div>

                    <div class="caption card-body">

                        <a href="product.php?prodId<?php echo "=".$prod_id ?>"><h5 class="group card-title inner list-group-item-heading" style="color: #3c3c3c"><?php echo $prodtitlesubstr = substr($prod_title,0, 15);
                                ?>
                                <br>
                                <br>
                                <div class="col-xs-12 justify-content-center">
                                    <b class="p-2">£<?php echo $prod_price?></b>
                                </div>
                                <?php
                                $str =  strlen($prodtitlesubstr);
                                if($str == 50)
                                {
                                    echo "...";
                                }
                                ?></h5></a>
                        <h6 class="group inner list-group-item-text"><?php echo $prod_dscr= substr($prod_dscr,0, 40);
                            $str =  strlen($prod_dscr);
                            if($str == 135)
                            {
                                echo "...";
                            }?></h6>

                        <div>
                            <div class="col-xs-12">
                                <center><a style="position: -ms-device-fixed" class="p-2 glow-on-hover btn" href="product.php?prodId<?php echo "=".$prod_id ?>">View</a></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>
    </div>
<?php } ?>

<?php
require_once 'footer.php';
?>


