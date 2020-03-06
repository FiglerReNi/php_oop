<?php

/*Static Modifier
    - property és method is lehet static
    - a hagyományos property, method a létrejött példányhoz kötődik,
    - a static property, method esetében nincs szükség példányosításra
    - használhatjuk vegyesen is egy classon belül
*/

class Second
{
    public $pelda1 = 5;
    static $pelda2 = 10;

    //mindegyik fajta property-t látja
    function teszt1(){
        echo $this->pelda1 .'<br>';
        echo $this::$pelda2  .'<br>';
    }

    //csak a static property-t látja, a Second helyett használhatunk selfet.
    static function teszt2(){
        echo Second::$pelda2  .'<br>';
        echo self::$pelda2  .'<br>';
    }
}