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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>singin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include("logged_out_navbar.php") ?>
<div id="box">
    <form method="post">
        <input type="text" name="user_name">
        <input type="password" name="password">
        <input id="button" type="submit" value="Sign Up">
    </form>
</div>
</body>
</html>
