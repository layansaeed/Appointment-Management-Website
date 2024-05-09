<?php
require 'controllers/connect.php';
session_start();
$error = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="layan aqel">
    <meta name="description" content="eye clinic">
    <meta name="keywords" content="eye clinic Offers A Change-Life Experience With Our Latest Eye Treatment Techniques. Through Eye Treatment Our Elite Doctors Provide A Suitable Diagnosis For Your Case. Free Medical Support. 12 Years Experience. Global Reputation">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home page</title>


</head>

<body>
    <header>
        <div id="logo">
            <a href="index.php"><img src="images/logo.jpeg" alt="Logo"></a>
        </div>
        <div id="nav">
            <a href="index.php">Home</a>
            <a href="service.php">services</a>  
            <?php if (!isset($_SESSION['privilleged'])) { ?>
                <a href="login.php">login</a>
                <a href="signup.php">sign up</a>
            <?php } else { ?>
                <a href="myAppointments.php">My appointments</a>
                <a href="booking.php">New Appointment</a>
                <a href="controllers/logout.php">Logout</a>
            <?php } ?>
        </div>
    </header>
    <div class="container">
        <div class="row" id="hero">
            <div class="text">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum, odit ea exercitationem
                distinctio laboriosam architecto harum soluta incidunt perferendis delectus ass
            </div>
        </div>
        <div class="row doctors">
            <?php
            $doctorSql = "SELECT * FROM doctor";
            $doctorStatement = $pdo->prepare($doctorSql);
            $doctorStatement->execute();
            $doctors = $doctorStatement->fetchAll();
            foreach($doctors as $doctor){  //doctor=row -> to access array
            echo 
            '<div class="card">
                <img src="'.$doctor['image']. '" alt="Doc-img">
                <h3 class="doc-name">' . $doctor['name'] . '</h3>
                <div class="text">' . $doctor['brief'] . '</div> 
            </div>';} //name,image -> name column of the table 
            ?>
        </div>
    </div>
    <hr>
    <footer>
        <div class="row">
            <a href="tel:1234567" id="phone" class="fa">&#xf095; Call 123-4567</a>
            <a href="https://goo.gl/maps/r4eYCfdLmgUuMxPKA" target="blank" id="location" class="fa">
                &#xf041; Jordan - Amman</a>
        </div>
        <div class="row">
            <p id="copyright-text">Copyright &copy; 2022 All Rights Reserved by Layan</p>
        </div>


    </footer>
    <?php 
    if(isset($_SESSION['error']) && $_SESSION['error'] != $error){
        echo '<script type="text/javascript"> ';
        echo 'alert("'.$_SESSION['error'].'");';
        echo '</script>';        
        unset($_SESSION['error']);
    }
    ?>
</body>

</html>