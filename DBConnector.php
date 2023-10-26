<?php
   
   class DBConnector{
    protected $db;

    function __construct() {
        $this->db = $this->connectDB();
    }

    function __destruct() {
        mysqli_close($this->connectDB());
    }

    private function connectDB() {        
        $conn = new mysqli(_Host_, _User_, _Pwd_, _Db_, _Port_);
        return $conn;
    }
   }

?>