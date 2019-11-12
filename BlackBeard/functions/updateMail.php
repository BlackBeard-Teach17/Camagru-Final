<?php session_start();

include('../Config/database.php');

$_SESSION['y'] = null;
$oldMail = $_POST['oldMail'];
$newMail = $_POST['newMail'];
 echo $oldMail."\n".$newMail."\n".$_SESSION['mail'];
if(isset($_POST['UpdateMail']))
{
    $mail =  $_SESSION['mail'];
    try{
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute($mail);
    }catch (PDOexception $e){
        $_SESSION['y'] = "Connection Error";
        header("Location: ../views/editMail.php");
    }
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $email = $row['email'];
    if ($mail == $oldMail)
    {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT email FROM users WHERE email = ?");
        $sql->execute(array($newMail));
        $found = $sql->rowCount();

        if ($found == 0)
        {
            $sql = $dbh->prepare("UPDATE users SET email = ? WHERE email = ?");
            $sql->execute(array($newMail, $mail));
            $_SESSION['y'] = "Email successfully changed";
            header("Location: ../views/editMail.php");
        }
        else{
            $_SESSION['y'] = "Email Already taken ";
            header("Location: ../views/editMail.php");
        }

    }else
    {
    $_SESSION['y'] = "User not found  " ;
    header("Location: ../views/editMail.php");
    }
}
else
{
    $_SESSION['y'] = "Something went wrong we working on it";
    header("Location: ../views/editMail.php");
}
