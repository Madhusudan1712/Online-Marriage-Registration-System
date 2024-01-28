<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    redirectToLoginPage();
}

$registeredEmail = isset($_SESSION['registered_email']) ? $_SESSION['registered_email'] : '';

// Check if the user came from the login page (avoid direct URL access)
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "user_login.php") === false) {
    redirectToLoginPage();
}

// Function to redirect to the login page
function redirectToLoginPage() {
    header("location: user_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration</title>
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
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
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
        <form method="POST">
            <button name="Logout" class="about_btn" onclick="redirectToIndex()">Log out</button>
        </form>
    </nav>
    <script>
        function redirectToIndex() {
            window.location.href = 'index.php';
        }
    </script>
    <div class="container">
        <h2>Marriage Registration Form</h2>
        <form action="submit_form.php" method="post">
            <label for="registered_email">Registered Email:</label>
            <input type="text" id="registered_email" name="registered_email" value="<?php echo htmlspecialchars($registeredEmail); ?>" readonly><br>

            <label for="fiance_name">Fiance Name (as per Aadhar):</label>
            <input type="text" id="fiance_name" name="fiance_name" minlength="4" required><br>

            <label for="fiance_aadhar">Fiance 12 digit Aadhar Number:</label>
            <input type="number" id="fiance_aadhar" name="fiance_aadhar" minlength="12" required><br>

            <label for="fiance_aadhar_image">Upload Fiance Aadhar Image Link:</label>
            <p>Note:  Please upload a valid Google drive image link and link should be public</p>
            <input type="text" id="fiance_aadhar_image" name="fiance_aadhar_image" required><br>

            <label for="fiancee_name">Fiancee Name (as per Aadhar):</label>
            <input type="text" id="fiancee_name" name="fiancee_name" required><br>

            <label for="fiancee_aadhar">Fiancee 12 digit Aadhar Number:</label>
            <input type="number" id="fiancee_aadhar" name="fiancee_aadhar" minlength="12" required><br>

            <label for="fiancee_aadhar_image">Upload Fiancee Aadhar Image Link:</label>
            <p>Note:  Please upload a valid Google drive image link and link should be public</p>
            <input type="text" id="fiancee_aadhar_image" name="fiancee_aadhar_image" required><br>

            <label for="marriage_photo">Couple Marriage Photo Link:</label>
            <p>Note:  Please upload a valid Google drive image link and link should be public</p>
            <input type="text" id="marriage_photo" name="marriage_photo" required><br>

            <input type="submit" class="btns" value="Submit">  
        </form>
    </div>
</body>
</html>