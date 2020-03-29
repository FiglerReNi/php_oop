<?php
require_once('includes/init.php');

if($session->isSignedIn()){
    redirect("index.php");
}

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $userFound= User::verifyUser($username, $password);

    if($userFound){
        $session->login($userFound);
        redirect("index.php");
    }else{
        $theMessage = "Your password or username are incorrect";
    }
}else{
    $username = "";
    $password = "";
}
