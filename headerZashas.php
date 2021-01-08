<?php
include_once "credentials.php";
session_start();

$searchAuto = "SELECT prod_title FROM products";
$resultSearchAuto = mysqli_query($connection, $searchAuto);
$nSearch = mysqli_num_rows($resultSearchAuto);
if ($nSearch>0){
    $productList = array();

    for($i=0; $i < $nSearch; $i++){
        $productsRow = mysqli_fetch_assoc($resultSearchAuto);
        foreach ($productsRow as $list){
            array_push($productList, $list);
        }
    }
    $json = json_encode($productList);


}
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Zashas</title>

        <!--  LINKS  -->
        <link rel="stylesheet" href="bootstrap/flickity.css">
        <script src="bootstrap/flickity.pkgd.min.js"></script>

        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!--  Carousel   -->
        <!--    <link href="http://cdn.shopify.com/s/files/1/0067/5617/1846/t/2/assets/timber.scss.css" rel="stylesheet" type="text/css" media="all" />-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet" type="text/css" media="all" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
        <script src="https://kit.fontawesome.com/fd4875d74b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="Hover-master/css/hover.css">

        <!--    custom Stylesheet-->
        <link rel="stylesheet" href="css/main1.css.css">
    </head>

    <script type="text/javascript">
        function zoom() {
            document.body.style.zoom = "90%"
        }
    </script>

    <!--<body >-->

