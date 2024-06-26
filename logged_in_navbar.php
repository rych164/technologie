<?php
// Check if the logout has been requested
if (isset($_GET['logout'])) {
    // Unset the user session
    unset($_SESSION['user_name']);
    // Redirect to a certain page (e.g., login page)
    header("Location: index.php");
    exit;
}
?>
<link href="style.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="scripts.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="index.php"><img id="logo" src="transparent_logo.png" alt="transparent_logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="shop.php">Shop</a>
            <a class="nav-item nav-link" href="exercises.php">Exercises</a>
            <a class="nav-item nav-link" href="training_plans.php">Training Plans</a>
            <a href="?logout=true" class="nav-item nav-link">Log out</a>
        </div>
    </div>
</nav>