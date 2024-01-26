<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/84847aa513.js" crossorigin="anonymous"></script>
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
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format');</script>";
        } elseif (strlen($password) < 6 || !preg_match('/\d/', $password)) {
            echo "<script>alert('Password should be at least 6 characters long and include numbers');</script>";
        } else {
            // Check if email already exists
            $conn = new mysqli("localhost", "root", "", "marriage_registration_db");

            $result = $conn->query("SELECT * FROM users_login WHERE email='$email'");

            if ($result->num_rows > 0) {
                echo "<script>alert('Email already exists. Please use a different email.');</script>";
            } else {
                // Insert user into database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $conn->query("INSERT INTO users_login (email, password) VALUES ('$email', '$hashed_password')");
                header("Location: user_sinup_process.php");
                // echo "Signup successful. <a href='user_login.php'>Login here</a>";
            }

            $conn->close();
        }
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
        <h2>Sign up</h2>
        <form method="post" action="" id="loginForm">
            Email: <input type="text" id="email" name="email" required><br>
            Password: <input type="password" id="password" name="password" required> 
            <i class="fas fa-eye" id="showPassword" onclick="togglePasswordVisibility()"></i>
            <br>
            <input type="submit" class="btns" value="Sign up">
        </form>
        <p>Have an account? <a href='user_login.php'>Login here</a></p>
    </div>

    <script>
        function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var showPasswordIcon = document.getElementById("showPassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showPasswordIcon.classList.remove("fa-eye");
            showPasswordIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            showPasswordIcon.classList.remove("fa-eye-slash");
            showPasswordIcon.classList.add("fa-eye");
        }
        }
    </script>
</body>
</html>
