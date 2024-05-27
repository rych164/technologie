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
        <div class="col-md-4 feature">
            <img src="DALL·E 2024-04-23 21.49.53 - A dynamic action shot of an individual lifting weights in a gym setting. The person is focused and engaged in a heavy weightlifting session, showcasin.webp" style="width: 140px; height: 140px;">
            <h2>Rows</h2>
            <p>Envision the grit of the man in the image, every lift a testament to power. Here's what strength training brings to your life:
            <ul>
                <li><strong>Muscle Sculpting:</strong> Carve out definition with each pull. Activate 85% of your body's muscles for full-body toning.</li>
                <li><strong>Calorie Burn:</strong> Torching calories, rowing amplifies fat loss and muscle gain for a lean physique.</li>
                <li><strong>Cardiovascular Boost:</strong> Elevate your heart rate and stamina. Build a body that's durable, inside and out.</li>
                <li><strong>Joint-Friendly:</strong> Low impact yet high intensity, rowing respects your joints while demanding your all.</li>
                <li><strong>Core and Posture:</strong> Anchor your body with a solid core. Stand tall, prevent pain, radiate strength.</li>
                <li><strong>Mental Grit:</strong> Sharpen your focus. Discipline your mind with the rhythm of the row.</li>
            </ul>
            Transform with rowing, where every stroke is a stroke of genius.</p>
            <button>View details</button>
        </div>
        <div class="col-md-4 feature">
            <img src="DALL·E 2024-04-23 21.48.18 - Generate an image of a man doing a squat with a barbell, realistic style, gym environment, full color.webp" alt="Man doing squat with barbell" style="width: 140px; height: 140px;">
            <h2>Squat</h2>
            <p>Embrace the squat – the cornerstone of power. It's more than an exercise; it's a life-changer:
            <ul>
                <li><strong>Full-Body Workout:</strong> Squats target multiple muscle groups for comprehensive strength and toning.</li>
                <li><strong>Calorie Incinerator:</strong> Fire up your metabolism. Burn more, build more, be more.</li>
                <li><strong>Balance and Mobility:</strong> Cultivate grace in power. Enhance your body's harmony and movement.</li>
                <li><strong>Postural Perfection:</strong> Build a back that bears the world. Elevate your stance in work and play.</li>
                <li><strong>Bone Density:</strong> Fortify your frame. Grow stronger, stand sturdier, age with confidence.</li>
            </ul>
            Let every squat lift your spirit as much as your strength. Power is a choice—choose to rise.</p>
            <button>View details</button>
        </div>
    </div>
    <?php include("footer.php")?>
</div>
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