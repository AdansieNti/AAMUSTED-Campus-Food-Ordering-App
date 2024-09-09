<?php
session_start();
include 'dbconnection.php'; // Adjust the path based on your folder structure

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the username already exists
    $check_query = "SELECT * FROM admin WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username already exists. Please choose another one.'); window.history.back();</script>";
    } else {
        // Insert new admin data
        $query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['admin'] = $username; // Auto-login after signup
            header('Location: aindex.php'); // Redirect to admin home or dashboard page in the same folder
            exit();
        } else {
            echo "<script>alert('Signup failed. Please try again.'); window.history.back();</script>";
        }
    }
}
?>
