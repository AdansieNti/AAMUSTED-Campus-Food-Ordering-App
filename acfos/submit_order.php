<?php
// Start the session
session_start();

// Include database connection
include 'dbconnection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $food_id = $_POST['food_id'];
    $customer_id = $_POST['customer_id'];
    $quantity = $_POST['quantity'];
    $payment_type = $_POST['payment_type'];

    // Validate inputs
    if (empty($food_id) || empty($customer_id) || empty($quantity) || empty($payment_type)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (food_id, customer_id, quantity, payment_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $food_id, $customer_id, $quantity, $payment_type);

    if ($stmt->execute()) {
        echo "Order placed successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
