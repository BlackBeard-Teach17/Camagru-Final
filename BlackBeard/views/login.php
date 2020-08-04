<?php session_start();
?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Login </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|Sacramento|VT323" rel="stylesheet">
        <style>
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
    <h1>Login</h1>
</header>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="login.php" ><i class="fa fa-sign-in"></i>  Login</a>
    <a href="gallery.php"><i class="fa fa-picture-o"></i>  Gallery</a>
</div>

<form method="post" action="../functions/signin.php" style="max-width:500px;margin:auto">
<div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="Username" name="Username" required>
</div>
   
<!-- <div class="input-group">
    <label> Password </label>
    <input type="password" name="Password" placeholder="Password" required value="<?php 
        if(isset($_COOKIE['passwd'])) echo $_COOKIE['Passwd']; ?>">
</div> -->
<div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="password" required
    value="<?php if (isset($_COOKIE['passwd']))?>"
    >
</div>

<div class="input-group">
    <button  type="submit"  class="btn" name="Login"> Login</button>
</div>
    <label>
      <input type="checkbox"  name="remember" value="1"   <?php if(isset($_COOKIE['Usr'])) {echo "checked='checked'";} ?>style="margin-bottom:15px"> Remember me
    </label>
    <?php
					if(isset($_SESSION['er'])){
              echo $_SESSION['er'];
					    $_SESSION['er'] = null;
					}
      ?>
   

<p>
   Forgot Password? <a href="reset.php">Reset</a>
</p>

</form>
</div>
<div class="footer">
    <p>kmfoloe&trade;-Camagru 2018&copy;</p>
</div>
<script src="../javascript/Menu_items.js">
</script>
<hr>
</body>
</html>
