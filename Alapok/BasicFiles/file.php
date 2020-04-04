<?php
//visszaadja a file útvonalát, amiben vagyunk
echo __FILE__; //C:\xampp\htdocs\php_oop\Alapok\BasicFiles\file.php
echo "<br>";
//visszadaja hányadik sorban vagyunk
echo __LINE__; //6
echo "<br>";
//visszaadja a file útvnalát, a file nélkül
echo __DIR__; //C:\xampp\htdocs\php_oop\Alapok\BasicFiles
echo "<br>";
//létezik-e az útvonal
if(file_exists(__DIR__)){
    echo "yes"; //yes
}
echo "<br>";
if(file_exists(__FILE__)){
    echo "yes"; //yes
}
echo "<br>";
//file-e
if(is_file(__DIR__)){
    echo "yes";
}else{
    echo "no"; //no
}
echo "<br>";
if(is_file(__FILE__)){
    echo "yes"; //yes
}else{
    echo "no";
}
echo "<br>";
//útvonal-e
if(is_dir(__DIR__)){
    echo "yes"; //yes
}else{
    echo "no";
}
echo "<br>";
if(is_dir(__FILE__)){
    echo "yes";
}else{
    echo "no"; //no
}
echo "<br>";
phpinfo();
