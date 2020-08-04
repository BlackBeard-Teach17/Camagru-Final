<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Config/database.php';

htmlspecialchars($_SESSION['username']);
try
{
    $Username		= $_SESSION['username'];
    $image_id 		= trim(htmlspecialchars($_POST['image_id']));
    $comment 		= htmlspecialchars($_POST['comment_txt']);
    if (!isset($Username) || empty($Username))
    {
        header("Location: ../views/gallery.php");
    }
    else if (!isset($comment) || empty($comment))
    {?>
    <script>alert("You need to write something");</script>
        <?php
    }
    else if ((isset($Username) && !empty($Username))
        && (isset($image_id) && !empty($image_id))
        && (isset($comment) && !empty($comment))) {
        $dbh = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "USE ".$DB_NAME;
        $sql = $dbh->prepare("INSERT INTO comments (Username, comment, image_id)
				VALUES (:Username, :comment, :image_id)");
        $sql->execute(array(':Username' => $Username, ':comment' => $comment, ':image_id' => $image_id));
        mailNotif($image_id, $Username);
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();
}


function mailNotif($img_id,$Username) {
    $DB_NAME = "camagru";
    $DB_DSN = "mysql:host=127.0.0.1;dbname=".$DB_NAME;
    $DB_DSN1 = "mysql:host=127.0.0.1";
    $DB_USER = "root";
    $DB_PASSWORD = "TaskForce141";
     require_once '../Config/database.php';

    try {
        $dbh = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT * FROM images WHERE image_id = ?");
        $sql->execute(array($img_id));
        $found = $sql->rowCount();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $name  = $row['user'];
        }
        if ($found == 1)
        {
            checkUser($name, $Username);
            header("Location: ../views/gallery.php");
        }
        else{
            header("Location: ../views/gallery.php");
        }
    }catch(PDOexception $e)
    {
        echo $e->getMessage();
    }
}

function checkUser($name, $Username) {
    $DB_NAME = "camagru";
    $DB_DSN = "mysql:host=127.0.0.1;dbname=".$DB_NAME;
    $DB_DSN1 = "mysql:host=127.0.0.1";
    $DB_USER = "root";
    $DB_PASSWORD = "TaksForce141";
    require_once '../Config/database.php';
    try {
        $dbh = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT email FROM users WHERE Username = :username AND mailNotif = :num");
        $sql->execute(array(':username' => $name, ':num'=> 1));
        $found = $sql->rowCount();
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $mail = $row['email'];
        if ($found == 1)
        {
            func_mail($Username,$mail);
        }
        else
        {
            header("Location: ../views/gallery.php");
        }
    } catch(PDOexception $e)
    {
        echo  $e->getMessage();
    }

}

function func_mail($username, $mail) {

    $to      = $mail; // Send email to our user
    $subject = ' Camagru Signup | Verification'; // Give the email a subject
    $message = ''.$username.' commented on your picture'; // Our message above including the link

    $headers = 'From:camagruteam@camagru.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email
    header("Location: ../views/gallery.php");
    $conn = null;
}
?>

