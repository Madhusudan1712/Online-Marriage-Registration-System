<?php
// Include your database connection file
include 'db_connection_for_admin.php';

// Check if ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the row with the specified ID
    $query = "DELETE FROM registration_form_data WHERE id = $id";
    mysqli_query($conn, $query);
}

// // Redirect back to the admin_process.php page
header("Location: delete_success.php");
exit();
?>
