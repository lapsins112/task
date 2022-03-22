<?php
class FileUpload{
    private $name="";
    private $directory="../upload";
    private $maxSize="3"; 
    private $error=""; 
    private $fSize="";
    private $fName="";
    private $tmpName="";

    
    public function __construct(int $fs, string $fn, string $tmn) {
        $this->fSize = $fs;
        $this->fName = $fn;
        $this->tmpName = $tmn;
    }
    
    public function name($n) {
        $this->name = $n;
        return $this;
    }

    public function maxSize($s){
        if(is_int($s) and $s > 0) {
            $this->maxSize = $s * 1024 * 1024;
        } else {
            $this->error = "Maksimālajama attēla izmērma jābūt lielākam par 0";
        }

        return $this;
    }

    public function directory($d) {
        $this->directory = $d;
        return $this;
    }


    public function getExtension() {
        $this->fn = explode(".", $this->fName);
        $this->ext = end($this->fn);

        return $this->ext;
    }

    public function getSize() {
        $this->s = $this->fSize / 1024 / 1024;
        return $this->s;
    }

    public function getDir() {
        return $this->directory;
    }

    public function getName() {
        if(empty($this->name)){
            $this->name = date("Ymd") . uniqid();
        }
        return $this->name;
    }

    private function destination( ) {
        $this->d = "";
        $this->d .= $this->getDir() . "/";
        $this->d .= $this->getName() . ".";
        $this->d .= $this->getExtension();

        return $this->d;
    }

    public function getDest() {
        return $this->destination();
    }

    public function upload() {

        if($this->maxSize < $this->getSize()) {
            $this->error = "Attēla izmērs ir "
                . round($this->getSize(), 2)
                . "mb, maksimālais attēla izmērs, ko var pievienot ir: "
                . round($this->maxSize, 2)
                . "mb";
        }

        if(empty($this->error)) {
            return move_uploaded_file($this->tmpName, $this->destination());
        } else {
            return FALSE;
        }
    }

    public function report(){
        return $this->error;
    }

}