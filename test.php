<?php
//require_once 'header.php';
require_once 'credentials.php';

echo <<<_END
<form action="" method="post" enctype="multipart/form-data">
    Select Image Files to Upload:
    <input type="number" name="prod_id">
    Choose files
    <input type="file" name="files[]" multiple >
    <input type="submit" name="submit" value="UPLOAD">
</form>

_END;

if(isset($_POST['submit'])){

    // File upload configuration
    $targetDir = "images/";
    $allowTypes = array('jpg','png','jpeg','gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $prod_id = $_POST['prod_id'];
                    $insertValuesSQL .= "('".$fileName."','".$prod_id."'),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        }

        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');
            // Insert image file name into database
//            $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");

            $insert = "INSERT INTO images (file_name, prod_id) VALUES $insertValuesSQL";
            echo $insert;
            $result = mysqli_query($connection, $insert);
            if($result){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
    // Display status message
    echo $statusMsg;
?>
// Get images from the database
<?php
$query = "SELECT * FROM images WHERE prod_id = '$prod_id'";
echo $query;
$result = mysqli_query($connection, $query);
if($result->num_rows > 0){
    while($row = mysqli_fetch_assoc($result)){
        $imageURL = 'images/'.$row["file_name"];
        ?>
        <img src="<?php echo $imageURL; ?>" alt="" />
    <?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php }} ?>
