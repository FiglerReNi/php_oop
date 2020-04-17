<?php

include("includes/header.php");
if (!$session->isSignedIn()) {
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
                        DASHBOARD
                    </h1>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="views" class="huge"><?= $session->count; ?></div>
                                            <div>New Views</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-photo fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="photos" class="huge"><?= photo::countAll()?></div>
                                            <div>Photos</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="photos.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Total Photos in Gallery</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="users" class="huge"><?= user::countAll()?></div>
                                            <div>Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Total Users</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-support fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="comments" class="huge"><?= comment::countAll()?></div>
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Total Comments</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
<!--                 Google diagrammok: https://developers.google.com/chart/interactive/docs/gallery/piechart -->
                    <div class="row">
                    <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>
                    <?php

                    //                    teszt17
                    //                      echo DS . '<br>';
                    //                      echo SITEROUTE . '<br>';
                    //                      echo INCLUDESPATH;

                    //                    teszt16
                    //                      $photos = new photo();
                    //                      $photos->title = "Me";
                    //                      $photos->filename = "me.jpg";
                    //                      $photos->save();

                    //                    teszt15
                    //                      $photos = photo::findAll();
                    //                      foreach ($photos as $photo){
                    //                          echo $photo->title . '<br>';
                    //                      }

                    //                    teszt14
                    //                      $user = new User();
                    //                      $user->username = "frenata";
                    //                      $user->password = "12345";
                    //                      $user->first_name = "Teszt";
                    //                      $user->last_name = "FReni";
                    //                      $user->save();

                    //                    teszt13
                    //                      $user = User::findById(7);
                    //                      $user->password = 222222222;
                    //                      $message = $user->save();
                    //                      var_dump($message);

                    //                    teszt12
                    //                      $user = User::findById(5);
                    //                      $message = $user->delete();
                    //                      var_dump($message);

                    //                    teszt11
                    //                      $user = User::findById(4);
                    //                      $user->last_name = "X";
                    //                      $message = $user->update();
                    //                      var_dump($message);

                    //                    teszt10
                    //                      $user = new User();
                    //                      $user->username = "teszt";
                    //                      $user->password = "12345";
                    //                      $user->first_name = "Teszt";
                    //                      $user->last_name = "FReni";
                    //                      $user->create();

                    //                    teszt9
                    //                      $pictures = new Pictures();
                    //                      $row = new Car();
                    //                      $row->run();
                    //
                    //                    teszt8
                    //                     $users = User::findAll();
                    //                      foreach($users as $user){
                    //                          echo $user->username . "</br>";
                    //                      }

                    //                    teszt7
                    //                        $user = User::findById(10);
                    //                        echo $user->first_name;

                    //                    teszt6
                    //                        $foundUser = User::findById(3);
                    //                        $user = User::instantiationShort($foundUser);
                    //                        echo $user->first_name;

                    //                    teszt5
                    //                        $foundUser = User::findById(3);
                    //                        $user = User::instantiationLong($foundUser);
                    //                        echo $user->last_name;

                    //                    teszt4
                    //                        $foundUser = User::findById(3);
                    //                    $user = new User();
                    //                    $user->id = $foundUser['id'];
                    //                    $user->username = $foundUser['username'];
                    //                    $user->password = $foundUser['password'];
                    //                    $user->first_name = $foundUser['first_name'];
                    //                    $user->last_name = $foundUser['last_name'];
                    //                    echo $user->id;

                    //                    teszt3
                    //                      $user = User::findById(3);
                    //                      echo $user['username'];

                    //                    teszt2/a public functionnal
                    //                      $user = new User();
                    //                      $result = $user->findAll();
                    //                      while($row = $result->fetch_array()){
                    //                          echo $row['username'] . '<br>';
                    //                      }

                    //                    teszt2/b static functionnal
                    //                      $result = User::findAll();
                    //                      while($row = $result->fetch_array()){
                    //                            echo $row['username'] . '<br>';
                    //                      }

                    //                    teszt1
                    //                      $sql = "SELECT * FROM users WHERE id=2";
                    //                      $result = $database->query($sql);
                    //                      $userFound = $result->fetch_array();
                    //                      echo $userFound['username'];
                    ?>

                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>