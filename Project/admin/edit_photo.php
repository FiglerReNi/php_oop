<?php include("includes/header.php");

if(!$session->isSignedIn()){
    redirect("login.php");
}

if(empty($_GET['id'])){
    redirect("photos.php");
}else{
    $photo = photo::findById($_GET['id']);
    if(isset($_POST['update'])){
        if($photo){
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->alternate_text = $_POST['alternateText'];
            $photo->description = $_POST['description'];
            $photo->save();
        }
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
                    PHOTOS
                    <small>Subheading</small>
                </h1>
                <form action="" method="post">
                <div class="col-md-8">
                   <div class="form-group">
                       <input type="text" name="title" class="form-control" value="<?= $photo->title; ?>" >
                   </div>
                    <div class="form-group">
                        <a class="thumbnail" href="#"><img src="<?= $photo->Path(); ?>" alt="" class="admin-photo"></a>
                    </div>
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" name="caption" class="form-control" value="<?= $photo->caption; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alternateText">Alternate Text</label>
                        <input type="text" name="alternateText" class="form-control" value="<?= $photo->alternate_text; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
<!--  Szerkeszthető textares: https://www.tiny.cloud/docs/quick-start/  -->
                        <textarea class="form-control" name="description" id="mytextarea" cols="30" rows="10"><?= $photo->description ?>
                        </textarea>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div  class="photo-info-box">
                        <div class="info-box-header">
                            <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                        </div>
                        <div class="inside">
                            <div class="box-inner">
<!--                                <p class="text">-->
<!--                                    <span class="glyphicon glyphicon-calendar"></span> Uploaded on:-->
<!--                                </p>-->
                                <p class="text ">
                                    Photo Id: <span class="data photo_id_box"><?= $photo->id ?></span>
                                </p>
                                <p class="text">
                                    Filename: <span class="data"><?= $photo->filename ?></span>
                                </p>
                                <p class="text">
                                    File Type: <span class="data"><?= $photo->type ?></span>
                                </p>
                                <p class="text">
                                    File Size: <span class="data"><?= $photo->size ?></span>
                                </p>
                            </div>
                            <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a  href="photos.php?id=<?php echo $photo->id;?>&path=photos.php&class=photo" class="btn btn-danger btn-lg ">Delete</a>
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>




















<?php include("includes/footer.php"); ?>
