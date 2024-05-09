<?php
session_start();

if(isset($_SESSION['privilleged'])){
    unset($_SESSION['privilleged']);
}
else {
    echo "You are not logged in\n";
}

header("location:../index.php");
    die();
?>