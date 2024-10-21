<?php
// delete.php

// Database connection details
$host = "localhost";
$user = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "daftar"; // Replace with your database name

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email is set in the GET request
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Prepare the delete query
    $sql = "DELETE FROM seminar WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    // Execute the query
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No email parameter provided.";
}

// Close the database connection
$conn->close();
?>
