<?php
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];

    // SQL to delete a record
    $sql = "DELETE FROM order_table WHERE order_id = ?";

    // Prepare and bind
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $order_id);

        if ($stmt->execute()) {
            echo "<script>alert('Order deleted successfully'); window.location.href='orders.php';</script>";
        } else {
            echo "<script>alert('Error deleting order'); window.location.href='orders.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing query'); window.location.href='orders.php';</script>";
    }
}
$conn->close();
?>
