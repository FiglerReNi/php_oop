<?php

/*
 referencing parent class with static (öröklés static esetén)
 */

class Cars2
{
    static $wheelCount = 4;

    static function carDetail(){
        return self::$wheelCount;
    }

}