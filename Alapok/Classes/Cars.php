<?php

/*Access Modifier:
    public - Az egész programban tudjuk használni
    private - Adott classban érhető el
    protected Adott classban és az alosztályokban amiket létrehozunk belőle (extend-inheritance)
*/

class Cars
{
    /* A property lehet kezdetben csak létrehozva érték nélkül, vagy lehet alap értéke
     * alap jelölés: var
     */
    var $wheelCount = 4;
    public $doorCount = 4;
    private $index = 2;
    protected $window = 6;


    function carDetail(){
        return 'This car has ' . $this->wheelCount . ' wheels.';
    }

    function carCount(){
        echo $this->doorCount . '</br>';
        echo $this->index . '</br>';
        echo $this->window . '</br>';
    }
}