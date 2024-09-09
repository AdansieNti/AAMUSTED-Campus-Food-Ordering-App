<?php
session_start();
include '../dbconnection.php'; // Adjust the path based on your folder structure

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the user exists and password matches
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username; // Storing session for the logged-in admin
        header('Location: ./dashboard.php'); // Redirect to admin home or dashboard page
        exit();
    } else {
        echo "<script>alert('Invalid username or password'); window.history.back();</script>";
    }
}
?>
