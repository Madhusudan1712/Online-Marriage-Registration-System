<?php
session_start();

// Connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your actual database password
$dbname = "marriage_registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if Aadhar number already exists in the database
function isAadharExists($aadharNumber, $conn) {
    $query = "SELECT id FROM registration_form_data WHERE fianceAadharNumber = ? OR fianceeAadharNumber = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $aadharNumber, $aadharNumber);
    $stmt->execute();
    $stmt->store_result();
    $result = $stmt->num_rows > 0;
    $stmt->close();
    return $result;
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $registrationDate = $_POST["registrationDate"];
    $registeredEmail = $_POST["registeredEmail"];
    $fianceName = $_POST["fianceName"];
    $fianceAadharNumber = $_POST["fianceAadharNumber"];
    // Assuming this is the base64-encoded image data
    $fianceAadharImage = $_POST["fianceAadharImage"];
    $fianceeName = $_POST["fianceeName"];
    $fianceeAadharNumber = $_POST["fianceeAadharNumber"];
    // Assuming this is the base64-encoded image data
    $fianceeAadharImage = $_POST["fianceeAadharImage"];
    // Assuming this is the base64-encoded image data
    $marriagePhoto = $_POST["marriagePhoto"];

    // Check if Aadhar numbers are unique
    $isFianceAadharExists = isAadharExists($fianceAadharNumber, $conn);
    $isFianceeAadharExists = isAadharExists($fianceeAadharNumber, $conn);

    if (!$isFianceAadharExists && !$isFianceeAadharExists) {
        // Aadhar numbers are unique, insert into the database
        $query = "INSERT INTO registration_form_data (registrationDate, registeredEmail, fianceName, fianceAadharNumber, fianceAadharImage, fianceeName, fianceeAadharNumber, fianceeAadharImage, marriagePhoto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $registrationDate, $registeredEmail, $fianceName, $fianceAadharNumber, $fianceAadharImage, $fianceeName, $fianceeAadharNumber, $fianceeAadharImage, $marriagePhoto);

        if ($stmt->execute()) {
            echo "Form submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif ($isFianceAadharExists && $isFianceeAadharExists) {
        // Both Aadhar numbers already exist
        echo "Both Aadhar numbers already exist. Please provide different ones.";
    } else {
        // One of the Aadhar numbers already exists
        echo "One Aadhar number is already in use. Please provide a different one.";
    }
}

// Close the connection
$conn->close();

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
        <!-- <form method="POST">
            <button name="Logout" class="about_btn">Log out</button>
        </form> -->
    </nav>
    <script>
        function redirectToIndex() {
            window.location.href = 'index.php';
        }
    </script>
    <div class="container">
        <h2>Marriage Registration Form</h2>

        <form action="#" method="post" enctype="multipart/form-data" onsubmit=" return showSuccessMessage()">

            <!-- Date (Automatically taken) -->
            <label for="registrationDate"> Registration Date:</label>
            <input type="text" id="registrationDate" name="registrationDate" value="<?php echo date('Y-m-d'); ?>" readonly>

            <!-- Registered Email -->
            <label for="registeredEmail">Registered Email:</label>
            <input type="email" id="registeredEmail" name="registeredEmail" value="<?php echo htmlspecialchars($registeredEmail); ?>" readonly>


            <!-- Fiance Name as per Aadhar -->
            <label for="fianceName">Fiance Name as per Aadhar:</label>
            <input type="text" id="fianceName" name="fianceName" minlength="4" required>

            <!-- Fiance Aadhar Number -->
            <label for="fianceAadharNumber">Fiance Aadhar Number:</label>
            <input  type="text" id="fianceAadharNumber" name="fianceAadharNumber" pattern="[0-9]{12}" required>

            <!-- Upload Fiance Aadhar Image -->
            <label for="fianceAadharImage">Upload Fiance Aadhar Image:</label>
            <input type="file" id="fianceAadharImage" name="fianceAadharImage" accept="image/*" required>

            <!-- Fiancee Name as per Aadhar -->
            <label for="fianceeName">Fiancee Name as per Aadhar:</label>
            <input type="text" id="fianceeName" name="fianceeName" minlength="4" required>

            <!-- Fiancee Aadhar Number -->
            <label for="fianceeAadharNumber">Fiancee Aadhar Number:</label>
            <input type="text" id="fianceeAadharNumber" name="fianceeAadharNumber" pattern="[0-9]{12}" required>

            <!-- Upload Fiancee Aadhar Image -->
            <label for="fianceeAadharImage">Upload Fiancee Aadhar Image:</label>
            <input type="file" id="fianceeAadharImage" name="fianceeAadharImage" accept="image/*" required>

            <!-- Couple Marriage Photo -->
            <label for="marriagePhoto">Couple Marriage Photo:</label>
            <input type="file" id="marriagePhoto" name="marriagePhoto" accept="image/*" required>

            <p>Note:<br>If above provided details seems false your registration will be canceled automatically.</p>

            <!-- Submit Button -->
            <input type="submit" class="btns" value="Submit">

        </form>
    </div>
    <script>
        // Function to display success message
        function showSuccessMessage() {
            // Make sure the PHP variable $registeredEmail is defined and has the correct value
            var registeredEmail = "<?php echo $registeredEmail; ?>";

            alert("Registration successful!\nYour certificate will be sent to your registered email >> " + registeredEmail + " in a few days.");
            window.location.href = 'user_login.php';
            return false;
        }
    </script>

</body>
</html>