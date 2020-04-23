<?php include("includes/header.php");

if (!$session->isSignedIn()) {
    redirect("login.php");
}

$user = new user();
$message = "";
if (isset($_POST['create'])) {
    if ($user) {
        $user->first_name = $_POST['first'];
        $user->last_name = $_POST['last'];
        $user->username = $_POST['username'];
        $user->password = $_POST['pass'];
        if (empty($_FILES['file']['name'])) {
            $user->save();
        } else {
            $user->setFiles($_FILES['file']);
            if ($user->saveFileToo()) {
                $message = "Photo uploaded successfully";
            } else {
                $message = join("<br>", $user->customErrors);
            }
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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 col-md-offset-3">
                        <h6><?= $message; ?></h6>
                        <div class="form-group">
                            <input type="file" name="file">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="first">First name</label>
                            <input type="text" name="first" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="last">Last name</label>
                            <input type="text" name="last" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="create" class="btn btn-primary pull-right">
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

