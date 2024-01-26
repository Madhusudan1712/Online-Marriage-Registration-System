<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    // Redirect to the login page if not authenticated
    header("location: admin_login.php");
    exit();
}

// Check if the user came from the login page (avoid direct URL access)
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "admin_login.php") === false) {
    // Redirect to the login page
    header("location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <script>
        // Check if the page is being loaded from cache or refreshed
        if (performance.navigation.type === 1) {
            // Page is refreshed, redirect to admin_login.php
            window.location.href = 'admin_login.php';
        }
    </script>
    <nav>
        <a href="#" onclick="redirectToIndex()">Marriage Registration</a>
        <form method="POST">
            <button name="Logout" class="about_btn">Log out</button>
        </form>
    </nav>

    <script>
        function redirectToIndex() {
            window.location.href = 'index.php';
        }
    </script>
    <?php
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("Location: index.php");
    }
    ?>
</body>
</html>
