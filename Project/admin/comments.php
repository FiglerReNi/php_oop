<?php include("includes/header.php");

if (!$session->isSignedIn()) {
    redirect("login.php");
}

$user = user::findById($session->userId);
$comments = comment::findAll();

if (isset($_GET['id']) && isset($_GET['path']) && isset($_GET['class'])) {
    new delete($_GET['id'], $_GET['path'], $_GET['class']);
    $session->message("The comment has been deleted successfully!");
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
                <p class="bg-success"><?=  $session->message() ?></p>
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
                        <?php foreach ($comments as $comment) {
                            echo '<tr>
                             <td>' . $comment->id . '</td>
                             <td>' . $comment->author . '
                             <div class="actions-link">';
                            if ($user->username == $comment->author) {
                                echo '<a href="comments.php?id=' . $comment->id . '&path=comments.php&class=comment">Delete</a>';
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
