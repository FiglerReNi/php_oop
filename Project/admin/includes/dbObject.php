<?php
/*
 parent class esetén nem használhatjuk a self::megoldást, helyette
1. -> hagyományos methodot használunk és $this->
2. -> static::
      late static binding: https://www.php.net/manual/en/language.oop5.late-static-bindings.php
*/

class dbObject
{
    public static function findAll()
    {
//        B változat
        return static::findThisQuery("SELECT * FROM " . static::$dbTable);
//        A változat
//        global $database;
//        $result = $database->query("SELECT * FROM users");
//        return $result;
    }

    public static function findById($id)
    {
//        B változat
        $result = static::findThisQuery("SELECT * FROM " .static::$dbTable. " WHERE id =" . $id);
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
        while ($row = $resultSet->fetch_array()) {
            $theObjectArray[] = static::instantiationShort($row);
        }
        return $theObjectArray;
    }

    public static function instantiationShort($theRecord)
    {
        $callingClass = get_called_class();
        $theObject = new $callingClass;
        //ezt nem hasznlhatjuk parent classban
        //$theObject = new self;
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

    protected function properties(){
        global $database;
        $properties = array();
        foreach(static::$dbTableFields as $dbField){
            if(property_exists($this, $dbField)){
                $properties[$dbField] = $database->escapeString($this->$dbField);
            }
        }
        return $properties;
    }

    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

//B változat, úgy is meg lehet csinálni ezt, hogy minden táblához jók legyenek
    protected function create()
    {
        global $database;
        $properties = $this->properties();
        $sql = "INSERT INTO " . static::$dbTable . " (". implode(', ', array_keys($properties)).") 
                VALUES ('". implode("', '", array_values($properties))."')";
        if ($database->query($sql)) {
            $this->id = $database->theInsertId();
            return true;
        } else {
            return false;
        }
    }

    protected function update(){
        global $database;
        $properties = $this->properties();
        $propertiesPairs = array();
        foreach ($properties as $key => $value){
            $propertiesPairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$dbTable . "
                SET " . implode(", ", $propertiesPairs) . "
                WHERE id = '" . $database->escapeString($this->id) . "'";
        $database->query($sql);
        //ha a connection public a database.php-ban akkor így is lehet
        //return ($database->connection->affected_rows == 1) ? true : false;
        //ha a connection private a database.php-ban akkor kell ott egy affectedRow() method, hogy ezt el tudjuk érni
        return ($database->affectedRow() == 1) ? true : false;
    }

    protected function delete(){
        global $database;
        $sql = "DELETE FROM " . static::$dbTable . "
                WHERE id = '" . $database->escapeString($this->id) . "'
                LIMIT 1";
        $database->query($sql);
        return ($database->affectedRow() == 1) ? true : false;
    }
}