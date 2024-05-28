<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['remove_id'])) {
    // Remove the training plan from the cart
    $remove_id = $_POST['remove_id'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);  // Remove the item from the cart
        $_SESSION['message'] = ['text' => 'Training plan removed successfully!', 'type' => 'success'];
    }
    header("Location: shop.php");
    exit;
}

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
    header("Location: shop.php"); // Redirect to a cart page or back to plans
    exit;

}

$user_data = check_login($con);
$training_plans = mysqli_query($con, "SELECT id, name, price FROM training_plans");

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
    <?php  if (mysqli_num_rows($training_plans) > 0): ?>
        <div class="list-group">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <div class="list-group-item">
                        <?php echo $item['name'] . " - $" . $item['price']; ?>
                        <form action="shop.php" method="post" style="display: inline-block;">
                            <input type="hidden" name="remove_id" value="<?php echo $index; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <a href="training_plans.php" class="btn btn-primary">Add New Training Plan</a>
        </div>
        <div class="mt-3">
            <h4>Summary</h4>
            <p>Total Training Plans: <?php echo $total_count; ?></p>
            <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
        </div>
    <?php else: ?>
        <p>You have not chosen any training plan yet. To start your training journey, pick at least one.</p>
        <div class="mt-4">
            <a href="training_plans.php" class="btn btn-primary">Add New Training Plan</a>
        </div>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>
</body>
</html>
