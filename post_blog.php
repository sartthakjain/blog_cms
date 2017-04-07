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
    

    
 $_POST =new Post($db_handler);
if(isset($_GET['delete']))
{
$_POST->delete_post($_GET['postid']);
header("location: dashboard.php");
}

 $post_data = $_POST->get_post_details_by_postid($_GET['postid']);
}




if(!isset($_POST)||empty($_POST))
{
    
}
else{
    if(!isset($_POST['title'])||$_POST['title']=='')print_r ("title missing");
    else
     if(!isset($_POST['content'])||$_POST['content']=='')print_r ("content missing");
    else{
            $_POST = new Post($db_handler);
            $_POST->set_post_title($_POST['title']);
            $_POST->set_post_content($_POST['content']);
            $_POST->set_post_user($_SESSION['uid']);
            if(!isset($_POST['postid'])||$_POST['postid']=='')
            {
                print_r($_POST['postid']);
            $_POST->upload_post(); 
            }
            else
            {
                
                $_POST->update_post($_POST['postid']);
            }
             header("location: dashboard.php");
        }
}

?>



<html>
    <head>
  <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
            tinymce.init({    selector:'textarea',
                            plugins: 'codesample',
                            toolbar: 'codesample'});
</script>
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