<!DOCTYPE html>
<html lang="en">
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
        <h2>Admin Login</h2>
        <form method="POST" id="loginForm">
            <label for="email">Email</label>
            <input type="email" id="email" name="AdminEmail" placeholder="abc123@gmail.com" required>

            <label for="otp">Password</label>
            <input type="password" id="password" name="AdminPassword" minlength="8" placeholder="Password@123" required>
            <i class="fas fa-eye" id="showPassword" onclick="togglePasswordVisibility()"></i><br>

            <button type="submit" name="Login" class="btns">Login</button>
        </form>
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

    <?php
    require("connection.php");

    if (isset($_POST['Login'])) {
        $adminEmail = $_POST['AdminEmail'];
        $adminPassword = $_POST['AdminPassword'];

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM `admin_login` WHERE `Admin_Email`=? AND `Admin_Password`=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ss", $adminEmail, $adminPassword);
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check the number of rows
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['admin_authenticated'] = true;
            header("location:admin_process.php");
        } else {
            echo "<script>alert('Incorrect Email or Password');</script>";
        }
    }
    ?>
</body>
</html>
