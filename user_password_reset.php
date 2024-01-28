<!-- user_password_reset.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    form {
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    p {
        color: #888;
        margin-top: 10px;
    }

    .btns {
        background-color: teal;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btns:hover {
        background-color: gray;
    }
</style>
<body>

    <?php
    // Handle password reset submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];

        // Perform the password reset logic here
        // You may want to send a password reset email with a unique link
        // or generate a temporary password and send it to the user
        // Update the user's password in the database or provide instructions

        // For simplicity, let's assume a success message for now
        echo "<script>alert('Password reset instructions sent to your email.');</script>";
    }
    ?>

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
        <h2>Forgot Password</h2>
        <form method="post" action="">
            Email: <input type="text" id="email" name="email" required><br>
            <input type="submit" class="btns" value="Reset Password">
        </form>
        <br>
        <p>Remember your password? <a href='user_login.php'>Login here</a></p>
    </div>

</body>
</html>
