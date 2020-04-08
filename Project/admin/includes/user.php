<?php

class User extends dbObject
{
    protected static $dbTable = "users"; //1. lépés hogy a create, update, delete minden táblához jó legyen
    protected static $dbTableFields = array('username', 'password', 'first_name', 'last_name'); //2. lépés a tábla mezői
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

// e helyett a minden tálára használható instantiationShort method használható
//    public static function instantiationLong($foundUser)
//    {
//        $theObject = new self;
//        $theObject->id = $foundUser['id'];
//        $theObject->username = $foundUser['username'];
//        $theObject->password = $foundUser['password'];
//        $theObject->first_name = $foundUser['first_name'];
//        $theObject->last_name = $foundUser['last_name'];
//        return $theObject;
//    }

    public static function verifyUser($username, $password)
    {
        global $database;
        $username = $database->escapeString($username);
        $password = $database->escapeString($password);
        $sql = "SELECT * FROM users 
                WHERE username = '{$username}'
                AND password = '{$password}'
                LIMIT 1";
        $result = self::findThisQuery($sql);
        return !empty($result) ? array_shift($result) : false;
    }

//A változat, így csak egy táblára használhatóak, mert specifikus adatok vannak benne.
//    private function create()
//    {
//        global $database;
//        $sql = "INSERT INTO users
//                SET username = '" . $database->escapeString($this->username) . "',
//                password = '" . $database->escapeString($this->password) . "',
//                first_name = '" . $database->escapeString($this->first_name) . "',
//                last_name = '" . $database->escapeString($this->last_name) . "'";
//        if ($database->query($sql)) {
//            $this->id = $database->theInsertId();
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    private function update(){
//        global $database;
//        $sql = "UPDATE users
//                SET username = '" . $database->escapeString($this->username) . "',
//                password = '" . $database->escapeString($this->password) . "',
//                first_name = '" . $database->escapeString($this->first_name) . "',
//                last_name = '" . $database->escapeString($this->last_name) . "'
//                WHERE id = '" . $database->escapeString($this->id) . "'";
//        $database->query($sql);
//        //ha a connection public a database.php-ban akkor így is lehet
//        //return ($database->connection->affected_rows == 1) ? true : false;
//        //ha a connection private a database.php-ban akkor kell ott egy affectedRow() method, hogy ezt el tudjuk érni
//        return ($database->affectedRow() == 1) ? true : false;
//    }
//
//    public function delete(){
//        global $database;
//        $sql = "DELETE FROM users
//                WHERE id = '" . $database->escapeString($this->id) . "'
//                LIMIT 1";
//        $database->query($sql);
//        return ($database->affectedRow() == 1) ? true : false;
//    }
}

