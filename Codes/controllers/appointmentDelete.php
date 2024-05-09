<?php
if(isset($_POST['delete'])){
    require 'connect.php';
    $sql= "DELETE FROM appointment WHERE id=:id";
    $id=$_POST['id'];
    echo $id;
    $statement=$pdo->prepare($sql);
    $statement->bindParam(":id",$id, PDO::PARAM_INT);
    $statement->execute();
    $pdo=null;
}
header("location:../myAppointments.php");
?>