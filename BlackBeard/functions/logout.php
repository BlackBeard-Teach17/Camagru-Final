<?php
session_start();
echo "logged out";
session_destroy();
header("Location: ../views/login.php")
?>