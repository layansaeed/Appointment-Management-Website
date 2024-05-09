<?php
require 'connect.php';
session_start();
if(isset($_POST) && isset($_SESSION['privilleged'])){

    $sql= "INSERT INTO appointment(user,doctor,type, date, time) values (:user,:doctor,:type, :date, :time)";
    $statement = $pdo->prepare($sql);
    $user = $_SESSION["privilleged"];
    $doctor = $_POST['doctor'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $statement->bindParam(":user", $user, PDO::PARAM_INT);
    $statement->bindParam(":doctor", $doctor, PDO::PARAM_INT);
    $statement->bindParam(":type", $type, PDO::PARAM_INT);
    $statement->bindParam(":date", $date, PDO::PARAM_STR);
    $statement->bindParam(":time", $time, PDO::PARAM_STR);
    $statement->execute();
    $pdo=null;

    header("location:../myAppointments.php");
}
?>