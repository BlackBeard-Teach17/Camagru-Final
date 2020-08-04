<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
   
        <title>Reset Password</title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|Sacramento|VT323" rel="stylesheet">
        <link href="../styles/styles.css" rel="stylesheet">
        <style>
            /*Register Form */
            body {
                font-family: 'Fredericka the Great', cursive;
            }
            * {box-sizing: border-box;}
            p1
            {
                text-align: center;
                font-size: 200%;
            }
            h1
            {
                text-align: center;
            }

        </style>
</head>
<body>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
<header>
    <h1>Update Password</h1>
</header>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="home.php"><i class="fa fa-home"></i> Home</a>
    <a href="login.php" ><i class="fa fa-sign-in"></i>  Login</a>
    <a href="gallery.php"><i class="fa fa-picture-o"></i>  Gallery</a>
    </div>
</div>

<form method="post" action="../functions/change_pass.php?" style="max-width:500px;margin:auto">
    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Old Password" name="oPassword" required>
    </div>
        <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="New Password" name="Password" required>
    </div>
        <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Confirm Password" name="cPassword" required>
    </div> 
<div class="input-group">
    <button  type="submit"  class="btn" name="Update" >Update</button>
</div>
    
    <?php
	    if(isset($_SESSION['f'])){
            echo $_SESSION['f'];
			$_SESSION['f'] = null;
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