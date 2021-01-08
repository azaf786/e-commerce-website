<?php
include 'credentials.php';
include 'headerZashas2.php';


echo <<<_END
<link rel="stylesheet" href="css/checkout.scss">
<div class="container">
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
_END;
$destruction = 0;
$total=0;
foreach($_SESSION['basket'] as $row) {
    $prod_id = $row['prod_id'];
    $sql = "SELECT * FROM images WHERE prod_id = '$prod_id'";
    $resImg = mysqli_query($connection, $sql);
    $rowImg = mysqli_fetch_assoc($resImg);
    $img = $rowImg['file_name'];
    echo <<<_END
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="images/$img" alt="cart_img" class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin">{$row["prod_title"]}</h4>
_END;
    $prodtitlesubstr = substr($row['prod_dscr'], 0, 50);
    echo "<p>";
    echo $prodtitlesubstr;
    $str = strlen($prodtitlesubstr);
    if ($str == 50)
    {
        echo "...";
    }
    echo "</p>";
    echo <<<_END
									</div>
								</div>
							</td>
							<td data-th="Price">£{$row['price']}</td>
							<td data-th="Quantity">
							<form method="get">
								<input type="number" id="quantity" name="quantity" class="form-control text-center" value="{$row['prod_qty']}" disabled>
                            </form>
							</td>
_END;

    $subTotal = $row['price'] * $row['prod_qty'];
    echo <<<_END
							<td data-th="Subtotal" class="text-center">£ {$subTotal}</td>
							<td class="actions" data-th="">
							<form method="post">
<!--								<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>-->
								<button style="background-color: #303030" type="submit" name="remove" value={$destruction} class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                            </form>	
							</td>
						</tr>
_END;
    $destruction++;
    $total = $total + $subTotal;
}

?>
    </tbody>
    <tfoot>
    <tr>
        <td><a style="background-color: #303030" href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total £<?php echo $total ?></strong></td>
        <!--							<td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>-->
        <td><form action="payment.php" method="post">
                <button style="background-color: #303030" type="submit" name="remove" class="btn btn-success btn-block">Checkout</button>
            </form>	</td>
    </tr>
    </tfoot>
    </table>
    </div>
<?php
if(isset($_POST['remove']))
{
    echo "DELETED" . $_POST['remove'];
    unset($_SESSION['basket'][$_POST['remove']]);
    $_SESSION['basket'] = array_values($_SESSION['basket']);
    ?>
    <script type="text/javascript">
        window.location.href = 'checkout.php';
    </script>
    <?php
}
?>