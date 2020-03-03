<?php


class Cars
{
    /* A property lehet ezdetben csak létrehozva érték nélkül, vagy lehet alap értéke
     * alap jelölés: var
     */
    var $wheelCount = 4;
    var $doorCount;

    function carDetail(){
        return 'This car has ' . $this->wheelCount . ' wheels.';
    }
}