<?php include("includes/header.php"); ?>
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
                        <small>Subheading</small>
                    </h1>

                    <?php
//                    teszt9
//                      $pictures = new Pictures();
//                      $row = new Car();
//                      $row->run();
//                    teszt8
//                      $users = User::findAllUsers();
//                      foreach($users as $user){
//                          echo $user->username . "</br>";
//                      }

//                    teszt7
//                        $user = User::findUserById(3);
//                        echo $user->first_name;

//                    teszt6
//                        $foundUser = User::findUserById(3);
//                        $user = User::instantiationShort($foundUser);
//                        echo $user->first_name;

//                    teszt5
//                        $foundUser = User::findUserById(3);
//                        $user = User::instantiationLong($foundUser);
//                        echo $user->last_name;

//                    teszt4
//                        $foundUser = User::findUserById(3);
//                    $user = new User();
//                    $user->id = $foundUser['id'];
//                    $user->username = $foundUser['username'];
//                    $user->password = $foundUser['password'];
//                    $user->first_name = $foundUser['first_name'];
//                    $user->last_name = $foundUser['last_name'];
//                    echo $user->id;

//                    teszt3
//                      $user = User::findUserById(3);
//                      echo $user['username'];

//                    teszt2/a public functionnal
//                      $user = new User();
//                      $result = $user->findAllUsers();
//                      while($row = $result->fetch_array()){
//                          echo $row['username'] . '<br>';
//                      }

//                    teszt2/b static functionnal
//                      $result = User::findAllUsers();
//                      while($row = $result->fetch_array()){
//                            echo $row['username'] . '<br>';
//                      }

//                    teszt1
//                      $sql = "SELECT * FROM users WHERE id=2";
//                      $result = $database->query($sql);
//                      $userFound = $result->fetch_array();
//                      echo $userFound['username'];
                    ?>

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>