<?php

require_once 'database.php';

// CREATE DATABASE
try {
        // Connect to Mysql server
        $dbh = new PDO($DB_DSN1, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS Camagru";
        $dbh->exec($sql);
        echo "Database created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING DB: \n".$e->getMessage();
        exit(1);
    }

// CREATE TABLE USERS
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //sql to create table
        $sql = "CREATE TABLE IF NOT EXISTS users (
          id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          Username VARCHAR(50) NOT NULL,
          email VARCHAR(100) NOT NULL,
          passwd VARCHAR(255) NOT NULL,
          token VARCHAR(50) NOT NULL,
          varified VARCHAR(1) NOT NULL DEFAULT '0',
          mailNotif INT(1) NOT NULL DEFAULT '1'
        )";
        $dbh->exec($sql);
        echo "Table users created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() . "<br>";
    }

// CREATE TABLE GALLERY
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS images (
        `image_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        `image`VARCHAR(200) NOT NULL,
        `user` VARCHAR(255) NOT NULL,
	    `date_added` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
    )";
        $dbh->exec($sql);
        echo "Table gallery created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() ."<br>";
    }

// CREATE TABLE LIKE
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS likes (
        `like_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        `image_id` INT(11),
        `user` varchar(255),
        `image` INT(11)
       )";

    $dbh->exec($sql);
        echo "Table like created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() ."<br>";
    }

// CREATE TABLE COMMENT
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS comments (
        `comment_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        `Username` VARCHAR(255) NOT NULL,
        `comment` TEXT NOT NULL,
        `image_id` INT(255) NOT NULL,
        `date_added` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL	
       )";
        $dbh->exec($sql);
        echo "Table comment created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() ."<br>";
    }
    //Insert dummy users into database
try
{
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $dbh->prepare("INSERT INTO users (username, email, Passwd, token, varified) VALUES (?, ?, ?, ?, ?)");
    $token = uniqid(rand(), true);
    $pass = hash("whirlpool", 'aaaa1');
    $query->execute(array('Killerbee','killerbee@bee.com', $pass,$token, '1'));
    echo "User successfully added";
}catch (PDOException $e)
{
    echo "Error inserting user".$e->getMessage();
}

try
{
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $dbh->prepare("INSERT INTO users (username, email, Passwd, token, varified) VALUES (?, ?, ?, ?, ?)");
    $token = uniqid(rand(), true);
    $pass = hash("whirlpool", 'aaaa1');
    $query->execute(array('bee','bee@beetle.com', $pass,$token, '1'));
    echo "User successfully added";
}catch (PDOException $e)
{
    echo "Error inserting user".$e->getMessage();
}

    if (!file_exists('../uploads')) {
        mkdir('../uploads', 0777, true);
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<div class="index_redir">
    <button id="indexbtn" name="inbtn" style="animation: ease-in-out; padding: 20px; alignment: center"><a href="../index.php">Index</a></button>
</div>
</body>
</html>
