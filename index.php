<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body  {
    background-image: url("images/index_page.jpg");
    background-size: 100vw 100vh;
    }
</style> 
<body>
    <nav>
        <a href="#" onclick="redirectToIndex()">Marriage Registration</a>
        <form method="POST">
            <button name="Logout" class="about_btn">About</button>
        </form>
    </nav>

    <script>
        function redirectToIndex() {
            window.location.href = 'index.php';
        }
    </script>
    <div class="please_login">
        <h1>Please login</h1>
        <div class="lgin_as">
            <a href="user_signup.php" class="button user-button">User</a>
            <a href="admin_login.php" class="button admin-button">Admin</a>
        </div>
        <br>
        <h2>________Note________</h2>
        <h2>Login with user, if your or fiance/fiancee</h2>
    <div>
</body>
</html>
