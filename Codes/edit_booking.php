<?php
require 'controllers/connect.php';
session_start();
$error = "";
if (!isset($_SESSION['privilleged'])) {
    $_SESSION['error'] = "This page require login please login to continue";
    header("location:login.php");
}
?>
<?php
$doctorSql = "SELECT * FROM doctor";
$doctorStatement = $pdo->prepare($doctorSql);
$doctorStatement->execute();
$doctors = $doctorStatement->fetchAll();


$typeSql = "SELECT * FROM appointment_types";
$typeStatement = $pdo->prepare($typeSql);
$typeStatement->execute();
$types = $typeStatement->fetchAll();
$pdo = null;
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
    <link rel="stylesheet" href="css/edit_booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Edit Booking</title>

</head>

<body>
    <header>
        <div id="logo"><a href="index.php"><img src="images/logo.jpeg" alt="Logo"></a></div>
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
    <hr>
    <?php if (isset($_GET['id'])) { ?>
        <div class="main-content">
            <div class="row">
                <div class="card">
                    <h1>Book your appointment</h1>

                    <div class="main-form">
                        <form action="controllers/appointmentEdit.php" method="post" class="form">
                            <input id="id" type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                            <div class="form-item">
                                <label for="selectdoctor">Doctor: </label>
                                <select name="doctor" id="selectdoctor">
                                    <?php
                                    foreach ($doctors as $doctor) {
                                        echo '<option value="' . $doctor['id'] . '">' . $doctor['name'] . '</option>\n';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-item">
                                <label for="selecttype">Type: </label>
                                <select name="type" id="selectservice">
                                    <?php
                                    foreach ($types as $type) {
                                        echo '<option value="' . $type['id'] . '">' . $type['name'] . '</option>\n';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-item">
                                <label for="date">Date: </label>
                                <input type="date" name="date" id="date">
                            </div>
                            <div class="form-item">
                                <label for="time">Time: </label>
                                <input type="time" name="time" id="time">
                            </div>
                            <div class="buttons">
                                <button name="save" type="submit" class="form" id="save">Save</button>
                                <button name="discard" type="submit" class="form" id="discard">Discard</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else
        echo "Invalid id\n"
    ?>


    <footer>
        <div class="row">
            <a href="tel:1234567" id="phone" class="fa">&#xf095; Call 123-4567</a>
            <a href="https://goo.gl/maps/r4eYCfdLmgUuMxPKA" target="blank" id="location" class="fa">&#xf041; Jordan -
                Amman</a>
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