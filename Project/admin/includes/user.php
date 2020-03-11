<?php

class User
{
    public static function findAllUsers(){
        global $database;
        $result = $database->query("SELECT * FROM users");
        return $result;
    }

    public static function findUserById($id){
        global $database;
        $result = $database->query("SELECT * FROM users WHERE id =" . $id);
        $userFound = $result->fetch_array();
        return $userFound;
    }
}

