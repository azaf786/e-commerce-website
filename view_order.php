<?php
require_once "headerZashas2.php";
require_once "credentials.php";
if (isset($_SESSION['loggedIn'])) {
    $order_id= $_GET['order_id'];
    $order_total= $_GET['order_total'];



    ?>
    <br>


   <center> <h2 style="font-family: 'Spirax', cursive"><strong>Order No <?php echo $order_id ?></strong></h2></center>
    <hr>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Title</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Sub Total</th>
        </tr>
        </thead>
        <tbody>

        <?php

    $selectOrderLine = "SELECT * FROM products_orders WHERE order_id = '$order_id'";


//                echo $selectViewOrder;
    $resultOrder = mysqli_query($connection, $selectOrderLine);
    $nOrder = mysqli_num_rows($resultOrder);


    for($i = 0; $i < $nOrder; $i++)
    {
        $order_row = mysqli_fetch_assoc($resultOrder);

        $prod_id = $order_row['prod_id'];
        $prod_quantity = $order_row['prod_quantity'];
        $prod_line_cost = $order_row['product_line_cost'];

        $selectProduct = "SELECT * FROM products WHERE prod_id = '$prod_id'";
        $resultProd = mysqli_query($connection, $selectProduct);
        $order_row = mysqli_fetch_assoc($resultProd);

        $prod_title = $order_row['prod_title'];
        $prod_price = $order_row['price'];


        ?>
        <tr>
            <th  scope="row"><?php echo $nOrder ?></th>
            <td ><?php echo $prod_title ?></td>
            <td ><?php echo $prod_price ?></td>
            <td ><?php echo $prod_quantity ?></td>
            <td ><?php echo $prod_line_cost ?></td>
        </tr>
        <?php } ?>

        <tr>
            <td style="border-right-color: white; border-bottom-color: white"></td>
            <td style="border-right-color: white; border-bottom-color: white"></td>
            <td style=" border-bottom-color: white"></td>
            <th style="border-right-color: white" scope="row"><h2 style="font-family: 'Spirax', cursive; float: right"><strong>Total</strong></h2></th>

            <td style="font-family: 'Spirax', cursive"><strong><?php echo $order_total?></td></strong>
        </tr>
        </tbody>
    </table>



<?php




}


require_once 'footer.php';
