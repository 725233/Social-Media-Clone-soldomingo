<?php
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");


    if(isset($_SESSION['userid']))
    {
        $id = $_SESSION['userid'];
        $login = new Login();
        $login->check_login($id);

        $result = $login->check_login($id);

        if($result){
            $user = new User();
            $user_data = $user->get_data($id);

            $name = $user_data['first_name'] . " " . $user_data['last_name'];
            $what = "Logout";
        }else{
            $what = "Login";
        }
    }else{
        $what = "Login";
    }

    //For Posting
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['publish']) {
            $post = new Post();
            $id = $_SESSION['userid'];
            $data = $_POST;

            $result = $post->create_post($id, $data);

            if($result ==""){
                header("Location: homepage.php");
                die;
            }else{
                header("Location: homepage.php");
                die;
            }
        }
    }
    if(isset($_POST['post'])){
        unset($_POST['post']);
    }

    $post = new Post();
    $id = $_SESSION['userid'];
    $posts = $post->get_posts($id);

    $user = new User();
    $id = $_SESSION['userid'];
    $friends = $user->get_friends($id);

?>
<html>
    <head>
        <title>BSU HUB</title>

        <!-- ICON -->
        <link rel="icon" type="image/x-icon" href="images/icon/ICON.png">

        <!-- Online CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

        <!-- CSS -->
        <link rel="stylesheet" href="layout.css">

        <!-- JS -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    </head>
    <body>  
        <!-- navigation Bar -->
        <header class="container-fluid text-center" id="navigation">
                <div class="row align-items-center" id="nav">
                    <div class="col-lg-6 text-start">
                        <div class="row align-items-center">
                        <div class="col-1"> <a href="#"><img src="images/icon/ICON.png" height="40em"></a>
                    </div>
                    <div class="col" style= "color:white; font-size:30px;"> BSU HUB</div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-end">
                        <div class="row">
                            <div class="col-4">

                            </div>
                            <div class="col-3">
                                <a href="homepage.php">Feed</a>
                            </div>
                            <div class="col-3">
                                <a href="change_profile.php">Settings</a>
                            </div>
                            <div class="col-2">
                                <a href="index.php"><?php echo $what ?></a>
                            </div>
                        </div>
                    </div>
                </div>
        </header>

        <!-- Main -->
        <div class="container-fluid">
            <div class="row">
            <div class="col-2 leftside">
                <br><br>
                    <div class="col">
                        <h1 style="border:solid; border-radius: 40px; text-align:center;">PROFILE</h1>
                        
                    </div>
                    <div class="col text-center profile-pic">
                    <?php 
                        $image = "";
                        if(file_exists($user_data['profile_image']))
                        {
                            $image = $user_data['profile_image'];
                        }
                        ?>
                        <img src="<?php echo $image ?>" width="100rem" height="100rem">
                    </div>
                    <div class="col text-center profile-pic">
                        <h2><?php echo $name ?></h2>
                        <a href="change_profile.php?change=profile">Change Profile</a>
                    </div>
                    </div>
                <div class="col-8 main-body">
                    <Courses class="container-fluid con-carousel">
                        <div class="carousel" data-flickity='{ "autoplay": true, "wrapAround": true, "autoPlay": 3000, "pauseAutoPlayOnHover": true}'>
                        <div class="carousel-cell">
                                <a href="#">
                                    <img src="images/courses/1.png" width="500px" height="300px">
                                </a>
                            </div>
                            <div class="carousel-cell">
                                <a href="#">
                                    <img src="images/courses/2.png" width="500px" height="300px">
                                </a>
                            </div>
                            <div class="carousel-cell">
                                <a href="#">
                                    <img src="images/courses/3.png" width="500px" height="300px">
                                </a>
                            </div>
                            <div class="carousel-cell">
                                <a href="#">
                                    <img src="images/courses/4.png" width="500px" height="300px">
                                </a>
                            </div>
                            <div class="carousel-cell">
                                <a href="#">
                                    <img src="images/courses/5.png" width="500px" height="300px">
                                </a>
                            </div>
                        </div>
                    </Courses>
                    <newpost class="container text-center post">
                        <form method="POST">
                            <div class="col">
                            <textarea placeholder="Whats on your mind?" name="post" type="text" cols="80" rows="5" maxlength="230"></textarea>
                            </div>
                            <div class="col text-end publish">
                                <div class="row">
                                    <div class="col" style="text-align:center;">
                                    <input id="post_button" type="submit" name="publish" value="Post">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </newpost>
                    <?php
                        if($posts){
                            
                            foreach ($posts as $ROW){
                                $user = new User();
                                $ROW_USER = $user->get_user($ROW['userid']);

                                include("post.php");
                                
                                if($_SERVER['REQUEST_METHOD'] == "POST")
                                {
                                    $id = $ROW['postid'];
                                    $query = "UPDATE posts SET likes = 1 WHERE postid = '$id' LIMIT 1";
                                    $DB = new Database();
                                    $DB->save($query);
                                }
                            }
                        }
                    ?>
                </div>
                <div class="col-2 rightside">
                    <br><br>
                    <h1 style="border:solid;border-radius: 40px; ">USERS</h1>
                    <?php 
                    if($friends){

                        foreach ($friends as $FRIEND_ROW){
                         include("user.php");
                        }

                     }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>