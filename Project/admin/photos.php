<?php include("includes/header.php");
if (!$session->isSignedIn()) {
    redirect("login.php");
}
if (isset($_GET['id']) && isset($_GET['path']) && isset($_GET['class'])) {
    if(!empty(comment::findComments($_GET['id']))){
        $session->message("The photo has comments, so you can't delete!");
        redirect('photos.php');
    }else{
        new delete($_GET['id'], $_GET['path'], $_GET['class']);
        $session->message("The photo has been deleted successfully!");
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
                </h1>
                <p class="bg-success"><?=  $session->message() ?></p>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Id</th>
                            <th>File name</th>
                            <th>Title</th>
                            <th>Size</th>
                            <th>Comments</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
//                      Összes kép
                        $photos = photo::findAll();
//                      Csak az adott felhasználó képei
                        $user = $_SESSION['user_id'];
//                        $photos = photo::findPhoto($user);
                        foreach ($photos as $photo) {
                            echo '<tr>
                             <td><img src="' . $photo->Path() . '" alt="" class="photoSize">
                             <div class="pictures-link">';
                             if($photo->user_id == $user){
                                 echo '<a class="deleteLink" href="photos.php?id=\' . $photo->id . \'&path=photos.php&class=photo">Delete </a>
                                        <a href="edit_photo.php?id=' . $photo->id . '">Edit </a>';
                             }
                            echo
                             '<a href="../photo.php?id=' . $photo->id . '">View</a>
                             </div>
                             </td>
                             <td>' . $photo->id . '</td>
                             <td>' . $photo->filename . '</td>
                             <td>' . $photo->title . '</td>
                             <td>' . $photo->size . '</td>';
                            $comments = comment::findComments($photo->id);
                            echo '<td><a href="comments_photo.php?id=' . $photo->id . '"> ' . count($comments) . '</a></td>
                    </tr>';
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
