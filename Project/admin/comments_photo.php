<?php include("includes/header.php");
if (!$session->isSignedIn()) {
    redirect("login.php");
}
$photo = photo::findById($_GET['id']);
$allComments = comment::findComments($photo->id);
$user = user::findById($session->userId);

if (isset($_GET['commentId']) && isset($_GET['path']) && isset($_GET['class'])) {
    new delete($_GET['commentId'], $_GET['path'], $_GET['class']);
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
                    COMMENTS
                </h1>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Body</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($allComments as $comment) {
                            echo '<tr>
                             <td>' . $comment->id . '</td>
                             <td>' . $comment->author . '
                             <div class="actions-link">';
                            if ($user->username == $comment->author) {
                                echo '<a href="comments_photo.php?commentId=' . $comment->id . '&path=comments_photo.php?id=' . $photo->id . '&class=comment&id=' . $photo->id . '">Delete</a>';
                            }
                            echo '</div>                          
                             </td>                           
                             <td>' . $comment->body . '</td>
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
