<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('class-db_connection.php');
require_once('class-user.php');
$database = new db_connection('localhost', 'root', '', 'blog_db');




if(!$_POST)
{
    
}
else
    {
    //BASIC VALIDATIONS
    if(!isset($_POST['username'])|| $_POST['username']=='')echo "username field required";
    else
    if(!isset($_POST['password'])||$_POST['password']=='')echo "password field required";
    else
    if(!isset($_POST['email'])||$_POST['email']=='')echo "email field required";
   else{ 
    
    $user = new User;
    $user->create_user($_POST['username'],$_POST['password'],$_POST['email']);
    $user->add_user_to_db();
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
 <h1>Register</h1>
 <form action="" method="POST">
 <input type="text" placeholder="username" name="username"/>
 <br/>
 <input type="password" placeholder="password" name="password"/>
 <br/>
 <input type="text" placeholder="email" name="email"/>
 <input type="submit" value="register"/>
</form>
 <a href="login.php">LOGIN HERE</a>
 </body>
</html>
