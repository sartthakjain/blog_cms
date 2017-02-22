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
    
    function __construct($host,$username,$password,$database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connection = $this->connect_database();
        
    }
        
      public function connect_database()
    {
        
        $db = mysqli_connect($this->host, $this->username, $this->password, $this->database);
                return $db;
    }
       
    }
    


  


?>
