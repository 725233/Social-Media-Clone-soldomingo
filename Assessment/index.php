<?php
// SESSION
session_start();

    // Includes multiple PHP
    include("classes/connect.php");
    include("classes/login.php");

    // Variable
    $email = "";
    $password = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $login = new Login();
        $result = $login->evaluate($_POST);

        if($result != "")
        {

            echo "<div style='text-align: center; font-size: 12px; color: white; background-color: grey;'>";   
            echo "<br>The following Error occurred<br><br>";
            echo $result;
            echo "</div>";
        }else
        {
            header("Location: homepage.php");
            die;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

    }
?>
<htm lang="eng">
<head>
        <title>BSU HUB</title>

        <!-- ICON -->
        <link rel="icon" type="image/x-icon" href="images/icon/ICON.png">

        <!-- Online CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">   
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

        <!-- JS -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    </head>
    <style>
    body{
        background-repeat: no-repeat;
        background-size: cover;
        background-color: #ffffff;
    }
    .maxh{
        height: 100%;
    }
    .signup{
        background-color: rgb(255, 255, 255);
        padding: 2%;
    }
    .var{
        height: 5%;
        width: 100%;
        margin-bottom: 3%;
        font-family: PT Mono;
        font-size: 14px;
    }
    .desc{
        margin-bottom: 3%;
    }
    .var_i{
        padding: 2%;
        color: #1a1a1a;
        width: 100%;
        height: 100%;
        border-radius: 0.5em;
        border: 1px solid #afafaf;
    }
    .var_text{
        font-family: PT Mono;
        font-size: 18px;
        font-weight: bold;
    }
    #login{
        padding-top: 2%;
        font-family: PT Mono;
        font-size: 14px;
    }
    #login a{
        text-decoration: none;
        color: #076eb7;
    }
    .title{
        margin-bottom: 9%;
    }
    .title h1{
        font-family: PT Mono;
        font-weight:bolder;
        font-size: 50px;
    }
    #button{
        height: 7%;
        width: 100%;
        border-radius: 0.6em;
        font-size: 14px;
        font-weight: bold;
        border: none;
        background-color: rgb(16, 16, 16);
        color: rgb(255, 255, 255);
    }
.ad{
    background-image: url("images/123.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #ffd9d9;
}
.ad h1{
    font-family: PT Mono;
    color: #ffffff;
    font-weight:bolder;
    font-size: 50px;
    margin-bottom: 300px;
}
.ad p{
    font-family: PT Mono;
    color: #ffffff;
    font-weight:lighter;
    font-size: 30px;
}
    </style>
    <body>
        <!-- Signup -->
        <header class="container-fluid text-center">
            <div class="row align-items-center maxh">
                <div class="col-7 d-flex align-items-end maxh ad">
                    <div class="col desc text-start">
                            <h1>MAKE YOUR AMBITIONS HAPPEN. MAKE IT AT BATH SPA.</h1>
                            <p>BATH SPA UNIVERSITY ACADEMIC CENTER RAK</p>
                    </div>
                </div>
                <div class="col-5 signup d-flex align-items-center maxh">
                    <div class="container">
                        <form method="POST">
                            <div class="container" style="padding-left: 20%; padding-right: 20%;">
                                <div class="col title text-center">
                                    <h1>Welcome back!</h1>
                                </div>
                                <div class="col var_text text-start">
                                    Email
                                </div>
                                <div class="col var">
                                    <input class="var_i" value="<?php echo $email ?>" name="email" type="text">
                                </div>
                                <div class="col var_text text-start">
                                    Password
                                </div>
                                <div class="col var">
                                    <input class="var_i" name="password" type="password">
                                </div>
                                <div class="col var_text">
                                    <input type="submit" id="button" value="LOGIN">
                                </div>
                                <div class="col text-start" id="login">
                                    Don't have an account?
                                    <a href="signup.php">Sign up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
    </body>
</html>