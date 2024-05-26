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
        $query= "select * from users where user_name = '$user_name' limit 1";
        $result =mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result)>0)
            {
                $user_data= mysqli_fetch_assoc($result);
                if($user_data['user_password']===$password)
                {
                    $_SESSION['user_name']=$user_data['user_name'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "Enter valid information";
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
        <title>login</title>
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
                <input id="button" type="submit" value="Login">
            </form>
        </div>
    </body>
</html>
