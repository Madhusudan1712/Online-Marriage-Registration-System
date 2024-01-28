<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marriage_registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$registered_email = $_POST['registered_email'];
$fiance_name = $_POST['fiance_name'];
$fiance_aadhar = $_POST['fiance_aadhar'];
$fiance_aadhar_image = $_POST['fiance_aadhar_image'];
$fiancee_name = $_POST['fiancee_name'];
$fiancee_aadhar = $_POST['fiancee_aadhar'];
$fiancee_aadhar_image = $_POST['fiancee_aadhar_image'];
$marriage_photo = $_POST['marriage_photo'];

// Check if both Aadhar numbers are unique
$query = "SELECT * FROM registration_form_data WHERE fiance_aadhar = '$fiance_aadhar' OR fiancee_aadhar = '$fiancee_aadhar'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Aadhar numbers already exist
    // echo "alert('One Aadhar number is already exist. Please provide different one.');";
    header("Location: form_failure.php?message=One Aadhar number is already exist. Please provide different one.");
} else {
    // Insert data into the database
    $sql = "INSERT INTO registration_form_data (date, registered_email, fiance_name, fiance_aadhar, fiance_aadhar_image, fiancee_name, fiancee_aadhar, fiancee_aadhar_image, marriage_photo) VALUES (NOW(), '$registered_email', '$fiance_name', '$fiance_aadhar', '$fiance_aadhar_image', '$fiancee_name', '$fiancee_aadhar', '$fiancee_aadhar_image', '$marriage_photo')";

    if ($conn->query($sql) === TRUE) {
        // echo "alert('Form submitted successfully.');";
        header("Location: form_success.php?message=Form submitted successfully, Your certificate will be sent to your registered email.");
    } else {
        echo "alert('Error: " . $sql . "<br>" . $conn->error . "');";
    }
}

// Close connection
$conn->close();
?>
