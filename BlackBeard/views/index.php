<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Register </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|Sacramento|VT323" rel="stylesheet">
        <link href="../functions/styles.css" rel="stylesheet">
        <style>
            /*Register Form */
            body {
                font-family: 'Fredericka the Great', cursive;
            }
            * {box-sizing: border-box;}
            p1
            {
                text-align: right;
                font-size: 200%;

            }

        </style>
</head>
<body>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
<header>
    <p1>Welcome to Camagru</p1>
</header>
<div id="main">


<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="login.php" ><i class="fa fa-sign-in"></i>  Login</a>
    <a href="gallery.php"><i class="fa fa-picture-o"></i>  Gallery</a>
</div>
<form method="POST" action="../functions/signup.php" style="max-width:500px;margin:auto">
    <h2><i class="fa fa-id-badge" aria-hidden="true"></i> Register Form</h2>
    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="Username" name="Username" required>
    </div>

    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="Email" name="Email" required>
    </div>

    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Password" name="Password" required>
    </div>
    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Confirm Password" name="cPassword" required>
    </div>

    <button type="submit" class="btn" name="Register">Register</button>
    <?php
    if(isset($_SESSION['signup_success'])){
        echo "Registration successful. Verification link sent to your email.";
        $_SESSION['signup_success'] = null;
    }else{
        echo $_SESSION['error'];
        $_SESSION['error'] = null;
    }
    ?>
</form>
</div>
<div class="footer">
    <p>kmfoloe&trade;-Camagru 2018&copy;</p>
</div>
<script src="../javascript/Menu_items">
</script>
</body>
</html>


    
         
