<?php
require 'connect.php';
session_start();

if (isset($_POST)) {

    $sql = "UPDATE appointment SET user=:user, doctor=:doctor, type=:type, date=:date, time=:time where id=:id";
    $statement = $pdo->prepare($sql);
    $id = $_POST['id'];
    $user = $_SESSION["privilleged"];
    $doctor = $_POST['doctor'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->bindParam(":user", $user, PDO::PARAM_INT);
    $statement->bindParam(":doctor", $doctor, PDO::PARAM_INT);
    $statement->bindParam(":type", $type, PDO::PARAM_INT);
    $statement->bindParam(":date", $date, PDO::PARAM_STR);
    $statement->bindParam(":time", $time, PDO::PARAM_STR);
    $statement->execute();
    $pdo = null;

    header("location:../appointment.php?id=".$id);
}
?>