<?php session_start();

include('../Config/database.php');

$logged = $_SESSION['username'];
if (isset($_POST['check'])){
    $set = $_POST['check'];
}
else{
    $set = null;
    $_SESSION['notif'] = "Nothing was selected Email notification  is enabled by default";
    header("Location: ../views/mailNotif.php");
}
if ($set == 'Yes'){
    try{
    $conn = new PDO($DB_DSN , $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("UPDATE users SET mailNotif = ? WHERE Username = ?");
    $pdo->execute(array(1, $logged));
    $_SESSION['notif'] = "Email notification enabled";
    header("Location: ../views/mailNotif.php");
    }
    catch(PDOexception $e){
        $_SESSION['notif'] = "Something went wrong with connection";
        header("Location: ../views/mailNotif.php");
    }
}
if ($set == 'No'){
    try{
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("UPDATE users SET mailNotif = ? WHERE Username = ?");
    $pdo->execute(array(0, $logged));
    $_SESSION['notif'] = "Email notification disabled";
    header("Location: ../views/mailNotif.php");
    
    }
    catch(PDOexception $e){
        $_SESSION['notif'] = "Something went wrong with the connection";
        header("Location: ../views/mailNotif.php");
    }
}