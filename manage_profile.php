<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('class-db_connection.php');
include('class-user.php');
include('class-media.php');

session_start();
$user = new User($db_handler);
$user->check_loggedIn();
$user->set_user_details_to_object($_SESSION['uid']);

if(!isset($_POST))
{
    
}
else
{
            
        if(isset($_FILES['profile_pic']))
        {
            $target_dir = "uploads/";
            $target_file = $target_dir.basename($_FILES['profile_pic']['name']);
            $uploadOk = 1;
            $check = getimagesize($_FILES['profile_pic']['tmp_name']);
            if($check!=false)
            {
                echo "File is an image.";
                $uploadOk = 1;
                
            }else{
                echo "File is not an image.";
                $uploadOk = 0;
            }
            if(file_exists($target_file))
            {
                echo 'Sorry,file already exsist.';
                $uploadOk = 0;
            }
            
            if($_FILES['profile_pic']['size']>500000)
            {
                echo 'Sorry your file is too large';
                $uploadOk = 0;
            }
               if($uploadOk == 0)
                   echo 'Sorry there was a problem in uploading the image';
            else{
            if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file))
            {
                echo "the file ".basename($_FILES['profile_pic']['tmp_name'])." has been uploaded.";
                
                $media = new Media($db_handler);
                $path = $target_file;
                $name = basename($_FILES['profile_pic']['name']);
                $type = $_FILES['profile_pic']['type'];
                $uid = $user->get_user_id($_POST['username']);
                $media->create_media($path, $name, $type, $uid,'profile_pic');
                $media->add_media_to_db();
               
                
            }
            echo"working";
        }
            
        }
        
        if(isset($_POST['email']))
        {
            
        }
}
?>
<html>
    <form action="dashboard.php" method="POST" enctype="multipart/form-data">
        CHANGE PROFILE PICTURE : 
        <input type="file" name="profile_pic">
        CHANGE EMAIL
        <input type="text" name="email" placeholder="New EMAil id"/>
        <input type="submit" name="edit_profile" value="done"/>
    </form>
</html>