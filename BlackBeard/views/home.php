<?php session_start();
if (empty($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title> Home</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|Sacramento|VT323" rel="stylesheet">
        <link rel="stylesheet" href="../styles/styles.css">
        <style>
            body {
                font-family:'Fredericka the Great', cursive;
                height: 100%;
                background-color: floralwhite;
            }

            /* Fixed sidenav, full height */
            .sidenav {
                height: 100%;
                width: 200px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                padding-top: 20px;
            }

            /* Style the sidenav links and the dropdown button */
            .sidenav a, .dropdown-btn {
                padding: 6px 8px 6px 16px;
                text-decoration: none;
                font-size: 20px;
                color: #818181;
                display: block;
                border: none;
                background: none;
                width: 100%;
                text-align: left;
                cursor: pointer;
                outline: none;
            }

            /* On mouse-over */
            .sidenav a:hover, .dropdown-btn:hover {
                color: #f1f1f1;
            }

            /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
            .dropdown-container {
                display: none;
                background-color: #262626;
                padding-left: 8px;
            }

            /* Optional: Style the caret down icon */
            .fa-caret-down {
                float: right;
                padding-right: 8px;
            }

            /* Some media queries for responsiveness */
            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
            h2
            {
                text-align: center;
            }



        </style>
</head>
<body onload="myFunction()" style="margin:0;">
<div id="main" class="main">
<div id="main"
    <header>Welcome to Camagru <?php echo '.<br>.'; $_SESSION['username'] ; ?></header>
            <div class="sidenav">
                <button class="dropdown-btn" style="font-family: 'Fredericka the Great', cursive"><i class="fa fa-user"></i> Profile
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="update_password.php"><i class="fa fa-lock"></i>Password</a>
                    <a href="editUsername.php"><i class="fa fa-user"></i>Edit Username</a>
                    <a href="editMail.php"><i class="fa fa-envelope"></i>Change Email</a>
                    <a href="mailNotif.php"><i class="fa fa-envelope-open"></i>Mail Notification</a>
                </div>
                <a href="../functions/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
            </div>

<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">
    <h1>WELCOME TO CAMAGRU</h1>
    <p>Please <b>click</b> on the button Below! To Visit Our <b>Gallery</b></p>
    <button class="button button2"><a href="gallery.php" style="text-decoration: none">Gallery</a></button>
    <p>Click on <b>Profile</b> to Update your details</p>
    <p>Or Keep viewing your pictures</p>
    <p>Click the <a href="cam.php"><i class="fa fa-camera-retro" ></a></i> Camera to Take pictures</p>

    <?php
    session_start();
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
    <?php
    if ($result)
        foreach ($result as $row) {
            ?><ul><li style="list-style-type: none;"><img id="e1" src=<?=$row['image'] ?> width="40%" height="auto">
                <button onclick="delete_img()">
                    Delete Image
                </button>
            </li></ul>

            <?php
        }
    else
        echo "failure";
    ?>
</div>
</div>
<script src="../javascript/Menu_items.js">

</script>
<script>
    function delete_img() {
        var r = confirm("Are you sure you want to delete? Click OK to delete!");
        if (r == true) {
            window.location.href = "../functions/delete_images.php?type=image&image_id=<?php echo $row['image_id'] ?>"
        } else {
            alert("Image not deleted");
        }
    }
</script>
</body>
</html>
