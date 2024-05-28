<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['plan_id'])) {
    $plan_id = $_POST['plan_id'];
    // Fetch the plan details from the database
    $query = "SELECT * FROM training_plans WHERE id = $plan_id";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $plan = mysqli_fetch_assoc($result);
        // Assume $_SESSION['cart'] holds cart items
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $plan;  // Add the plan to the cart
        $_SESSION['message'] = ['text' => 'Plan added to cart successfully!', 'type' => 'success'];
    } else {
        $_SESSION['message'] = ['text' => 'Invalid plan selected', 'type' => 'error'];
    }
    header("Location: cart.php"); // Redirect to a cart page or back to plans
    exit;
}

$user_data = check_login($con);
//$training_plans = mysqli_query($con, "SELECT id, name, price FROM training_plans");

$total_price = 0;
$total_count = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gymly - Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include("logged_in_navbar.php"); ?>

<div class="container">
    <h2>Your Training Plans</h2>
    <?php // if (mysqli_num_rows($training_plans) > 0): ?>
        <div class="list-group">
            <?php // while($plan = mysqli_fetch_assoc($training_plans)): ?>
                <a href="#" class="list-group-item list-group-item-action">
                    <?php // echo $plan['id'] . ". " . $plan['name'] . " - $" . $plan['price']; ?>
                </a>
                <?php
//                $total_price += $plan['price'];
//                $total_count++;
                ?>
            <?php //endwhile; ?>
        </div>
        <div class="mt-4">
            <a href="training_plans.php" class="btn btn-primary">Add New Training Plan</a>
        </div>
        <div class="mt-3">
            <h4>Summary</h4>
            <p>Total Training Plans: <?php echo $total_count; ?></p>
            <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
        </div>
    <?php //else: ?>
        <p>You have not chosen any training plan yet. To start your training journey, pick at least one.</p>
        <div class="mt-4">
            <a href="training_plans.php" class="btn btn-primary">Add New Training Plan</a>
        </div>
    <?php// endif; ?>
</div>

<?php include("footer.php"); ?>
</body>
</html>
