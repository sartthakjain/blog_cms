<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('class-db_connection.php');
include('class-user.php');
session_start();


if(!$_POST)
{
    
}
else
    {
    //BASIC VALIDATIONS
    if(!isset($_POST['username'])|| $_POST['username']=='')echo "username field required";
    else
    if(!isset($_POST['password'])||$_POST['password']=='')echo "password field required";
    else{ 
       
    $user = new User($db_handler);
    
    if(!$user->check_user_password($_POST['username'], $_POST['password'])){
        
    }
    else{
        print_r("login successful");
        $_SESSION['loggedIn']=1;
        $_SESSION['username']=$_POST['username'];
        $_SESSION['uid'] =$user->get_user_id($_SESSION['username']);
        header("location: dashboard.php");
        
    }
    $user->reset_user_object();
    
   }
   }

?>
<html>
 <head>
 </head>
 <body>
 <h1>My BLOG</h1>
 <br/>
 <h1>LOGIN</h1>
 <form action="" method="POST">
 <input type="text" placeholder="username" name="username"/>
 <br/>
 <input type="password" placeholder="password" name="password"/>
 <br/>
 <input type="submit" value="login"/>
</form>
 <a href="index.php">Register here</a>
 </body>
</html>