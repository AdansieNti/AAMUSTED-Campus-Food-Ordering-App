<?php
session_start();
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customer_id'];

    // Validate the input
    if (empty($customerId)) {
        die("Invalid customer ID.");
    }

    // Prepare the SQL statement to delete the customer
    $sql = "DELETE FROM customer WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerId);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the customer list with success message
        $_SESSION['message'] = "Customer deleted successfully.";
        header("Location: customers.php");
        exit();
    } else {
        echo "Error deleting customer: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
