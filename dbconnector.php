<?php
define('servername','localhost');
define('username','root');
define('password','');
define('db','lab1');

class dbconnector
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli(servername, username, password);

        if ($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }

        mysqli_select_db($this->conn,db);
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}