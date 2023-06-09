<?php
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
error_reporting(E_ERROR | E_PARSE);
    if(isset($_SESSION['userid']))
    {
        $id = $_SESSION['userid'];
        $login = new Login();
        $login->check_login($id);

        $result = $login->check_login($id);

        if($result){
            $user = new User();
            $user_data = $user->get_data($id);

            $name = "Welcome, " . $user_data['first_name'] . " " . $user_data['last_name'];
            $what = "Logout";
        }else{
            $what = "Login";
            $name = "Welcome to HubbyHive";  
        }
    }else{
        $what = "Login";
        $name = "Welcome to HubbyHive"; 
        header("Location: login.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['App']) {
            if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
                $id = $_SESSION['userid'];
                $filename = "upload/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $filename); 
    
                if(file_exists($filename))
                {
                    $newfile = $filename;
                    $query = "UPDATE users SET profile_image = '$newfile' WHERE userid = '$id' LIMIT 1";
                    $DB = new Database();
                    $DB->save($query);
    
                    header("Location: change_profile.php");
                }
            }else{
                header("Location: change_profile.php");
            }
        }
        if($_POST['Appp']) {
            $newfirst_name = $_POST['newfirst_name'];
            $newlast_name = $_POST['newlast_name'];
            $query = "UPDATE users SET first_name = '$newfirst_name' WHERE userid = '$id' LIMIT 1";
            $query2 = "UPDATE users SET last_name = '$newlast_name' WHERE userid = '$id' LIMIT 1";
            $DB = new Database();
            $DB->save($query);
            $DB->save($query2);
        }

        if($_POST['Approve']) {
            $newpassword = $_POST['newpassword'];
            $query = "UPDATE users SET password = '$newpassword' WHERE userid = '$id' LIMIT 1";
            $DB = new Database();
            $DB->save($query);
        }
    }

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
        <!-- Navigation Bar -->
        <header class="container-fluid text-center" id="navigation">
                <div class="row align-items-center" id="NAV">
                    <div class="col-lg-6 text-start">
                        <a href="#"><img src="images/icon/ICON.png" height="40em"></a>
                    </div>
                    <div class="col-lg-6 text-end">
                        <div class="row">
                            <div class="col-4">

                            </div>
                            <div class="col-3">
                               <a href="homepage.php">Timeline</a>
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
                <div class="col-2 rightside">

                </div>
                <div class="col-8 main-body">
                    <div class="Change text-align-center">
                        <div class="row">
                            <div class="col-5">
                                <?php 
                                    $image = "";
                                    if(file_exists($user_data['profile_image']))
                                    {
                                    $image = $user_data['profile_image'];
                                    }
                                ?>
                                <img src="<?php echo $image ?>" width="300rem">
                            </div>
                            <div class="col-7 new">
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="file" name="file">
                                    <br>
                                    <input type="submit" value="Change Profile" name="App">
                                </form><br>
                                <form method="POST">
                                    <div class="col">
                                        <input name="newfirst_name" type="text" placeholder="First Name"><br>
                                        <input name="newlast_name" type="text" placeholder="Last Name"><br>
                                        <input type="submit" value="Change Username" name="Appp">
                                    </div>
                                </form><br>
                                <form method="POST">
                                    <div class="col">
                                        <input name="password" type="password" placeholder="New Password"><br>
                                        <input name="newpassword" type="password" placeholder="Retype New Password"><br>
                                        <input type="submit" value="Change Password" name="Approve">
                                    </div>
                                </form>    
                            </div>
                        </div>        
                    </div>
                </div>
                <div class="col-2 leftside">

                </div>
            </div>
        </div>

        <script>
            var loader = document.getElementById("preloader");
            window.addEventListener("load", function(){
                loader.style.display = "none";
            })
        </script>
    </body>
</html>