<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('class-db_connection.php');
include('class-user.php');
session_start();
$user = new User();
$user->check_loggedIn();


?>
<h1>DASHBOARD</h1>
<input type="submit" value="logout" onclick=""