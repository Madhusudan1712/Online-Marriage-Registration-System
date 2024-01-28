<?php
session_start();

$registeredEmail = isset($_SESSION['registered_email']) ? $_SESSION['registered_email'] : '';

?>

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
            color: green;
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
            <button name="Logout" class="about_btn">Log out</button>
        </form>
    </nav>
    <script>
        function redirectToIndex() {
            window.location.href = 'index.php';
        }
    </script>
    <div class="container">
        <h2><i class="fa-solid fa-circle-check fa-lg" style="color: #08a679;"></i></h2>
        <h2>Row deleted Successfully form the database</h2>
    </div>
    <?php
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("Location: index.php");
    }
    ?>
</body>
</html>
