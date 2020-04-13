<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITEROUTE') ? null : define('SITEROUTE', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'php_oop' . DS . 'Project');

require_once("functions.php");
$database = new Database();
$session = new Session();

//az autoload miatt nem kellenek
//require_once("database.php");
//require_once ("user.php");
//require_once("session.php");



