<?php

class database_connection{
    private $servername='localhost';
    private $pass='';
    private $username='root';
    private $dbname='chatapplication';
    public $conn;

    function connect(){
        $this->conn=mysqli_connect($this->servername,$this->username,$this->pass,$this->dbname);
        return $this->conn;
      
    }
}
?>