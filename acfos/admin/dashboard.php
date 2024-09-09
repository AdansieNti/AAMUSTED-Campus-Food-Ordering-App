<?php
session_start();
include 'dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAMUSTED Campus Online Food Ordering - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('food/bgi.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #6f4f28; /* Brown background */
            padding: 10px;
            color: yellow; /* Yellow text */
            text-align: center;
        }
        header img {
            width: 50px;
            height: 50px;
        }
        h1 {
            font-size: 2.5em;
            margin: 0;
        }
        .links-container {
            display: flex;
            gap: 20px;
            justify-content: center; /* Center the links */
            margin-top: 10px;
        }
        .links-container a {
            color: yellow;
            text-decoration: none;
            font-size: 1.2em;
        }
        .links-container a:hover {
            text-decoration: underline;
        }
        .large-text {
            font-size: 5em; /* Large text for Admin Dashboard */
            font-weight: bold;
            margin-top: 100px; /* Create space from header */
            text-align: center;
            color: yellow;
            text-shadow: 2px 2px #333; /* Slight shadow for better visibility */
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center; /* Center the footer text */
        }
    </style>
</head>
<body>

<header>
    <img src="food/als.jfif" alt="Logo">
    <h1>AAMUSTED CAMPUS ONLINE FOOD ORDERING</h1>
    <div class="links-container">
        <a href="dashboard.php">Home</a>
        <a href="admins.php">Admins</a> <!-- Corrected link -->
        <a href="customers.php">Customers</a>
        <a href="add_food_items.php">Add Food Items</a> <!-- Corrected spelling -->
        <a href="food_items.php">Food Items</a> <!-- Corrected spelling -->
        <a href="orders.php">Orders</a> <!-- Corrected spelling -->
        <a href="aindex.php">Logout</a> <!-- Corrected spelling -->
    </div>
</header>

<!-- Body section with Admin Dashboard -->
<div class="large-text">
    Admin Dashboard
</div>

<?php include 'footer.php'; ?>

</body>
</html>
