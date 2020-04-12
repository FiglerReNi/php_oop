<?php include("includes/header.php");
if(!$session->isSignedIn()){
    redirect("login.php");
}
if(isset($_GET['id']) && isset($_GET['path']) && isset($_GET['class'])){
    new delete($_GET['id'], $_GET['path'], $_GET['class']);
}
?>?>
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
                </h1>
                <a href="add_user.php" class="btn btn-primary">Add User</a>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $users = user::findAll();
                        foreach($users as $user){
                            echo '<tr>
                             <td>'.$user->id.'</td>
                             <td><img src="'.$user->Path().'" alt="" class="photoSize"></td>
                             <td>'.$user->username.'
                             <div class="actions-link">
                             <a href="users.php?id='.$user->id.'&path=users.php&class=user">Delete</a>
                             <a href="edit_user.php?id='.$user->id.'">Edit</a>
</div>                          
                             </td>                           
                             <td>'.$user->first_name.'</td>
                             <td>'.$user->last_name.'</td>
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
