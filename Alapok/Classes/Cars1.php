<?php

/*
 * Getter, Setter
 * Constructor: automatikusan lefut, amikor példányosítunk
 * A static nem indul alaphekyzetből új pédány esetén, ha pl növeljük az értékét az minden pédánnyal nő.
 */
class Cars1
{
    private $doorCount = 32;
    static $wheelcount = 50;
    /**
     * Cars1 constructor.
     */
    public function __construct()
    {
        echo $this->doorCount++ . '<br>';
        echo self::$wheelcount++ . '<br>';
    }


    /**
     * @return int
     */
    public function getDoorCount()
    {
        return $this->doorCount;
    }

    /**
     * @param int $doorCount
     */
    public function setDoorCount($doorCount)
    {
        $this->doorCount = $doorCount;
    }


}