<?php
session_start();

    include("connection.php");
    include("functions.php");

$error_message = ""; // Initialize an error message variable

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $repeat_password = $_POST['repeat_password'];

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    }

    // Check if passwords match
    elseif ($password !== $repeat_password) {
        $error_message = "Passwords do not match";
    }


    // Proceed if no errors
    elseif (!empty($user_name) && !empty($password) && !empty($email)) {
        $password = password_hash($password,PASSWORD_DEFAULT);
        $query = "INSERT INTO users(email,user_name, user_password) VALUES ( '$email','$user_name', '$password')";
        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    } else {
        $error_message = "Please enter valid information";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include("logged_out_navbar.php") ?>
<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signInModal">
    Sign Up
</button>

<!-- Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signInModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="user_name">Username:</label>
                        <input type="text" class="form-control" name="user_name" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="repeat_password">Repeat Password:</label>
                        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php") ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
