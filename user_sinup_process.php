<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="#" onclick="redirectToIndex()">Marriage Registration</a>
        <form>
            <button class="about_btn">About</button>
        </form>
    </nav>
    <script>
        function redirectToIndex() {
            window.location.href = 'index.php';
        }
    </script>
    <div class="container">
        <h2>Successful..!</h2>
        <p>Please click to <a href='user_login.php'>login here</a></p>
    </div>
</body>
</html>
