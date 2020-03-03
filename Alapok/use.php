<?php
require_once 'Classes/First.php';
require_once 'Classes/Cars.php';

$bmw = new Cars();
$mercedes = new Cars();
//method elérése
echo $mercedes->carDetail() . '</br>';
//propertie elérése
    //beépített érték
echo $bmw->wheelCount . '</br>';
    //módosíthatjuk az eredeti értéket
$bmw->wheelCount = 10;
echo $bmw->wheelCount . '</br>';
echo $mercedes->wheelCount . '</br>';

//példányosítás
$pelda1 = new First();
$pelda2 = new First();
$pelda1->greeting1();
$pelda2->greeting1();

//kilistázza egy osztály method-jait
$methods = get_class_methods('First');
foreach($methods as $method){
    echo $method . '</br>';
}

//kilistázza a php beépített osztályait + ami be van húzva az oldalra
$classes = get_declared_classes();
foreach($classes as $class){
    echo $class . '</br>';
}