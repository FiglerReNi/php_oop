<?php
require_once('includes/header.php');

if ($session->isSignedIn()) {
    redirect("index.php");
}

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $userFound = User::verifyUser($username, $password);

    if ($userFound) {
        $session->login($userFound);
        redirect("index.php");
    } else {
        $theMessage = "Your password or username are incorrect!";
    }
} else {
    $username = "";
    $password = "";
    $theMessage = "";
}

?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/top_nav.php"); ?>
    <?php include("includes/sidebar.php"); ?>
</nav>
<br>
<div class="col-md-4 col-md-offset-3">
    <h4 class="bg-danger"><?php echo $theMessage ?></h4>
    <form action="" method="post">
        <div class="form-group">
            <label class="fontColor" for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>">
        </div>
        <div class="form-group">
            <label class="fontColor" for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-success">
        </div>
    </form>
</div>
<?php include("includes/footer.php"); ?>

