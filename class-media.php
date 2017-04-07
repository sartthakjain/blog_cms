<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Media{
    private $name;
    private $type;
    private $path;
    private $uid;
    private $used_as;
    public $connection;
    
    function __construct($db_handler) {
       $this->connection = $db_handler->connection;
    }

    
    public function create_media($path,$name,$type,$uid,$used_as)
    {
        $this->path = $path;
        $this->name = $name;
        $this->type = $type;
        $this->uid = $uid;
        $this->used_as = $used_as;
    }
    
    public function add_media_to_db()
    {
        $isconnected = $this->connection;
        if(!$isconnected)
        {
            echo 'error in db connection';
        }
        else
        {
             $sql = "insert into media(uid,name,type,path,used_as)"
                . "values(?,?,?,?,?)";

        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "issss", $this->uid, $this->name, $this->type,$this->path, $this->used_as);
        mysqli_stmt_execute($stmt);
        print_r("uploaded successfully");
            
            
        }
    }
    
   
}