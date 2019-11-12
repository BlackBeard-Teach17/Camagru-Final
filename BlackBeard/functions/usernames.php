<?php session_start();

include('../Config/database.php');

$_SESSION['t'] = null;
$newUser = $_POST['newUsername'];
$name = $_POST['oldUsername'];

if (isset($_POST['UpdateUser']))
{
 $oldUser = $_SESSION['username'];

 try{
     $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = $dbh->prepare("SELECT * FROM users WHERE Username = ?");

     $sql->execute(array($oldUser));
 

 }catch(PDOException $e){
    $_SESSION['t'] = "Connection Error";
    header("Location: ../views/changUsername.php");
    exit();
}

 $row = $sql->fetch(PDO::FETCH_ASSOC);
 $user = $row['Username'];

 if ($name == $oldUser)
 {
     try{
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT Username FROM users WHERE Username = ?");
        $sql->execute(array($newUser));
        $found = $sql->rowCount();
        
        
        if ($found == 0)
        {
            $sql = $dbh->prepare("UPDATE comments SET Username = ? WHERE Username = ?");
            $sql->execute(array($newUser, $oldUser));
            $sql = $dbh->prepare("UPDATE images SET user =? WHERE user = ?");
            $sql->execute(array($newUser, $oldUser));
            $sql = $dbh->prepare("UPDATE likes SET user = ? WHERE user = ?");
            $sql->execute(array($newUser, $oldUser));
            $sql = $dbh->prepare("UPDATE users SET Username = ? WHERE Username = ?");
            $sql->execute(array($newUser, $oldUser));
        $_SESSION['t'] = "Username successfully changed " ;
        header("Location: ../views/editUsername.php");
        exit();
     } else {
        $_SESSION['t'] = "Username Already taken ";
        header("Location: ../views/editUsername.php");
        exit();
     
    }
}catch(PDOException $e){
    $_SESSION['t'] = "Connection errors";
    header("Location: ../views/editUsername.php");
    exit();
}
 }
else{
    $_SESSION['t'] = "Usernames don't match ";
    header("Location: ../views/editUsername.php");
    exit();
    }
}
