<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('class-db_connection.php');
require_once('class-user.php');
require_once('class-media.php');

     print_r($_FILES);


if (!$_POST) {
    
} else {
    //BASIC VALIDATIONS
    if (!isset($_POST['username']) || $_POST['username'] == '')
        echo "username field required";
    else
    if (!preg_match("/^[a-zA-Z ]*$/", $_POST['username']))
        echo "not a valid username";
    else
    if (!isset($_POST['password']) || $_POST['password'] == '')
        echo "password field required";
    else
    if (!isset($_POST['email']) || $_POST['email'] == '')
        echo "email field required";
    else
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
        echo "not a valid email";
    else {
   
        $user = new User($db_handler);
        $user->create_user($_POST['username'], $_POST['password'], $_POST['email']);
        $user->add_user_to_db();
       
      
        
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
                 $user->reset_user_object();
                
            }
            echo"working";
        }
            
        }
        
    }
}
?>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Clean Blog</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="css/clean-blog.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.html">Start Bootstrap</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a href="about.html">About</a>
                        </li>
                        <li>
                            <a href="post.html">Sample Post</a>
                        </li>
                        <li>
                            <a href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Header -->
        <!-- Set your background image for this header on the line below. -->
        <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <div class="site-heading">
                            <h1>Hi. You look new.</h1>
                            <hr class="small">
                            <span class="subheading">Welcome to the club.Just tell me your details.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div>
            <br/>
            <h1>Register</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="username" name="username"/>
                <br/>
                <input type="password" placeholder="password" name="password"/>
                <br/>
                <input type="text" placeholder="email" name="email"/>
                 <br/>
                <input type="file" name="profile_pic">
                <br/>
                <input type="submit" value="register"/>
            </form>
            <a href="index.php">LOGIN HERE</a>
            <hr>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Contact Form JavaScript -->
        <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/contact_me.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/clean-blog.min.js"></script>

    </body>

</html>

