<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Reset </title>
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
    <h1>Reset Password</h1>
</header>
<div id="head">
	</div>
	div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<a href="home.php"><i class="fa fa-home"></i> Home</a>
   <a href="../functions/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
    <a href="views/gallery.php"><i class="fa fa-picture-o"></i>  Gallery</a>
</div>

<div class="reset">

	
	</div>	
	<form method="post" action="forgot.php" style="max-width:500px;margin:auto">
		<div class="Reset-Email">
	<div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="Email" name="Email" required>
    </div>
		</div>
		<div class="cd">
			<button type="submit" name="submit" class="btn">Submit</button>
		</div>
		<div class="ef">
		<span>
			<h4>
			</h4>
		</span>
		<?php
		if(isset($_SESSION['success'])){
            echo $_SESSION['success'];
			$_SESSION['success'] = null;
		}else{
			echo $_SESSION['err'];
			$_SESSION['err'] = null;
			}
		?>	
		<p>
			Not yet a member ?<a href="../index.php">Join now</a>
		</p>
	</div>
	<div class="footer">
    	<p>kmfoloe&trade;-Camagru 2018&copy;</p>
	</div>
	</form>
	<script src="../javascript/Menu_items.js">
	</script>
	</div>
</body>
</html>