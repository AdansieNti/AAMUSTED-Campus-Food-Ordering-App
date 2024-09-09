<?php
// Include session start and database connection
session_start();
include 'dbconnection.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $available_qty = $_POST['available_qty'];
    $image_path = $_POST['image_path'];

    // Validate input
    if (empty($food_name) || empty($price) || empty($available_qty)) {
        $error = "Please fill all required fields.";
    } else {
        // Prepare SQL query
        $query = "INSERT INTO food_item (food_name, price, description, available_qty, image_path) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("sdsss", $food_name, $price, $description, $available_qty, $image_path);

            if ($stmt->execute()) {
                $success = "Food item added successfully!";
            } else {
                $error = "Error adding food item: " . $stmt->error;
            }
            
            // Close statement
            $stmt->close();
        } else {
            $error = "Error preparing statement: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAMUSTED Campus Online Food Ordering - Add Food Item</title>
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
            justify-content: center;
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
        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 100px auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
            color: red;
        }
        .success {
            color: green;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <img src="food/als.jfif" alt="Logo">
    <h1>AAMUSTED CAMPUS ONLINE FOOD ORDERING</h1>
    <div class="links-container">
        <a href="dashboard.php">Home</a>
        <a href="admins.php">Admins</a>
        <a href="customers.php">Customers</a>
        <a href="add_food_item.php">Add Food Items</a>
        <a href="food_items.php">Food Items</a>
        <a href="orders.php">Orders</a>
        <a href="aindex.php">Logout</a>
    </div>
</header>

<div class="container">
    <h2>Add Food Item</h2>
    <?php if (isset($error)): ?>
        <div class="message"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class="message success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="food_name">Food Name:</label>
        <input type="text" name="food_name" id="food_name" required>
        
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" required>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4"></textarea>
        
        <label for="available_qty">Available Quantity:</label>
        <input type="number" name="available_qty" id="available_qty" required>
        
        <label for="image_path">Image Path:</label>
        <input type="text" name="image_path" id="image_path">
        
        <input type="submit" name="submit" value="Add Food Item">
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
