<?php
include_once "credentials.php";
session_start();

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Zashas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Hover-master/css/hover.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/084196be51.js" crossorigin="anonymous"></script>
    <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="css/main.css" rel="stylesheet">
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/jamesclavel/pen/NvNmzP?limit=all&page=56&q=uikit" />
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.27/css/uikit.min.css'>


<!--//////////////////////////-->
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
_END;
// CHECK FOR CURRENT USER BEING LOGGED IN AS ADMIN ACCOUNT
if (isset($_SESSION['loggedIn']) && ($_SESSION['username']=='admin'))
{
    echo <<<_END
         <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light" style="background-color: #E9E9E9 ;">
    <a class="hvr-float-shadow" href="index.php"><img id = "logo" src="images/cover.png" ></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-fire-alt"><br></i>HotDeals</h5></a>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-heart"></i>SavedItems</h5></a>
            </li>
        </ul>

   <div class="search">
      <input type="text" class="searchTerm" placeholder="What are you looking for?">
      <button type="submit" class="searchButton">
        <i class="fa fa-search"></i>
     </button>
   </div>

    <ul class="navbar-nav mr-auto">
     <li>
             <a class="hvr-float-shadow" href="admin_tools.php"><h5><i class="fas fa-tools"></i>AdminTools </h5><span class="sr-only">(current)</span></a>
        </li>
        <li>
            <a class="hvr-float-shadow" href="myOrder.php"><h5><i class="far fa-id-badge fa-fw"></i>MyAccount</h5><span class="sr-only">(current)</span></a>
        </li>
        <li>
             <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-shopping-basket fa-fw"></i>Basket </h5><span class="sr-only">(current)</span></a>
        </li>
         <li>
            <a class="hvr-float-shadow" href="logout.php"><h5><i class="far fa-user fa-fw"></i>LogOut({$_SESSION['username']})</h5><span class="sr-only">(current)</span></a>
        </li>
    </ul>
</div>
</nav>
_END;
}

// CHECK FOR CURRENT USER BEING LOGGED IN AS REGISTERED USERS
else if (isset($_SESSION['loggedIn']) && ($_SESSION['username']!='admin')) {
    echo <<<_END
    <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light" style="background-color: #E9E9E9 ;">
    <a class="hvr-float-shadow" href="index.php"><img id = "logo" src="images/cover.png" ></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-fire-alt"><br></i>HotDeals</h5></a>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-heart"></i>SavedItems</h5></a>
            </li>
        </ul>

   <div class="search">
      <input type="text" class="searchTerm" placeholder="What are you looking for?">
      <button type="submit" class="searchButton">
        <i class="fa fa-search"></i>
     </button>
   </div>

    <ul class="navbar-nav mr-auto">
       <li>
            <a class="hvr-float-shadow" href="logout.php"><h5><i class="far fa-user fa-fw"></i>LogOut({$_SESSION['username']})</h5><span class="sr-only">(current)</span></a>
        </li>
        <li>
            <a class="hvr-float-shadow" href="myOrder.php"><h5><i class="far fa-id-badge fa-fw"></i>MyAccount</h5><span class="sr-only">(current)</span></a>
        </li>
        <li>
             <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-shopping-basket fa-fw"></i>Basket </h5><span class="sr-only">(current)</span></a>
        </li>
    </ul>
</div>
</nav>
_END;
}
// NO ACCOUNT - PUBLIC VIEW OF THE SITE MENU
else {
    echo <<<_END
              <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light" style="background-color: #E9E9E9 ;">
    <a class="hvr-float-shadow" href="index.php"><img id = "logo" src="images/cover.png" ></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-fire-alt"><br></i>HotDeals</h5></a>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="hvr-float-shadow" href="#new releases"><h5><i class="fas fa-heart"></i>New Releases</h5></a>
            </li>
        </ul>
<ul class="navbar-nav mr-auto">
   <div class="search">
      <input type="text" class="searchTerm" placeholder="What are you looking for?">
      <button type="submit" class="searchButton">
        <i class="fa fa-search"></i>
     </button>
   </div>
   </ul>

    <ul class="navbar-nav mr-auto">
       <li>
            <a class="hvr-float-shadow" href="login.php"><h5><i class="far fa-user fa-fw"></i>Login/Register</h5><span class="sr-only">(current)</span></a>
        </li>
        <li>
             <a class="hvr-float-shadow" href="#"><h5><i class="fas fa-shopping-basket fa-fw"></i>Basket </h5><span class="sr-only">(current)</span></a>
        </li>
    </ul>
</div>
</nav>
_END;
}

$sql = "SELECT * FROM category LIMIT 6";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

foreach ($result as $row){
    $category = $row['cat_title'];
    echo <<<_END
        <li>
            <a class="hvr-shadow-radial test" href=?category=$category>$category</a>
        </li>
_END;
}


echo " <br> <br> <br></head>";

//echo '<pre>'; var_dump($_SESSION); echo '</pre>';
?>