<?php
include "include/connection.php"; // Include your database connection file

// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Ensure the required fields are submitted
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'])) {
    // Sanitize and validate input
    $logged_in_username = mysqli_real_escape_string($con, $_SESSION['username']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Update the user details in the database based on the logged-in username
    $update_query = "UPDATE rexregister SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE username = '$logged_in_username'";
    $update_result = mysqli_query($con, $update_query);

    // Check if the update was successful
    if ($update_result) {
        // Redirect to the user details page after updating
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating user details: " . mysqli_error($con);
    }
} else {
    echo "Invalid form submission";
}

// Close the database connection
mysqli_close($con);
?>
