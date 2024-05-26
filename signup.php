<?php
session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password))
        {
            $query= "insert into users(user_name,user_password) values('$user_name','$password')";
            mysqli_query($con,$query);

            header("Location: login.php");
            die;

        }
        else
        {
            echo "Enter valid information";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>signup</title>
</head>
<body>
<div id="box">
    <form method="post">
        <input type="text" name="user_name">
        <input type="password" name="password">
        <input id="button" type="submit" value="Sign Up">

        <a href="login.php">Login</a>
    </form>
</div>
</body>
</html>
