<?php
require_once "header1.php";
require_once "credentials.php";


if(isset($_SESSION['loggedIn']) && $_SESSION['username'] == "admin"){


    echo <<<_END
  <div class="row justify-content-center slider_upload_div">
        <div class="col-lg-4 bg-warning rounded px-5">
            <h5 class="text-center p-3">Select images for the slider</h5>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group slider_input">
                    <input type="file" name="image" class="form-control p-1" required>
                </div>
                <div class="form-group slider_btn">
                    <input type="submit" name="submit" value="Upload Image" class="btn-danger btn_slider">
                </div>
            </form>
        </div>
    </div>
    
<div class="card" id="catBox" style="width: 20rem;">
  <img class="card-img-top" src="images/cat.jpg" alt="Card image cap">
  <div class="card-body">
    <a href="edit_cat.php" class="btn btn-success">Edit Category</a>
  </div>
</div>

<div class="card" id="catBox" style="width: 20rem;">
  <img class="card-img-top" src="images/cat.jpg" alt="Card image cap">
  <div class="card-body">
    <a href="insert_prod.php" class="btn btn-success">Insert Product</a>
  </div>
</div>

_END;

    if(isset($_POST['submit']))
    {
        $images = $_FILES['image']['name'];
        $path = 'images/'.$images;

        $sql = "INSERT INTO slider (slider_img) VALUES ('$path')";
        echo $sql;
        $result = mysqli_query($connection, $sql);
        if($result){
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            $message = "Image uploaded successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else
        {
            $message = "Upload failure";
            echo "upload failure";
        }
    }

}
else
{
    echo "Permission Denied. You need to be logged in as Admin";
}
