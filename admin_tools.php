<?php
require_once "headerZashas.php";
require_once "credentials.php";


if(isset($_SESSION['loggedIn']) && $_SESSION['username'] == "admin"){
    echo <<<_END
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="css/main1.css">
_END;

    if(isset($_POST['submit']))
    {
        $images = $_FILES['image']['name'];
        $path = 'images/'.$images;

        $sql = "INSERT INTO slider (slider_img) VALUES ('$path')";
        $result = mysqli_query($connection, $sql);
        if($result){
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            echo <<<_END
           <div class="alert alert-success alert-dismissible fade show" role="alert">
              Image uploaded <strong>Successfully!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
           </div>
_END;
        }
        else
        {
            echo <<<_END
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
             An <strong>Error</strong> occurred while uploading the image. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
           </div>
_END;
        }
    }


echo <<<_END
<div class="row justify-content-center slider_upload_div">
    <div style="background-image: linear-gradient(90deg, rgba(48,48,48,1) 0%, rgba(72,72,72,1) 46%, rgba(48,48,48,1) 100%, rgba(48,48,48,1) 303030%)" class="col-lg-4 rounded px-5">
        <h5 style="color: white" class="text-center p-3">Select images for the slider</h5>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group slider_input">
                <input type="file" name="image" class="form-control p-1" required>
            </div>
            <div class="form-group slider_btn">
                <input type="submit" name="submit" value="Upload Image" class=" btn-lg btn-secondary btn-block">
            </div>
        </form>
    </div>
</div>

<div class="row justify-content-center">
<div style="background-image: linear-gradient(90deg, rgba(48,48,48,1) 0%, rgba(72,72,72,1) 46%, rgba(48,48,48,1) 100%, rgba(48,48,48,1) 303030%)" class="card col-md-3 bg-warning rounded px-5" id="catBox" style="width: 20rem;">
<!--  <img class="card-img-top" src="images/cat.jpg" alt="Card image cap">-->
<hr>
<h1 style="color: white">Edit Category</h1>
<hr>
  <div class="card-body">
    <a style="" href="edit_cat.php" class="btn-block btn-lg btn-secondary">Edit Category</a>
  </div>
</div>
<div class="col-sm-1"></div>


<!--<div class="row justify-content-center" style="margin: 0 auto;">-->
<div style="background-image: linear-gradient(90deg, rgba(48,48,48,1) 0%, rgba(72,72,72,1) 46%, rgba(48,48,48,1) 100%, rgba(48,48,48,1) 303030%)" class="card col-md-3 bg-warning rounded px-5" id="catBox" style="width: 20rem;">
<!--  <img class="card-img-top" src="images/cat.jpg" alt="Card image cap">-->
<hr>
<h1 style="color: white">Insert Product</h1>
<hr>
  <div class="card-body">
    <a href="insert_prod.php" class="btn-block btn-lg btn-secondary">Insert Product</a>
  </div>
</div>
</div>
<div class="row justify-content-center">
<!--<div class="row justify-content-center" style="margin: 0 auto;">-->
<div style="background-image: linear-gradient(90deg, rgba(48,48,48,1) 0%, rgba(72,72,72,1) 46%, rgba(48,48,48,1) 100%, rgba(48,48,48,1) 303030%)" class="card col-md-3 bg-warning rounded px-5" id="catBox" style="width: 20rem;">
<!--  <img class="card-img-top" src="images/cat.jpg" alt="Card image cap">-->
<hr>
<h1 style="color: white">Edit <br> Users</h1>
<hr>
  <div class="card-body">
    <a href="edit_users.php" class="btn-block btn-lg btn-secondary">Edit Users Now</a>
  </div>
</div>
<!--</div>-->
<div class="col-sm-1"></div>

<!--<div class="row justify-content-center" style="margin: 0 auto;">-->
<div style="background-image: linear-gradient(90deg, rgba(48,48,48,1) 0%, rgba(72,72,72,1) 46%, rgba(48,48,48,1) 100%, rgba(48,48,48,1) 303030%)" class="card col-md-3 bg-warning rounded px-5" id="catBox" style="width: 20rem;">
<!--  <img class="card-img-top" src="images/cat.jpg" alt="Card image cap">-->
<hr>
<h1 style="color: white">Edit Products</h1>
<hr>
  <div class="card-body">
    <a href="edit_products.php" class="btn-block btn-lg btn-secondary">Edit Products</a>
  </div>
</div>
<!--</div>-->

</div>

_END;

}
else
{
    echo "Permission Denied. You need to be logged in as Admin";
}
