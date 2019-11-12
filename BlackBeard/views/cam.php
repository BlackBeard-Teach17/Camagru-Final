<?php
session_start();
if (empty($_SESSION['id'])) {
    header("Location: login.php");
}
require_once('../config/database.php');

$name =$_SESSION['username'];
$result;


try{
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $conn->query("SELECT * FROM `images` WHERE user = '". $name ."' ORDER BY date_added DESC LIMIT 6 ", PDO::FETCH_ASSOC);
} catch(PDOException $e){
    echo "ERROR EXECUTING: \n".$e->getMessage();
}
?>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Camera/Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|Sacramento|VT323" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cam.css">
    <style>
        body
        {
            background-color: #3498db;
            font-family: 'Fredericka the Great', cursive;
        }

        .topnav {
            overflow: hidden;
            background-color: silver;
        }

        .topnav a {
            float: left;
            display: block;
            color: black;
            text-align: right;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }


        .topnav .icon {
            display: none;
        }

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {position: relative;}
            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }
            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color:black ;
            color: powderblue;
            text-align: center;
        }
    </style>

</head>
<body>
<div id="myTopnav" class="topnav">
    <a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
    <a href="login.php"><i class="fa fa-sign-out"></i> Log Out</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>
<div class="c_camera">
    <div class="camField">
        <video id="video" width="400" height="300"></video>
    </div>
    <div class="picField">
        <canvas id="canvas" width="400" height="300"></canvas>
    </div>
    <div id="pose">
        <img id="e1" src="../emojis/watersplash.png" width="45%" height="45%">
        <img id="e2" src="../emojis/claw.png" width="45%" height="45%">
        <img id="e3" src="../emojis/Dark-Angel-PNG-Pic.png" width="45%" height="45%">
        <img id="e4" src="../emojis/spotlight.png" width="45%" height="45%">
    </div>
</div>
<div class="buts">
    <button id="clear" class="clrBtn">Clear</button>
    <button id="capture" class="capBtn">Capture</button>
    <button id="capture1" class="emoBtn">Emoji</button>
    <select id="emos" class="emoSelect">
        <option value="e1">Water</option>
        <option value="e2">Scar</option>
        <option value="e3">Angel</option>
        <option value="e4">Spotlight</option>
    </select>
    <form action="../functions/upload.php" method="POST">
        <input type="hidden" id="photo" name="image_data">
        <input name="call cam" type="submit" value=" Save pic " id="save" class="camBtn">
    </form>
    <div class="c_upload">
        <input type="file" name="file" id="file">
    </div>
</div>
<div id="gallery">
    <?php
    if ($result)
        foreach ($result as $row) {
            ?><img id="e1" src=<?= $row['image']; ?> width="29%" height="auto"><?php
        }
    else
        echo "failure";
    ?>
</div>
<script src="../javascript/cam.js"></script>
<script>function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
<div class="footer">
    <p>kmfoloe&trade;-Camagru 2018&copy;</p>
</div>
</body>
</HTML>
