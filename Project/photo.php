<?php

include("includes/header.php");

if (empty($_GET['id'])) {
    redirect("index.php");
}

$message = "";
$photo = photo::findById($_GET['id']);
$allComments = comment::findComments($photo->id);

if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    $newComment = comment::createComment($photo->id, $author, $body);
    if ($newComment && $newComment->save()) {
        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "There was some problems saving";
    }
} else {
    $author = "";
    $body = "";
}

?>
    <div class="row">
    <div class="col-md-8">
        <div class="row">
            <h1>Blog Post Title</h1>
            <p class="lead">
                by <a href="#">Start Bootstrap</a>
            </p>
            <hr>
            <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
            <hr>
            <img class="img-responsive" src="<?= $photo->path() ?>" alt="">
            <hr>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut,
                error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae
                laborum minus inventore?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste
                ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus,
                voluptatibus.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde
                eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis.
                Enim, iure!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat
                totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam
                tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae?
                Qui, necessitatibus, est!</p>
            <hr>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="body" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <hr>
            <?php
            foreach ($allComments as $comment) {
                echo '<div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">' . $comment->author . ' </h4>' . $comment->body . ' </div>
                </div>';
            }

            ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php include("includes/sidebar.php"); ?>
    </div>
<?php include("includes/footer.php"); ?>