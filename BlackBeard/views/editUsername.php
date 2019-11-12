<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> UpdateUser </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|VT323" rel="stylesheet">
        <style>
            /*SIDE NAV BAR *******************************************************************/
            .sidenav {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            #main {
                transition: margin-left .5s;
                padding: 16px;
            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
            /**********************FORM*****************************/
            body {
                font-family: 'Fredericka the Great', cursive;
            }
            * {box-sizing: border-box;}

            .input-container {
                display: -ms-flexbox; /* IE10 */
                display: flex;
                width: 100%;
                margin-bottom: 15px;
            }

            .icon {
                padding: 10px;
                background: dodgerblue;
                color: white;
                min-width: 50px;
                text-align: center;
            }

            .input-field {
                width: 100%;
                padding: 10px;
                outline: none;
            }

            .input-field:focus {
                border: 5px solid dodgerblue;
            }

            /* Set a style for the submit button */
            .btn {
                background-color: dodgerblue;
                color: white;
                padding: 15px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
                opacity: 0.9;
            }

            .btn:hover {
                opacity: 10;
                background: #4CAF50;
            }
            @media screen and (max-width: 300px) {
                span.psw {
                    display: block;
                    float: none;
                }
                .cancelbtn {
                    width: 100%;
                }
            }
            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color:black;
                color: powderblue;
                text-align: center;
            }
        </style>
    </head>
<body>
<div id="main" class="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="cam.php"><i class="fa fa-camera-retro"></i>Camera</a>
    <a href="../functions/logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
</div>
<form method="POST" action="../functions/usernames.php" style="max-width:500px;margin:auto">
    <h2 style="text-align: center"><i class="fa fa-user" aria-hidden="true"></i> Update Username</h2>
    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="Old Username" name="oldUsername" required>
    </div>
    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="New Username" name="newUsername" required>
    </div>
    <button type="submit" class="btn" name="UpdateUser">Update</button>
    <?php
    if(isset($_SESSION['t'])){
        echo $_SESSION['t'];
        $_SESSION['t'] = null;
    }
    ?>
</form>
<div class="footer">
    <p>kmfoloe&trade;-Camagru 2018&copy;</p>
</div>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    }
</script>
</div>
</body>
</html>
