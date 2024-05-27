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
                var_dump($password);
                var_dump($user_data['user_password']);
                var_dump(password_hash($password,PASSWORD_DEFAULT));
                var_dump(password_verify($user_data['user_password'],$password));
                if(password_verify($password,$user_data['user_password']))
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
            Login
        </button>
        <div id="box">
            <form method="post">
                <input type="text" name="user_name">
                <input type="password" name="password">
                <input id="button" type="submit" value="Login">
            </form>
        </div>
        <?php include("footer.php")?>
    </body>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="login.php"> <!-- Update action as needed -->
                        <div class="form-group">
                            <label for="user_name_login">Username:</label>
                            <input type="text" class="form-control" id="user_name_login" name="user_name" required>
                        </div>
                        <div class="form-group">
                            <label for="password_login">Password:</label>
                            <input type="password" class="form-control" id="password_login" name="password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</html>
