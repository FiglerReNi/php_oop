<?php
require_once ("../init/init.php");
if(isset($_POST['filename']) || isset($_POST['id'])){
    $photo = photo::findById($_POST['id']);
    $return = $photo->ajaxSavePhoto($_POST['filename'], $_POST['id']);
    echo $return;
}
if(isset($_POST['newId'])){
    $photo = photo::findById($_POST['newId']);
    echo 'teszt';
}