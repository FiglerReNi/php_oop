<?php

class User
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function findAllUsers()
    {
//        B változat
        return self::findThisQuery("SELECT * FROM users");
//        A változat
//        global $database;
//        $result = $database->query("SELECT * FROM users");
//        return $result;
    }

    public static function findUserById($id)
    {
//        B változat
        $result = self::findThisQuery("SELECT * FROM users WHERE id =" . $id);
//      Short:
        return !empty($result) ? array_shift($result) : false;
//      Long:
//        if(!empty($result)){
//           return array_shift($result);
//        }else{
//            return false;
//        }
//        A változat
//        global $database;
//        $result = $database->query("SELECT * FROM users WHERE id =" . $id);
//        $userFound = $result->fetch_array();
//        return $userFound;
    }

    public static function findThisQuery($sql)
    {
        global $database;
        $resultSet = $database->query($sql);
        $theObjectArray = [];
        while($row = $resultSet->fetch_array()){
            $theObjectArray[] = self::instantiationShort($row);
        }
        return $theObjectArray;
    }

    public static function instantiationLong($foundUser)
    {
        $theObject = new self;
        $theObject->id = $foundUser['id'];
        $theObject->username = $foundUser['username'];
        $theObject->password = $foundUser['password'];
        $theObject->first_name = $foundUser['first_name'];
        $theObject->last_name = $foundUser['last_name'];
        return $theObject;
    }

    public static function instantiationShort($theRecord)
    {
        $theObject = new self;
        foreach ($theRecord as $attribute => $value) {
            if ($theObject->has_the_attribute($attribute)) {
                $theObject->$attribute = $value;
            };
        }
        return $theObject;
    }

    private function has_the_attribute($attribute)
    {
        //beteszi egy tömbbe a nem static property neveket
        $objectProperties = get_object_vars($this);
        return array_key_exists($attribute, $objectProperties);
    }

    public static function verifyUser($username, $password){
        global $database;
        $username = $database->escapeString();
        $password = $database->escapeString();
        $sql = "SELECT * FROM users 
                WHERE username = '{$username}'
                AND password = '{$password}'
                LIMIT 1";
        $result = self::findThisQuery($sql);
        return !empty($result) ? true : false;
    }
}

