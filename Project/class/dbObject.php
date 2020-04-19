<?php
/*
 parent class esetén nem használhatjuk a self::megoldást, helyette
1. -> hagyományos methodot használunk és $this->
2. -> static::
      late static binding: https://www.php.net/manual/en/language.oop5.late-static-bindings.php
*/

class dbObject
{
    private $tmpPath;
    public $customErrors = array();
    private $uploadErrors = array(
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    );
    private $imagePlaceholder = "http://placehold.it/100X100&text=image";

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
        $result = static::findThisQuery("SELECT * FROM " . static::$dbTable . " WHERE id =" . $id);
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

    protected function properties()
    {
        global $database;
        $properties = array();
        foreach (static::$dbTableFields as $dbField) {
            if (property_exists($this, $dbField)) {
                $properties[$dbField] = $database->escapeString($this->$dbField);
            }
        }
        return $properties;
    }

    public function Path()
    {
        return empty($this->filename) ? $this->imagePlaceholder : $this->uploadDirectory . DS . $this->filename;
    }

    public function deletePhoto()
    {
        if ($this->delete()) {
            $targetPath = SITEROUTE . DS . 'admin' . DS . $this->Path();
            return unlink($targetPath) ? true : false;
        } else {
            return false;
        }
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

//B változat, úgy is meg lehet csinálni ezt, hogy minden táblához jók legyenek
    protected function create()
    {
        global $database;
        $properties = $this->properties();
        $sql = "INSERT INTO " . static::$dbTable . " (" . implode(', ', array_keys($properties)) . ") 
                VALUES ('" . implode("', '", array_values($properties)) . "')";
        if ($database->query($sql)) {
            $this->id = $database->theInsertId();
            return true;
        } else {
            return false;
        }
    }

    protected function update()
    {
        global $database;
        $properties = $this->properties();
        $propertiesPairs = array();
        foreach ($properties as $key => $value) {
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

    protected function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$dbTable . "
                WHERE id = '" . $database->escapeString($this->id) . "'
                LIMIT 1";
        $database->query($sql);
        return ($database->affectedRow() == 1) ? true : false;
    }

    public function setFiles($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->customErrors[] = "There was no file upload here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->customErrors[] = $this->uploadErrors[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmpPath = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function saveFileToo()
    {
        if (!empty($this->customErrors)) {
            return false;
        }
        if (empty($this->filename) || empty($this->tmpPath)) {
            $this->customErrors[] = "The file was not available";
            return false;
        }
        $targetPath = SITEROUTE . DS . 'admin' . DS . $this->uploadDirectory . DS . $this->filename;
        if (file_exists($targetPath)) {
            $this->customErrors[] = "The file {$this->filename} already exists";
            return false;
        }
        if (move_uploaded_file($this->tmpPath, $targetPath)) {
            if ($this->id) {
                if ($this->update()) {
                    return true;
                }
            } else {
                $this->create();
                return true;
            }
            unset($this->tmpPath);
        } else {
            $this->customErrors[] = "Permission failed";
            return false;
        }
    }

    public static function countAll()
    {
        global $database;
        $sql = "SELECT COUNT(id) FROM " . static::$dbTable;
        $result = $database->query($sql);
        $row = $result->fetch_array();
        return array_shift($row);
        //return static::findThisQuery($sql);
    }

    public function ajaxSavePhoto($filename, $id){
        global $database;
        $this->filename = $database->escapeString($filename);
        $this->id = $database->escapeString($id);
        $this->save();
        return $this->Path();
    }
}