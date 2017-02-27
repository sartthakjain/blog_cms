<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class db_connection
{
    private $host;
    private $username;
    private $password;
    private $database;
    public $connection;
    
    function __construct() {
        $database = include('config.php');
        $this->host = $database['host'];
        $this->username = $database['username'];
        $this->password = $database['password'];
        $this->database = $database['db_name'];
       
        
    }
        
      public function connect_database()
    {
        
        $db = mysqli_connect($this->host, $this->username, $this->password, $this->database);
                $this->connection=$db;
    }
       
    }
    


$db_handler = new db_connection();
$db_handler->connect_database();


?>