<body onload="zoom()">
<?php
if (isset($_SESSION['loggedIn']) && ($_SESSION['username']=='admin'))
{
    ?>
    <div id="topGrey" style="background-color: #303030; width: 100%; height: 80px;">
        <div style=" float: right; margin-right: 30px; margin-top: 20px; color: white"> Hello <?php echo $_SESSION['username']?> </div>
        <div id="myPageContent" class="container-fluid">
            <section id="home">
                <div id="textSlider" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4 iamCol">
                        <p style="text-align: left">Why</p>
                        <p>Zashas?</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6 slideCol">
                        <div class="scroller">
                            <div class="inner">
                                <p class="fas fa-angle-double-up">Free Returns</p>
                                <p>Best Prices</p>
                                <p>24/7 Support</p>
                                <p class="fas fa-user-shield">100% Secured</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="hvr-float-shadow" id="logoZashas" href="index.php"><strong>ZASHAS</strong></a>
            <ul class="navbar-nav mr-5 mt-5 mt-lg-2 basketMar">
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="hotDeals.php"><h5><i class="fas fa-fire-alt"><br></i>HotDeals</h5></a>
                </li>
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="wish.php"><h5><i class="fas fa-heart"><br></i>Saved Items</h5></a>
                </li>
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="recentlyAdded.php"><h5><i class="fas fa-bolt"></i>Recently Added</h5></a>
                </li>
            </ul>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <!--        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>
                $( function() {
                    let prodList = <?php echo $json ?>;
                    console.log(prodList);
                    $( 'input[name="search"]' ).autocomplete({
                        source: prodList
                    });
                } );
            </script>
            <form class="form-inline my-5 my-lg-3" action="searchResults.php?searchName=<?php echo $_GET['search']; ?>">
                <input class="form-control mr-sm" name="search" id="searchBar" type="search" placeholder="What are you looking for?" aria-label="Search">
                <button class="btn btn-sm searchBar" style="color: white;" type="submit">Search</button>
            </form>
            <ul class="navbar-nav mr-5 mt-5 mt-lg-2 basketMar">
                <li class="mr-1 libasket" style="float: right">

                    <?php
                    // count products in cart
                    $cart_count=count($_SESSION['basket']);
                    ?>
                    <a class="hvr-float-shadow" href="checkout.php"><h5><i class="fas fa-shopping-cart"></i>Basket(<span class="badge" id="comparison-count"><?php echo$cart_count;?></span>)</h5>
                </li>
            </ul>
            <div class="dropdown" style="float: right;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown" style="color: #5BC0DE">My Account</a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="myProfile.php"><i class="far fa-id-badge fa-fw"></i>MyAccount</a>
                    <a class="dropdown-item" href="edit_users.php"><i class="fas fa-users"></i> All Users</a>
                    <a class="dropdown-item" href="admin_tools.php"><i class="fas fa-tools"></i> Admin Tools</a>
                    <hr>
                    <a class="dropdown-item" href="logout.php">Log out</a>
                </div>
            </div>

    </nav>
    <?php
}
else if (isset($_SESSION['loggedIn']) && ($_SESSION['username']!='admin'))
{
    ?>
    <div id="topGrey" style="background-color: #303030; width: 100%; height: 80px;">
        <div style=" float: right; margin-right: 30px; margin-top: 20px; color: white"> Hello <?php echo $_SESSION['username']?> </div>
        <div id="myPageContent" class="container-fluid">
            <section id="home">
                <div id="textSlider" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4 iamCol">
                        <p style="text-align: left">Why</p>
                        <p>Zashas?</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6 slideCol">
                        <div class="scroller">
                            <div class="inner">
                                <p class="fas fa-angle-double-up">Free Returns</p>
                                <p>Best Prices</p>
                                <p>24/7 Support</p>
                                <p class="fas fa-user-shield">100% Secured</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="hvr-float-shadow" id="logoZashas" href="index.php"><strong>ZASHAS</strong></a>
            <ul class="navbar-nav mr-5 mt-5 mt-lg-2 basketMar">
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="hotDeals.php"><h5><i class="fas fa-fire-alt"><br></i>HotDeals</h5></a>
                </li>
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="wish.php"><h5><i class="fas fa-heart"><br></i>Saved Items</h5></a>
                </li>
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="recentlyAdded.php"><h5><i class="fas fa-bolt"></i>Recently Added</h5></a>
                </li>
            </ul>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <!--        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>
                $( function() {
                    let prodList = <?php echo $json ?>;
                    console.log(prodList);
                    $( 'input[name="search"]' ).autocomplete({
                        source: prodList
                    });
                } );
            </script>
            <form class="form-inline my-5 my-lg-3" action="searchResults.php?searchName=<?php echo $_GET['search']; ?>">
                <input class="form-control mr-sm" name="search" id="searchBar" type="search" placeholder="What are you looking for?" aria-label="Search">
                <button class="btn btn-sm searchBar" style="color: white;" type="submit">Search</button>
            </form>
            <ul class="navbar-nav mr-5 mt-5 mt-lg-2 basketMar">
                <li class="mr-1 libasket" style="float: right">

                    <?php
                    // count products in cart
                    $cart_count=count($_SESSION['basket']);
                    ?>
                    <a class="hvr-float-shadow" href="checkout.php"><h5><i class="fas fa-shopping-cart"></i>Basket(<span class="badge" id="comparison-count"><?php echo$cart_count;?></span>)</h5>
                </li>
            </ul>
            <div class="dropdown" style="float: right;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown" style="color: #5BC0DE">My Account</a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="myProfile.php"><i class="far fa-id-badge fa-fw"></i>MyAccount</a>
                    <hr>
                    <a class="dropdown-item" href="logout.php">Log out</a>
                </div>
            </div>

    </nav>
    <?php
}
else
{
    ?>
    <div id="topGrey" style="background-color: #303030; width: 100%; height: 80px;">
        <div id="myPageContent" class="container-fluid">
            <section id="home">
                <div id="textSlider" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4 iamCol">
                        <p style="text-align: left">Why</p>
                        <p>Zashas?</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6 slideCol">
                        <div class="scroller">
                            <div class="inner">
                                <p class="fas fa-angle-double-up">Free Returns</p>
                                <p>Best Prices</p>
                                <p>24/7 Support</p>
                                <p class="fas fa-user-shield">100% Secured</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="hvr-float-shadow" id="logoZashas" href="index.php"><strong>ZASHAS</strong></a>
            <ul class="navbar-nav mr-5 mt-5 mt-lg-2 basketMar">
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="hotDeals.php"><h5><i class="fas fa-fire-alt"><br></i>HotDeals</h5></a>
                </li>
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="wish.php"><h5><i class="fas fa-heart"><br></i>Saved Items</h5></a>
                </li>
                <li class="mr-1 libasket">
                    <a class="hvr-float-shadow" href="recentlyAdded.php"><h5><i class="fas fa-bolt"></i>Recently Added</h5></a>
                </li>
            </ul>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <!--        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>
                $( function() {
                    let prodList = <?php echo $json ?>;
                    console.log(prodList);
                    $( 'input[name="search"]' ).autocomplete({
                        source: prodList
                    });
                } );
            </script>
            <form class="form-inline my-5 my-lg-3" action="searchResults.php?searchName=<?php echo $_GET['search']; ?>">
                <input class="form-control mr-sm" name="search" id="searchBar" type="search" placeholder="What are you looking for?" aria-label="Search">
                <button class="btn btn-sm searchBar" style="color: white;" type="submit">Search</button>
            </form>
            <div class="dropdown" style="float: right; margin-left: 10%;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown" style="color: #5BC0DE">Login/Register</a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="login.php"><i class="fas fa-sign-in-alt"></i>Login</a>
                    <a class="dropdown-item" href="register.php"><i class="fas fa-user-plus"></i>Register</a>
                </div>
            </div>

    </nav>
    <?php
}
?>