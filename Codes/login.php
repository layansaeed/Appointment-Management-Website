<?php
require 'controllers/connect.php';
session_start();
$error = "";
if (isset($_SESSION['privilleged'])) {
    $error =  "You are loged in so you cannot relog in ";
    $_SESSION['error'] = $error;
    header("location:index.php");
}
?>
<?php
if (isset($_POST['login'])) {

    $sql = "SELECT * from user where email=:email and password=:password";
    $statement = $pdo->prepare($sql);
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $statement->bindParam(":email", $email, PDO::PARAM_STR);
    $statement->bindParam(":password", $password, PDO::PARAM_STR);
    $statement->execute();
    $count = $statement->rowCount();  //1 or 0
    $user = $statement->fetch();
    if ($count == 1) {
        $_SESSION['privilleged'] = $user['id'];
        header("location:index.php");
    } else {
        echo "Invalid email or password";
    }
    $pdo = null;
}
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
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>

</head>

<body>
    <div class="container">
        <div id="left-column">
        </div>
        <div id="right-column">
            <header>
                <h1>Eye Clinic</h1>
            </header>

            <form action="" method="post" id="main-form">


                <br>
                <input type="text" name="email" placeholder="Enter Your Email" id="email" required> <br> <br>
                <input type="password" name="pass" placeholder="Enter Your Password" id="pass" required> <br><br>

                <button type="submit" id="button" name="login">Login</button> <br> <br>
                <input type="checkbox" name="check">&nbsp;<label>Remember Me</label> <br> <br>
                <label>Don't have an account? <a href="signup.php" style="text-decoration:none;">sign up</a> </label> <br> <br>
                <a href="index.php" style="text-decoration: none;">Home</a>

            </form>
        </div>

    </div>

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