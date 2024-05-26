<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data=check_login($con);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My website</title>
    </head>
    <body>
        <a href="logout.php">logout</a>
        <h1>this is index Page</h1>
        <br>
        <p>Hellow, <?php echo $user_data['user_name']?></p>
    </body>
</html>
