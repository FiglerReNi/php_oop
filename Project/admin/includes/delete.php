<?php

class delete extends dbObject
{
    private $id;
    private $class;
    private $path;

    public function __construct($id, $path, $class)
    {
        $this->id = $id;
        $this->class = $class;
        $this->path = $path;

        if(empty($this->id)){
            redirect("$this->path");
        }else{
            $object = $this->class::findById($this->id);
            if($object){
                $object->deletePhoto();
                redirect("$this->path");
            }else{
                redirect("$this->path");
            }
        }
    }
}

