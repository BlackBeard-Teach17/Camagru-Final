<?php
//echo "Account Already Activated or Not Found";
include ('../Config/database.php');
$tok = $_GET['token'];

  try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM users WHERE token = ? AND varified = ?");
    $stmt->execute(array($tok, '0'));
    $found = $stmt->rowCount();

        if($found == 1)
        {
            $query = $conn->prepare("UPDATE users SET varified = ? WHERE token = ?");
            $query->execute(array('1', $tok));
        echo "Account active can now Login";
        echo '<br>';
        echo '<br>';
        ?>
        <a href="../views/login.php"><button style="padding:5px">Press to Login</button></a>
        <?php
        return;
       
        //header('Location: login.php');
        }
        echo "Account Already Activated or Not Found";
        return ;
       // header('Location: index.php');
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

?>
