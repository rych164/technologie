<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data=check_login($con);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My website</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php include("logged_in_navbar.php")?>
        <br>
        <p>Hellow, <?php echo $user_data['user_name']?></p>
    </body>
</html>
