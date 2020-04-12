<?php


class comment extends dbObject
{
    protected static $dbTable = "comments"; //1. lépés hogy a create, update, delete minden táblához jó legyen
    protected static $dbTableFields = array('id', 'photo_id', 'author', 'body'); //2. lépés a tábla mezői
    public $id;
    public $photo_id;
    public $author;
    public $body;

    public static function createComment($photoId, $author = "John", $body=""){
        if(!empty($photo_id)  && !empty($body)){
            $comment = new comment();
            $comment->photo_id  = (int)$photoId;
            $comment->author    = $author;
            $comment->body      = $body;
            return $comment;
        }else{
            return false;
        }
    }
}