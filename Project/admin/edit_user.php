<?php include("includes/header.php");

if (!$session->isSignedIn()) {
    redirect("login.php");
}

$message = "";
if (empty($_GET['id'])) {
    redirect('users.php');
} else {
    $user = user::findById($_GET['id']);
    $oldFile = SITEROUTE . DS . 'admin' . DS . $user->Path();
    if (isset($_POST['update'])) {
        if ($user) {
            $user->first_name = $_POST['first'];
            $user->last_name = $_POST['last'];
            $user->username = $_POST['username'];
            $user->password = $_POST['pass'];
            if (empty($_FILES['file']['name'])) {
                $user->save();
                $session->message('The user has been updated!');
              //  $message = 'The user has been updated!';
            } else {
                $user->setFiles($_FILES['file']);
                if ($user->saveFileToo()) {
                    if (!strpos($oldFile, 'http://placehold.it/100X100&text=image')) {
                        unlink($oldFile);
                    }
                    $session->message( "Photo uploaded successfully");
                //    $message = "Photo uploaded successfully";
                } else {
                    $session->message( join("<br>", $user->customErrors));
                //    $message =  join("<br>", $user->customErrors);
                }
            }
            redirect('users.php');
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
                    USERS
                    <small>Subheading</small>
                </h1>
                <div class="col-md-2">
                    <img class="img-responsive photoSize" src="<?= $user->path() ?>" alt="">
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-6">
<!--                        <h6>--><?//= $message; ?><!--</h6>-->
                        <div class="form-group">
                            <input type="file" name="file">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $user->username ?>">
                        </div>

                        <div class="form-group">
                            <label for="first">First name</label>
                            <input type="text" name="first" class="form-control" value="<?= $user->first_name ?>">
                        </div>
                        <div class="form-group">
                            <label for="last">Last name</label>
                            <input type="text" name="last" class="form-control" value="<?= $user->last_name ?>">
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" class="form-control" value="<?= $user->password ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" value="Update" class="btn btn-primary pull-right">
                        </div>
                        <div class="form-group">
                            <a href="users.php?id=<?php echo $user->id; ?>&path=users.php&class=user"
                               class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>


