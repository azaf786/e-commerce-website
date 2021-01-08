<?php
include 'headerZashas2.php';
include 'credentials.php';

if(isset($_SESSION['loggedIn']) && $_SESSION['username'] == "admin") {
    echo <<<_END
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="css/main1.css">
_END;



    $insertForm = true;
    $message = '';
    if ($insertForm)
    {
        echo <<<_END
    <div class="row justify-content-center slider_upload_div">
        <div class="col-lg-4 bg-light rounded px-3">
        <h3 class="text-center">Insert Product</h3>
            <h5><b>$message</b></h5>
            <h6 class="text-left">Select product Images</h6>
            <form action="insert_prod.php" method="post" enctype="multipart/form-data">
                <div class="form-group slider_input">
                     <input class="form-control-file" type="file" name="files[]" multiple>
                </div>
                <div class="form-group slider_input">
                     <input class="form-control-file" type="text" name="prod_title" placeholder="Product Title">
                </div>
                <div class="form-group slider_input">
                     <textarea class="form-control-file" type="text" name="prod_dscr" placeholder="Product Description"></textarea>
                </div>
                <div class="form-group slider_input">
                     <input class="form-control-file" type="number" name="prod_qty" placeholder="Quantity">
                </div>
                <div class="form-group slider_input">
                     <input class="form-control-file" type="text" name="prod_price" placeholder="Price">
                </div>
                <h5>Select Category:</h5>
    <script>
        function showSub(str) {
            if (str == "") {
                document.getElementById("subCat").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                       
                        document.getElementById("subCat").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","getSubCat.php?q="+str,true);
                xmlhttp.send();
            }
        }
        
        function subSub(id)
{
    $.ajax({
        type: "GET",
        url: "getSubSubCat.php",
        data: {q: id},
        success: function(result) {
        $("#selectSubSub").html(result);
    }
    });
}
    </script>
_END;

        $select_query = "Select * from category";
        $sql = mysqli_query($connection, $select_query);
        $row = mysqli_fetch_assoc($sql);

        echo "<select name='options' class='custom-select' style='width:100%; margin-top: 3px; margin-bottom: 3px;' onchange='showSub(this.value)'>";
        echo "<option selected disabled hidden>Please Choose</option>";

        while ($row_cat = mysqli_fetch_array($sql))
        {
            $cat_title = $row_cat['cat_title'];
            echo "<option name='{$cat_id}' value='{$row_cat['cat_id']}' >" . htmlspecialchars($row_cat["cat_title"]) . "</option>";
        }
        $cat_id = $_POST["options"];
        echo "I am second cat id" .$cat_id;

        echo "</select>";
        echo "</select>";
        echo <<<_END

<br>

<div id="subCat"></div>

<div id="selectSubSub"></div>
<div id="subSubCat"></div>
        <div class="form-group slider_btn mr-4">
            <input type="submit" id="insertBtn" name="submitProd" value="Insert Product" class="btn-success btn_slider">
        </div>
    </form>
        </div>
      </div>
_END;
    }

    if(isset($_POST['submitProd'])) {
        echo "I am cat id".$cat_id;
        $prod_title = $_POST['prod_title'];
        $sub_cat = $_POST['sub_cat'];
        $sub_sub_cat = $_POST['sub_sub_cat'];
        $prod_dscr = $_POST['prod_dscr'];
        $price = $_POST['prod_price'];
        $prod_qty = $_POST['prod_qty'];

        $sql = "INSERT INTO products(cat_id, prod_title, prod_dscr, price, prod_qty) VALUES ('$cat_id', '$prod_title', '$prod_dscr', '$price', '$prod_qty' )";
        $result = mysqli_query($connection, $sql);
        if($result){
            $sql = "SELECT * FROM products WHERE cat_id = '$cat_id' AND prod_title = '$prod_title' AND prod_dscr = '$prod_dscr' AND price = '$price' AND prod_qty = '$prod_qty'";
            echo $sql;
            $res = mysqli_query($connection, $sql);
            $n = mysqli_num_rows($res);
            if ($n) {
                $row = mysqli_fetch_assoc($res);
                $prod_id = $row['prod_id'];
                echo $prod_id;
                $targetDir = "images/";
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif', 'webp');

                $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                if (!empty(array_filter($_FILES['files']['name']))) {
                    foreach ($_FILES['files']['name'] as $key => $val) {
                        // File upload path
                        $fileName = basename($_FILES['files']['name'][$key]);
                        $targetFilePath = $targetDir . $fileName;

                        // Check whether file type is valid
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                        if (in_array($fileType, $allowTypes)) {
                            // Upload file to server
                            if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                                // Image db insert sql
                                echo $prod_id;
                                $insertValuesSQL .= "('" . $fileName . "','" . $prod_id . "'),";
                            } else {
                                $errorUpload .= $_FILES['files']['name'][$key] . ', ';
                            }
                        } else {
                            $errorUploadType .= $_FILES['files']['name'][$key] . ', ';
                        }
                    }

                    if (!empty($insertValuesSQL)) {
                        $insertValuesSQL = trim($insertValuesSQL, ',');
                        // Insert image file name into database
//            $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");

                        $insert = "INSERT INTO images (file_name, prod_id) VALUES $insertValuesSQL";
                        echo $insert;
                        $result = mysqli_query($connection, $insert);
                        if ($result) {
                            $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . $errorUpload : '';
                            $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . $errorUploadType : '';
                            $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                            $statusMsg = "Files are uploaded successfully." . $errorMsg;
                            $message = "Product Inserted";
                        } else {
                            $statusMsg = "Sorry, there was an error uploading your file.";
                        }
                    }
                } else {
                    $statusMsg = 'Please select a file to upload.';
                }
                // Display status message
                echo $statusMsg;
                $message = "Products Inserted";
            }

        }
        else{
            $message = "Product Insertion FAILED";
        }
//
//        $sql = "INSERT INTO products(cat_id, prod_title, prod_dscr, price, prod_qty) VALUES ('$cat_id', '$prod_title', '$prod_dscr', '$price', '$prod_qty' )";
//        echo $sql;
//        $result = mysqli_query($connection, $sql);
//        if ($result) {
//            $insertCat = "INSERT INTO category (cat_title, sub_cat, sub_sub_cat) VALUES ('$cat_title', '$sub_cat', '$sub_sub_cat') WHERE cat_id = '$cat_id'";
//            echo $insertCat;
//            $resCat = mysqli_query($connection, $insertCat);
//            if ($resCat) {
//                $sql = "SELECT * FROM products WHERE cat_id = '$cat_id' AND prod_title = '$prod_title' AND prod_dscr = '$prod_dscr' AND price = '$price' AND prod_qty = '$prod_qty'";
//                echo $sql;
//                $res = mysqli_query($connection, $sql);
//                $n = mysqli_num_rows($res);
//                if ($n) {
//                    $row = mysqli_fetch_assoc($res);
//                    $prod_id = $row['prod_id'];
//                    echo $prod_id;
//
//
//                    $targetDir = "images/";
//                    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');
//
//                    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
//                    if (!empty(array_filter($_FILES['files']['name']))) {
//                        foreach ($_FILES['files']['name'] as $key => $val) {
//                            // File upload path
//                            $fileName = basename($_FILES['files']['name'][$key]);
//                            $targetFilePath = $targetDir . $fileName;
//
//                            // Check whether file type is valid
//                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
//                            if (in_array($fileType, $allowTypes)) {
//                                // Upload file to server
//                                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
//                                    // Image db insert sql
//                                    echo $prod_id;
//                                    $insertValuesSQL .= "('" . $fileName . "','" . $prod_id . "'),";
//                                } else {
//                                    $errorUpload .= $_FILES['files']['name'][$key] . ', ';
//                                }
//                            } else {
//                                $errorUploadType .= $_FILES['files']['name'][$key] . ', ';
//                            }
//                        }
//
//                        if (!empty($insertValuesSQL)) {
//                            $insertValuesSQL = trim($insertValuesSQL, ',');
//                            // Insert image file name into database
////            $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");
//
//                            $insert = "INSERT INTO images (file_name, prod_id) VALUES $insertValuesSQL";
//                            echo $insert;
//                            $result = mysqli_query($connection, $insert);
//                            if ($result) {
//                                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . $errorUpload : '';
//                                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . $errorUploadType : '';
//                                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
//                                $statusMsg = "Files are uploaded successfully." . $errorMsg;
//                            } else {
//                                $statusMsg = "Sorry, there was an error uploading your file.";
//                            }
//                        }
//                    } else {
//                        $statusMsg = 'Please select a file to upload.';
//                    }
//                    // Display status message
//                    echo $statusMsg;
//                    $message = "Products Inserted";
//                }
//            }
//        }else {
//            $message =  "Insert products failed";
//        }
    }
}

else{
    echo "Permission Denied. You need to be logged in as Admin";
}
