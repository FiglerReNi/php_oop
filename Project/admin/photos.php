<?php include("includes/header.php");
if(!$session->isSignedIn()){
    redirect("login.php");
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
              <div class="col-md-12">
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th>Photo</th>
                          <th>Id</th>
                          <th>File name</th>
                          <th>Title</th>
                          <th>Size</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $photos = photo::findAll();
                      foreach($photos as $photo){
                        echo '<tr>
                             <td><img src="'.$photo->picturePath().'" alt="" width="62px" height="62px">
                             <div class="pictures-link">
                             <a href="delete_photo.php?id='.$photo->id.'">Delete</a>
                             <a href="">Edit</a>
                             <a href="">View</a>
</div>
                             
                             
                             </td>
                             <td>'.$photo->id.'</td>
                             <td>'.$photo->filename.'</td>
                             <td>'.$photo->title.'</td>
                             <td>'.$photo->size.'</td>
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
