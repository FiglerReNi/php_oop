<?php

/*inheritance: A fő osztály minden property és method elemét tudja használni
               Felül is tudjuk írni a már meglévőket*/

class Trucks extends Cars
{
    var $wheelCount = 10;

    function TruckDetail(){
        echo $this->doorCount . '</br>'; //public mindenhol
        //echo $this->index . '</br>';  // private, ezért itt nem érhető el
        echo $this->window . '</br>'; //protected class és al class-ok
    }

}