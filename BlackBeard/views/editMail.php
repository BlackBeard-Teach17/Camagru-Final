<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> UpdateMail </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|VT323" rel="stylesheet">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>
<body>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="home.php"><i class="fa fa-home"></i> Home</a>
    <a href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a>
    <a href="../functions/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
</div>
<form method="POST" action="../functions/updateMail.php" style="max-width:500px;margin:auto">
    <h2 style="text-align: center"><i class="fa fa-envelope-open" aria-hidden="true"></i> Update Email</h2>
    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="Old Email" name="oldMail" required>
    </div>
    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="New Email" name="newMail" required>
    </div>
    <button type="submit" class="btn" name="UpdateMail">Update</button>
    <?php
    if(isset($_SESSION['y'])){
        echo $_SESSION['y'];
        $_SESSION['y'] = null;
    }
    ?>
</form>
<div class="footer">
    <p>kmfoloe&trade;-Camagru 2018&copy;</p>
</div>
<script src="../javascript/Menu_items.js">
</script>
</body>
</html>



