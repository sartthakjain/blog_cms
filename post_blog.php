<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('class-db_connection.php');
require_once('class-post.php');

session_start();
print_r($_SESSION['username']);
print_r($_SESSION['uid']);  



if(!isset($_GET['postid'])||$_GET['postid']=='')
{
    
}
else
{
    

    
 $post =new Post($db_handler);
if(isset($_GET['delete']))
{
$post->delete_post($_GET['postid']);
header("location: dashboard.php");
}

 $post_data = $post->get_post_details_by_postid($_GET['postid']);
}




if(!isset($_POST)||empty($_POST))
{
    
}
else{
    if(!isset($_POST['title'])||$_POST['title']=='')print_r ("title missing");
    else
     if(!isset($_POST['content'])||$_POST['content']=='')print_r ("content missing");
    else{
            $post = new Post($db_handler);
            $post->set_post_title($_POST['title']);
            $post->set_post_content($_POST['content']);
            $post->set_post_user($_SESSION['uid']);
            if(!isset($_POST['postid'])||$_POST['postid']=='')
            {
                print_r($_POST['postid']);
            $post->upload_post(); 
            }
            else
            {
                
                $post->update_post($_POST['postid']);
            }
             header("location: dashboard.php");
        }
}

?>



<html>
    <head>
  <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
    <body>
        <h1>AWESOME STUFF ARE WRITTEN HERE :)</h1>
        <br/>
        <br/>
        <br/>
        <form action="" method="POST">
        <input type="text" name="title" placeholder="One liner for me..."
               value="<?php if(!empty($post_data['title'])) echo $post_data['title'];?>"
               />
        <br/>
        <br/>
        <br/>
        <textarea name="content" placeholder="Lets write some awesome stuff....">
            <?php if(!empty($post_data['content'])) echo $post_data['content'];?>
        </textarea>
        <br/>
        <br/>
        <br/>
        <input type="text" name="postid" value="<?php if(!empty($_GET['postid'])) echo $_GET['postid']; ?>" hidden="true"/>
        <input type="submit" name="post" value="SHOW IT TO THE WORLD"/>
        </form>
    </body>
</html>