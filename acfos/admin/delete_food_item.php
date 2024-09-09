<?php
session_start();
include 'dbconnection.php';

if (isset($_POST['food_id'])) {
    $food_id = $_POST['food_id'];
    
    // SQL query to delete the food item
    $sql = "DELETE FROM food_item WHERE food_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $food_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Food item deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting food item.";
    }

    $stmt->close();
}

header('Location: food_items.php');
?>
