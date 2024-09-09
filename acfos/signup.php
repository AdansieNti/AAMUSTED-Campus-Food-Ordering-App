<?php
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];
    $phone = $_POST['contact'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO customer (full_name, username, password, email, phone) VALUES (?, ?, ?, ?, ?)");

    // Check if the prepare() was successful
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssss", $full_name, $username, $password, $email, $phone);
        
        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php"); // Redirect on success
            exit(); // Make sure to exit after header redirection
        } else {
            echo "Signup failed. Please try again.";
        }
    } else {
        // If prepare() fails, show error
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
