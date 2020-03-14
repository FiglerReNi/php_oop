<?php

//összegyűjti a Classokat és automatikusan includolja
function myAutoloader($class){
    $check = strtolower($class);
    $path = "includes/{$check}.php";
    if(file_exists($path)){
       require_once($path);
    }else{
        die("This file name {$class}.php was not found!");
    }
}

spl_autoload_register('myAutoloader');
