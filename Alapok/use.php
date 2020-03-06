<?php
require_once 'Classes/First.php';
require_once 'Classes/Cars.php';
require_once 'Classes/Trucks.php';
require_once 'Classes/Second.php';
require_once 'Classes/Cars1.php';
require_once 'Classes/Cars2.php';
require_once 'Classes/Trucks2.php';

$bmw = new Cars();
$mercedes = new Cars();
$truck = new Trucks();
$cars1 = new Cars1();
$cars2a = new Cars1(); //$wheelcount = 50 $doorCount = 32 - a static nem indul alaphekyzetből új pédány esetén
$cars2b = new Cars1(); //$wheelcount = 51 $doorCount = 32 - a static nem indul alaphekyzetből új pédány esetén

//static extend használat (öröklés)
Trucks2::display();

//getter, setter: a private property-t közvetlenül nem érjük el csak classon belül, a getter, setter segítségével viszont igen
echo $cars1->getDoorCount() . '</br>';
$cars1->setDoorCount(8);
echo $cars1->getDoorCount() . '</br>';

//static modifier
Second::teszt2();
echo Second::$pelda2 . '</br>';
$second1 = new Second();
$second1->teszt1();
echo $second1->pelda1 . '</br>';

//access modifier (public, private, protected)
$bmw->carCount();
$truck->TruckDetail();
echo $bmw->wheelCount. '</br>'; //csak a public típusú érhető így el
echo $truck->wheelCount. '</br>'; //csak a public típusú érhető így el

//inheritance
echo $truck->wheelCount . '</br>';
echo $truck->carDetail() . '</br>';

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