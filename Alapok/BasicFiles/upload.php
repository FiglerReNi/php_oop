<?php
if (isset($_POST['submit'])) {
    echo "<pre>";
    print_r($_FILES['fileUpload']);
    echo "<pre>";

    $uploadErrors = array(
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    );

    $tempName = $_FILES['fileUpload']['tmp_name'];
    $theFile = $_FILES['fileUpload']['name'];
    $directory = "uploads";

    if (move_uploaded_file($tempName, $directory . "/" . $theFile)) {
        $theMessage = "File upload successfully";
    } else {
        $theError = $_FILES['fileUpload']['error'];
        $theMessage = $uploadErrors[$theError];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Document</title>
</head>
<body>
<form action="upload.php" enctype="multipart/form-data" method="post">
    <h2>
        <?php
        if(!empty($uploadErrors)){
            echo $theMessage;
        }
        ?>
    </h2>
    <input type="file" name="fileUpload"><br>
    <input type="submit" name="submit">
</form>
</body>
</html>
