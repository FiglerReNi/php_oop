<?php include("includes/header.php");

if(!$session->isSignedIn()){
redirect("login.php");
}

$message = "";
if(isset($_POST['submit'])){
   $photo = new Photo();
   $photo->title = $_POST['title'];
   $photo->setFiles($_FILES['fileUpload']);
   if($photo->save()){
       $message = "Photo uploaded successfully";
   } else{
       $message = join("<br>", $photo->customErrors);
   }

}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/top_nav.php"); ?>
    <?php include("includes/sidebar.php"); ?>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    UPLOAD
                    <small>Subheading</small>
                </h1>
                <div class="col-md-6">
                 <h6><?= $message; ?></h6>
                    <form action="upload.php" enctype="multipart/form-data" method="post">
<!--                    div.form-group>ul>li*5  -> tab -->
<!--                        Eredmény: -->
<!--                    <div class="form-group">-->
<!--                        <ul>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                        </ul>-->
<!--                    </div>-->
                    <div class="form-group">
                        <input type="text" name="title" class="form-control"><br>
                    </div>
                    <div class="form-group">
                        <input type="file" name="fileUpload"><br>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit"><br>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
