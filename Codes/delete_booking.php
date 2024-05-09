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
$sql = "SELECT * FROM appointment where id=:id";
$statement = $pdo->prepare($sql);
$id = $_GET['id'];
$statement->bindParam(":id", $id, PDO::PARAM_INT);
$statement->execute();
$data = $statement->fetch();


$doctorSql = "SELECT name FROM doctor WHERE id=:id";
$doctorStatement = $pdo->prepare($doctorSql);
$doctorStatement->bindParam(":id", $data['doctor'], PDO::PARAM_INT);
$doctorStatement->execute();
$doctor = $doctorStatement->fetchColumn();
$data['doctor'] = $doctor;

$typeSql = "SELECT name FROM appointment_types WHERE id=:id";
$typeStatement = $pdo->prepare($typeSql);
$typeStatement->bindParam(":id", $data['type'], PDO::PARAM_INT);
$typeStatement->execute();
$type = $typeStatement->fetchColumn();
$data['type'] = $type;

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
    <link rel="stylesheet" href="css/delete_booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Delete Booking</title>

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
    <div class="main-content">
        <div class="row">
            <div class="card">
                <h1>Do you want to delete this appointment?</h1>
                <div class="main-form">
                    <div class="appointment-item">
                        <span>Doctor: </span>
                        <span><?php echo $data['doctor']; ?> </span>
                    </div>
                    <div class="appointment-item">
                        <span>Type: </span>
                        <span><?php echo $data['type']; ?></span>
                    </div>
                    <div class="appointment-item">
                        <span>At: </span>
                        <span><?php echo $data['date'] . " " . $data['time']; ?></span>
                    </div>
                    <form action="controllers/appointmentDelete.php" method="post" class="form">
                        <div class="buttons">
                            <input id="id" type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                            <button name="delete" type="submit" class="form" id="delete">Yes, I'm sure</button>
                            <button name="discard" type="submit" class="form" id="discard">No, Go back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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