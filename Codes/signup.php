<?php
require 'controllers/connect.php';
session_start();
$error = "";
if (isset($_SESSION['privilleged'])) {
    echo "You are loged in please login \n";
    header("location:index.php");
}
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    


    $sql = "INSERT INTO user (f_name,l_name,password,email,gender,city) values (:f_name,:l_name,:password,:email,:gender,:city)";
    $statement = $pdo->prepare($sql);
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];

    $statement->bindParam(":f_name", $f_name, PDO::PARAM_STR);
    $statement->bindParam(":l_name", $l_name, PDO::PARAM_STR);
    $statement->bindParam(":email", $email, PDO::PARAM_STR);
    $statement->bindParam(":password", $password, PDO::PARAM_STR);
    $statement->bindParam(":gender", $gender, PDO::PARAM_STR);
    $statement->bindParam(":city", $city, PDO::PARAM_STR);
    $statement->execute();

    echo "new user is added succefully, go to login ";
    header("location:login.php");
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
    <link rel="stylesheet" href="css/signup.css">
    <title>Sign up</title>

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

                <input type="text" name="fname" placeholder="Enter your first name" class="input" required><br> <br>
                <input type="text" name="lname" placeholder="Enter youe last name" class="input" required><br> <br>
                <input type="email" name="email" placeholder="Enter your email" class="input" required><br> <br>
                <input type="password" name="pass" placeholder="Enter your password" class="input" required><br> <br>


                <select name="gender" class="select">
                    <option value="G">Gender</option>
                    <option value="f">female</option>
                    <option value="m">male</option>

                </select>
                <select name="city" class="select">

                    <option value="C">City</option>
                    <option value="Amman">Amman</option>
                    <option value="Zarqa">Zarqa</option>
                    <option value="Irbid">Irbid</option>
                    <option value="Jerash">Jerash</option>
                    <option value="Ajloun">Ajloun</option>
                    <option value="Al Mafraq">Al Mafraq</option>
                    <option value="Other">Other</option>
                </select> <br>
                <button type="submit" id="button">Register</button> <br><br>
                <label>Already have an account? <a href="login.php" style="text-decoration:none;">Sign in</a></label> <br>
                <a href="index.php" style="text-decoration: none;">Home</a>
            </form>

        </div>
    </div>
</body>

</html>