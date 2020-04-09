<?php


class photo extends dbObject
{
    protected static $dbTable = "photos"; //1. lépés hogy a create, update, delete minden táblához jó legyen
    protected static $dbTableFields = array('title', 'description', 'filename', 'type', 'size'); //2. lépés a tábla mezői
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $tmpPath;
    public $uploadDirectory = "images";
    public $customErrors = array();
    public $uploadErrors = array(
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    );

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

    public function picturePath(){
        return $this->uploadDirectory . DS . $this->filename;
    }


    public function save(){
        if($this->id){
            $this->update();
        }
        else{
            if(!empty($this->customErrors)){
                return false;
            }
            if(empty($this->filename) || empty($this->tmpPath)){
                $this->customErrors[] = "The file was not available";
                return false;
            }
            $targetPath = SITEROUTE . DS . 'admin' . DS . $this->uploadDirectory . DS . $this->filename;
            if(file_exists($targetPath)){
                $this->customErrors[] = "The file {$this->filename} already exists";
                return false;
            }
            if(move_uploaded_file($this->tmpPath, $targetPath)){
                if($this->create()){
                    unset($this->tmpPath);
                    return true;
                }
            }else{
                $this->customErrors[] = "Permission failed";
                return false;
            }
        }
    }

    public function deletePhoto(){
        if($this->delete()){
            $targetPath = SITEROUTE . DS . 'admin' .DS . $this->picturePath();
            return unlink($targetPath) ? true : false;
        }else{
            return false;
        }
    }

}