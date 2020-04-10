<?php require_once('includes/init.php');

if(!$session->isSignedIn()){
    redirect("login.php");
}

if(empty($_GET['id'])){
    redirect('photos.php');
}else{
    $photo = Photo::findById($_GET['id']);
    if($photo){
        $photo->deletePhoto();
        redirect("photos.php");
    }else{
        redirect('photos.php');
    }
}
?>
<?php include("includes/footer.php"); ?>
