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
            <div class="nav-item dropdown">
                <a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sign In/Login
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#signInModal">Sign In</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#loginModal">Log In</a>
                </div>
            </div>
            <a class="nav-item nav-link" href="#" onclick="showLoginAlert(); return false;">Shop</a>
            <a class="nav-item nav-link" href="exercises.php">Exercises</a>
            <a class="nav-item nav-link" href="training_plans.php">Training Plans</a>
        </div>
    </div>
</nav>
<script>
    function showLoginAlert() {
        Swal.fire({
            title: 'Access Denied',
            text: 'To access the shop, you have to be logged in.',
            icon: 'error',
            confirmButtonText: 'OK',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                popup: 'swal-wide',
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
</script>
