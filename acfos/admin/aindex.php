<?php
session_start();
include 'dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAMUSTED Campus Online Food Ordering</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('food/bgi.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #6f4f28; /* Brown background */
            padding: 10px;
            color: yellow; /* Yellow text */
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
        }
        .links-container a {
            color: yellow;
            text-decoration: none;
            font-size: 1.2em;
        }
        .links-container a:hover {
            text-decoration: underline;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            grid-template-rows: repeat(2, auto); /* 2 rows */
            grid-gap: 20px;
            padding: 20px;
            justify-content: center;
        }
        .grid-item {
            background: rgba(255, 255, 255, 0.3); /* Glassy effect */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px; /* Fixed width */
            height: 200px; /* Fixed height */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
        .modal-header {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .large-text {
            font-size: 3em;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>
</head>
<body>

<header>
    <img src="food/als.jfif" alt="Logo">
    <div>
        <h1>AAMUSTED CAMPUS ONLINE FOOD ORDERING</h1>
       
    </div>
    <div>
        <button onclick="openModal('loginModal')">Sign In</button>
        <button onclick="openModal('signupModal')">Sign Up</button>
    </div>
</header>

<div class="grid-container">
    <div class="grid-item">
        <img src="food/gbns.jpg" alt="Food 1">
    </div>
    <div class="grid-item">
        <img src="food/jollof.jpg" alt="Food 2">
    </div>
    <div class="grid-item">
        <img src="food/fns.png" alt="Food 3">
    </div>
    <div class="grid-item">
        <img src="food/wkye.jpg" alt="Food 4">
    </div>
    <div class="grid-item">
        <img src="food/bnt.jfif" alt="Food 5">
    </div>
    <div class="grid-item">
        <img src="food/pizza.png" alt="Food 6">
    </div>
</div>

<!-- Login Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Admin Login</div>
        <form method="POST" action="signin.php">
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <button onclick="closeModal('loginModal')">Close</button>
    </div>
</div>

<!-- Signup Modal -->
<div id="signupModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Admin Signup</div>
        <form method="POST" action="signup.php">
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Sign Up">
        </form>
        <button onclick="closeModal('signupModal')">Close</button>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
