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

// Include your database connection file
include 'db_connection_for_admin.php';

// Fetch data from the database
$query = "SELECT * FROM registration_form_data";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    /* Header Styles */
    header {
        color: black;
        padding: 1em;
        text-align: center;
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        overflow-x: auto; /* Add this property */
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        white-space: nowrap; /* Prevent text wrapping */
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* Table Row Styles */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Link Styles */
    a {
        text-decoration: none;
        color: #3498db;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 600px) {
        th, td {
            font-size: 12px; /* Adjust font size for small screens */
        }
    }
</style>
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

    <header>
        <h1>Marriage Registration Data</h1>
    </header>

    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Registered Email</th>
            <th>Fiance Name</th>
            <th>Fiance Aadhar</th>
            <th>Fiance Aadhar Image</th>
            <th>Fiancee Name</th>
            <th>Fiancee Aadhar</th>
            <th>Fiancee Aadhar Image</th>
            <th>Marriage Photo</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['registered_email'] ?></td>
                <td><?= $row['fiance_name'] ?></td>
                <td><?= $row['fiance_aadhar'] ?></td>
                <td><?= $row['fiance_aadhar_image'] ?></td>
                <td><?= $row['fiancee_name'] ?></td>
                <td><?= $row['fiancee_aadhar'] ?></td>
                <td><?= $row['fiancee_aadhar_image'] ?></td>
                <td><?= $row['marriage_photo'] ?></td>
                <td><a href='delete.php?id=<?= $row['id'] ?>'>Delete</a></td>
            </tr>
        <?php endwhile; ?>

    </table>

    <?php
        // Close the database connection
        mysqli_close($conn);
    ?>

    <?php
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("Location: index.php");
    }
    ?>
</body>
</html>
