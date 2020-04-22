<?php


class photo extends dbObject
{
    protected static $dbTable = "photos"; //1. lépés hogy a create, update, delete minden táblához jó legyen
    protected static $dbTableFields = array('id', 'title', 'caption', 'description', 'alternate_text', 'filename', 'type', 'size'); //2. lépés a tábla mezői
    public $id;
    public $title;
    public $caption;
    public $description;
    public $alternate_text;
    public $filename;
    public $type;
    public $size;
    public $uploadDirectory = "images";

    public static function displaySidebarData($id){
        $photo = photo::findById($id);

        $output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->Path()}'></a>
                    <p>{$photo->filename}</p>
                    <p>{$photo->type}</p>
                    <p>{$photo->size}</p>";

        echo $output;
    }
}