<?php
include 'credentials.php';
include 'headerZashas2.php';

$total = 0;
foreach($_SESSION['basket'] as $row) {
    $prod_id = $row['prod_id'];
//    $sql = "SELECT * FROM images WHERE prod_id = '$prod_id'";
//    $resImg = mysqli_query($connection, $sql);
//    $rowImg = mysqli_fetch_assoc($resImg);
//    $img = $rowImg['file_name'];

////    $prodtitlesubstr = substr($row['prod_dscr'], 0, 50);
//    echo "<p>";
//    echo $prodtitlesubstr;
//    $str = strlen($prodtitlesubstr);
//    if ($str == 50)
//    {
//        echo "...";
//    }


    $subTotal = $row['price'] * $row['prod_qty'];

    $total = $total + $subTotal;
}


$username= $_SESSION['username'];

if(isset($_SESSION['basket'])) {
    if (count($_SESSION['basket']) > 0) {
//    echo '<pre>';
//    var_dump($_SESSION);
//    echo '</pre>';
        ?>
        <div class="container-fluid px-1 px-md-2 px-lg-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-sm-11">
                    <form method="post">
                    <div class="cardss border-0">
                        <div class="row justify-content-center">
                            <h3 class="mb-4">Credit Card Checkout</h3>
                        </div>
                        <div class="row">

                            <div class="col-sm-7 border-line pb-3">
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">Name on the card</p> <input type="text" name="name" placeholder="Name" size="15" required>
                                </div>
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">Card Number</p>
                                    <div class="row px-3"> <input type="number" name="card-num" placeholder="0000 0000 0000 0000" size="18" id="cr_no" minlength="19" maxlength="19" required>
                                        <p class="mb-0 ml-3">/</p> <img class="image ml-1" src="https://i.imgur.com/WIAP9Ku.jpg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">Expiry date</p> <input type="date" name="exp" placeholder="MM/YY" size="6" id="exp" minlength="5" maxlength="5" required>
                                </div>
                                <div class="form-group">
                                    <p class="text-muted text-sm mb-0">CVV/CVC</p> <input type="password" name="cvv" placeholder="000" size="1" minlength="3" maxlength="3" required>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input" checked> <label for="chk1" class="custom-control-label text-muted text-sm">save my card for future payment</label> </div>
                                </div>
                            </div>
                            <div class="col-sm-5 text-sm-center justify-content-center pt-4 pb-4"> <small class="text-sm text-muted">Order number</small>
                                <h5 class="mb-5">#12345678</h5> <small class="text-sm text-muted">Payment amount</small>
                                <div class="row px-3 justify-content-sm-center">
                                    <h2 class=""><span class="text-md font-weight-bold mr-2">£</span><span class="text-danger"><?php echo $total ?></span></h2>
                                </div>  <button type="submit" name="pay" class="btn btn-red text-center mt-4">PAY</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php

//$prod_id = $_SESSION['basket'][1][1];
//print_r($_SESSION['basket']);

        if (isset($_POST['pay'])) {
            $totalOrder = 0;
            foreach ($_SESSION['basket'] as $item) {


                $updateQTY = "UPDATE products SET prod_qty = prod_qty - '{$item['prod_qty']}' WHERE prod_id = '{$item['prod_id']}'";
                $resultQTY = mysqli_query($connection, $updateQTY);
//                echo $updateQTY;
//                echo "<br>";
//        $rowImg = mysqli_fetch_assoc($resImg);

                $totalOrder = $totalOrder + $item['price'] * $item['prod_qty'];


            }
            $selectUserId = "SELECT cust_id FROM users WHERE username = '$username'";
            echo $selectUserId;
            $resultUserId = mysqli_query($connection, $selectUserId);
            $user_id_row = mysqli_fetch_assoc($resultUserId);
            $user_id_selected = $user_id_row['cust_id'];

            $insertOrder = "INSERT INTO orders(cust_id, total) VALUES ('$user_id_selected', '$totalOrder' )";
//        echo $insertOrder;
            $resultOrder = mysqli_query($connection, $insertOrder);
//            echo $insertOrder;
//            echo "<br>";
            //$rowImg = mysqli_fetch_assoc($resImg);


            $OrderIdQuery = "SELECT * FROM orders WHERE cust_id = '$user_id_selected' ORDER BY order_id DESC";
//            echo $OrderIdQuery;
            $resultOrderId = mysqli_query($connection, $OrderIdQuery);
            $order_id_row = mysqli_fetch_assoc($resultOrderId);
            $order_id = $order_id_row['order_id'];

            foreach ($_SESSION['basket'] as $item2) {
                $subtotal = $item2['price'] * $item2['prod_qty'];

                $insertOrderline = "INSERT INTO products_orders(order_id, prod_id, prod_quantity, product_line_cost) VALUES ('$order_id', '{$item2['prod_id']}', '{$item2['prod_qty']}', '$subtotal' )";
//                echo $insertOrderline;
                $resultOrderline = mysqli_query($connection, $insertOrderline);
//            echo $insertOrderline;
                echo "<br>";
            }
        $_SESSION['basket'] = array();

            echo <<<_END
 <script type="text/javascript">
        window.location.href = 'paymentSuccessful.php';
    </script>
_END;
        }
    } else {
        echo "<h3>Basket is empty</h3>";
    }
}


require_once 'footer.php';
