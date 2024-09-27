<?php
session_start();
include('../Config/database.php');


$_SESSION['er'] = null;
$user = $_POST['Username'];
$pwd = $_POST['Password'];
$rem = $_POST['remember'];
$pass = hash("Whirlpool", $pwd);

try{
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("SELECT * FROM users WHERE Username=? AND passwd = ? AND varified = 1");
    $pdo->execute(array($user, $pass));
    $found= $pdo->rowCount();
    $row = $pdo->fetch(PDO::FETCH_ASSOC);
    
    if ($found == 1)
    {
       
        $_SESSION['username'] = $row['Username'];
        $_SESSION['mail'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        header('Location: ../views/home.php');
        exit;
    }
    else
    {
        $_SESSION['er'] = "User not found or wrong password";
       header('Location: ../views/login.php');
    exit();
    } 
}
catch (PDOEXCEPTION $e)
{
  echo $e; 
  
}

header('Location: ../views/login.php');
$conn = NULL;
?>


