<?php
require_once("dbconnect.class.php");

class DBOperations {

    private $result;
    private $sql;

    public function __construct() {
        $db = new DBConnect;
        $this->connect = $db->connect;
    }

    public function getData($q){
        $this->sql = $q;
        $this->r = $this->checkData();
        return $this->r;
    }
    
    private function selectData(){
        $this->result = mysqli_query($this->connect, $this->sql);
        $this->connect->close();
        return $this->result;
    }

    private function checkData(){
        $this->result = $this->selectData();
        if ($this->result->num_rows > 0) {
            return $this->result;
        } else {
            $this->err = "0 rezūltāti";
            return $this->err;
        }
    }

    public function setUpdate($u){
        $this->sql = $u;
        $this->r = $this->updateData();
        return $this->r;
    }

    private function updateData(){
        if ($this->result = mysqli_query($this->connect, $this->sql)) {
            $this->result = true;
        } else {
            $this->result = "Diemžēl radusies kļūda: " . mysqli_error($this->connect);
        }   
        return $this->result;
    }

    public function getId(){
        $last_id = mysqli_insert_id($this->connect);
        return $last_id;
    }
}
?>