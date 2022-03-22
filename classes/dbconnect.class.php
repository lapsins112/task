<?php
class DBConnect {
    public $connect;
    private $host = 'localhost';
    private $username = 'root2';
    private $password = 'root';
    private $database = 'settlement_data';

    public function __construct() {
        
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        
        if(!$this->connect){
            die("Neizdevās izveidot savienojumu: " . mysqli_connect_error());
        } 
        return $this;
    }
}