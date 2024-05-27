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
            <p>Stride through life with the confidence of the poised figure in our image. In fitness as in fashion, what's beneath counts:
            <ul>
                <li><strong>Elegance in Strength:</strong> Let your physique be your finest attire. Elegance isn't worn, it's embodied.</li>
                <li><strong>Discipline's Tale:</strong> Your build narrates a story of resolve. It whispers of early mornings and late gym sessions.</li>
                <li><strong>Commanding Presence:</strong> Walk into any room, and own it. A sculpted body speaks volumes before a word is uttered.</li>
                <li><strong>Amplified Appeal:</strong> Transcend trends with timeless strength. Let your form be your most captivating feature.</li>
                <li><strong>A Portrait of Health:</strong> Your commitment reflects in your posture, your pace, your presence. It's a living, breathing testament to the life you choose.</li>
                <li><strong>Quiet Confidence:</strong> With a body honed by sweat and perseverance, let confidence be your silent, steadfast companion.</li>
            </ul>
            Be the protagonist of your own story. Command the scene. Not just fit, but a fitness maestro.</p>

        </div>
    </div>
    <div class="row">
        <div class="col-12 large-image">
            <img src="DALL·E 2024-04-23 21.50.17 - An illustration of a fit individual, clearly a gym enthusiast, fully clothed in a rustic town square. The character is wearing a stylish casual outfit.webp" alt="Large feature">
        </div>
    </div>
    <div class="row">
        <div class="col-12 footer-text">
            <p>Picture yourself striding with purpose through a vibrant cityscape, each step a reflection of unyielding confidence and the spirit of a trailblazer. The individual in the image is more than a figure in a crowd; they're a testament to what discipline and fitness can sculpt—poise and reliability woven into their very presence. Here's what this powerful image symbolizes for you:
            <ul>
                <li><strong>Symbol of Success:</strong> The tailored lines of a suit complement the musculature underneath, showcasing a body shaped by dedication—a silent announcement of a person ready to take on the world.</li>
                <li><strong>Commitment Personified:</strong> Your muscular stature isn't merely seen—it's felt. It speaks a story of perseverance, of routines mastered, and excellence achieved. It's the embodiment of a professional who brings the strength of the gym to every business challenge.</li>
                <li><strong>Presence That Speaks:</strong> Command attention without a word. Your fitness level is a powerful communicator in the boardroom, conveying that you're as robust in strategy as you are in strength.</li>
                <li><strong>Amplified Elegance:</strong> Your build is the ultimate accent to your wardrobe. Transform any occasion with your formidable presence, harmonizing with the finest garments and the grandest settings.</li>
                <li><strong>Reliability Reflected:</strong> Your muscular form mirrors a work ethic of iron, a visual commitment to goals met and exceeded, in the gym, in business, in every endeavor.</li>
                <li><strong>Magnetic Confidence:</strong> Fitness breeds a compelling confidence, a force that influences, attracts success, and leads with quiet authority.</li>
            </ul>
            Embrace the fitness journey, let it be your second skin, and ascend to the zenith of your potential. Engage with your well-being, and elevate every aspect of your existence. Start today.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 large-image">
            <img src="DALL·E 2024-04-23 21.50.24 - An illustration of a fit individual, clearly a regular at the gym, dressed in a sharp suit standing outside of a skyscraper. The character exudes a pr.webp" alt="Large feature">
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
