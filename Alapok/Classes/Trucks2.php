<?php


class Trucks2 extends Cars2
{
    static function display(){
        echo parent::carDetail() . '<br>';;
    }
}