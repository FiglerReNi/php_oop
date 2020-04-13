<?php

//összegyűjti a Classokat és automatikusan includolja
function myAutoloader($class)
{
    $check = strtolower($class);
    $path = "class/{$check}.php";
    $pathAdmin = "../class/{$check}.php";
    if (file_exists($path)) {
        require_once("$path");
    } elseif (file_exists($pathAdmin)) {
        require_once("$pathAdmin");
    } else {
        die("This file name {$class}.php was not found!");
    }
}

spl_autoload_register('myAutoloader');

function redirect($location)
{
    header("Location: {$location}");
}
