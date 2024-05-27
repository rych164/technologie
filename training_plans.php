<?php
session_start();
include("connection.php");
include("functions.php");

$message = ''; // Initialize message variable
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message']; // Retrieve the message from session
    unset($_SESSION['message']); // Clear the message from session
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == "login") {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        if (!empty($user_name) && !empty($password)) {
            $query = "select * from users where user_name = '$user_name' limit 1";
            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['user_password'])) {
                    $_SESSION['user_name'] = $user_data['user_name'];
                    $_SESSION['message'] = ['text' => 'Login successful!', 'type' => 'success'];
                    header("Location: exercises.php");
                    exit;
                } else {
                    $_SESSION['message'] = ['text' => 'Invalid username or password', 'type' => 'error'];
                    header("Location: exercises.php");
                    exit;
                }
            } else {
                $_SESSION['message'] = ['text' => 'Invalid username or password', 'type' => 'error'];
                header("Location: exercises.php");
                exit;
            }
        } else {
            $_SESSION['message'] = ['text' => 'Please enter username and password', 'type' => 'error'];
            header("Location: exercises.php");
            exit;
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['action']) && $_POST['action'] == "signup") {
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];
            $repeat_password = $_POST['repeat_password'];
            $email = $_POST['email'];

            // Check if passwords match
            if ($password !== $repeat_password) {
                $_SESSION['message'] = ['text' => 'Passwords do not match.', 'type' => 'error'];
                header("Location: exercises.php");
                exit;
            }

            // Check for unique username
            $user_check_query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
            $user_check_result = mysqli_query($con, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['message'] = ['text' => 'Username already exists.', 'type' => 'error'];
                header("Location: exercises.php");
                exit;
            }

            // Check for unique email
            $email_check_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
            $email_check_result = mysqli_query($con, $email_check_query);
            if (mysqli_num_rows($email_check_result) > 0) {
                $_SESSION['message'] = ['text' => 'Email already exists.', 'type' => 'error'];
                header("Location: exercises.php");
                exit;
            }

            // If all checks pass, proceed with user registration
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users(email, user_name, user_password) VALUES ('$email', '$user_name', '$password')";
            $result = mysqli_query($con, $query);
            if ($result) {
                $_SESSION['message'] = ['text' => 'Registration successful!', 'type' => 'success'];
                header("Location: exercises.php");
                exit;
            } else {
                $_SESSION['message'] = ['text' => 'Registration failed. Please try again.', 'type' => 'error'];
                header("Location: exercises.php");
                exit;
            }
        }
    }
}

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gymly</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php
($user_data)? include("logged_in_navbar.php") :include ("logged_out_navbar.php");
?>
<div class="container">
    <div class="row">
        <div class="col-12 header-title">
        </div>
    </div>
    <div class="row">
        <div class="col-12 footer-text">
            <p style="text-align: center;"><strong>Unlock the ultimate transformation with our Full Body Training Plan!</strong> Imagine sculpting every muscle, boosting your energy, and achieving the physique you've always dreamed of. This comprehensive program is designed to target all major muscle groups, ensuring balanced development and maximum results. With easy-to-follow instructions and expert guidance, you'll be on the fast track to fitness success. <em>Don't miss the opportunity to invest in yourself</em></p>
            <br>
            <div class="col-12 training-plan-image">
                <img src="DALL·E 2024-04-23 21.50.17 - An illustration of a fit individual, clearly a gym enthusiast, fully clothed in a rustic town square. The character is wearing a stylish casual outfit.webp" alt="Large feature">
            </div>
            <br>
            <p style="text-align: center;">Your best body is just a plan away!</p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 footer-text">
            <p style="text-align: center; color: #d9d9d9; font-family: 'Arial', sans-serif; margin-top: 20px;">
                <strong>Transform your body with our Upper Lower Program!</strong> Imagine a workout routine that strategically divides your training into upper and lower body days, maximizing efficiency and results. This program ensures you give each muscle group the attention it deserves, promoting balanced growth and strength. With tailored exercises and expert guidance, you'll build a powerful upper body and strong, toned legs. <em>Seize the opportunity to enhance your fitness journey.</em></p>
            <br>
            <div class="col-12 training-plan-image">
                <img src="DALL·E 2024-04-23 21.50.24 - An illustration of a fit individual, clearly a regular at the gym, dressed in a sharp suit standing outside of a skyscraper. The character exudes a pr.webp" alt="Large feature">
            </div>
            <p style="text-align: center;"> Your ideal physique is within reach!</p>
        </div>
    </div>
</div>
<?php include("footer.php")?>
</body>
<?php include("modals.php") ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var message = <?php echo json_encode($message); ?>;
        if (message !== '') {
            Swal.fire({
                title: message.type === 'success' ? 'Success' : 'Error',
                text: message.text,
                icon: message.type,
                confirmButtonText: 'OK',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary', // Use Bootstrap button styling
                    popup: 'swal-wide', // Custom class for wider pop-up
                    title: 'text-light',
                    content: 'text-light',
                    icon: 'text-warning'
                },
                background: '#262626',
                color: '#d9d9d9',
                confirmButtonColor: '#ffa500',
                iconColor: '#ffa500'
            });
        }
    });
</script>
</html>
