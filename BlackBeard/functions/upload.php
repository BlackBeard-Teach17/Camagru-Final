<?php
session_start();
require_once('../Config/database.php');

if ($_POST['image_data']){
    $timestamp = new DateTime();
    $timestamp = $timestamp->getTimestamp();
    $filename = 'img'.$timestamp.'.png';
    $pic = 'uploads/'.$filename;
    $src = explode(',', $_POST['image_data']);

    $name =$_SESSION['username'];

    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("INSERT INTO `images` (`image_id`, `user`, `image`, `date_added`) VALUES (NULL, '" . $name . "', '" . $pic . "', CURRENT_TIMESTAMP)");
        file_put_contents($pic, base64_decode($src[1]));
        if ($query->execute())
            header("Location: ../views/cam.php");
        else
            echo "failure";//session message failure

    } catch(PDOException $e){
        echo "ERROR EXECUTING: \n".$e->getMessage();
    }
} elseif (isset($_POST['submit'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if ($fileSize < 10000000){
                $timestamp = new DateTime();
                $timestamp = $timestamp->getTimestamp();
                $fileNameNew = 'img'.$timestamp.'.'.$fileActualExt;
                $pic = 'uploads/'.$fileNameNew;

                $name =$_SESSION['username'];

                try{
                    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $conn->prepare("INSERT INTO `images` (`image_id`, `user`, `image`, `date_added`) VALUES (NULL, '" . $name . "', '" . $pic . "', CURRENT_TIMESTAMP)");
                    move_uploaded_file($fileTmpName, $pic);
                    if ($query->execute())
                        header("Location: ../views/cam.php");
                    else
                        echo "failure";

                } catch(PDOException $e){
                    echo "ERROR EXECUTING: \n".$e->getMessage();
                }
            }else{
                echo "File is too big";
            }
        }else{
            echo "An error occurred while uploading the file";
        }
    }else{
        header("Location: ../views/cam.php");
    }
} else {
    header("Location: ../views/cam.php");
}
?>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Upload picture</title>
    <link rel="stylesheet" href="../styles/cam.css">
</head>
<body>
</body>
</HTML>
