<?php
session_start();
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['food_id'])) {
    $food_id = $conn->real_escape_string($_GET['food_id']);

    $sql = "SELECT * FROM food_item WHERE food_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $food_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $food_item = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_id = $conn->real_escape_string($_POST['food_id']);
    $food_name = $conn->real_escape_string($_POST['food_name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);
    $available_qty = $conn->real_escape_string($_POST['available_qty']);

    $sql = "UPDATE food_item SET food_name = ?, price = ?, description = ?, available_qty = ? WHERE food_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $food_name, $price, $description, $available_qty, $food_id);

    if ($stmt->execute()) {
        header("Location: food_items.php?message=updated");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food Item</title>
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
        textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
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
    <h2>Edit Food Item</h2>
    <form action="edit_food_item.php" method="post">
        <input type="hidden" name="food_id" value="<?php echo htmlspecialchars($food_item['food_id']); ?>">
        <label for="food_name">Food Name:</label>
        <input type="text" name="food_name" id="food_name" value="<?php echo htmlspecialchars($food_item['food_name']); ?>" required>
        
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="<?php echo htmlspecialchars($food_item['price']); ?>" required>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($food_item['description']); ?></textarea>
        
        <label for="available_qty">Available Quantity:</label>
        <input type="number" name="available_qty" id="available_qty" value="<?php echo htmlspecialchars($food_item['available_qty']); ?>" required>
        
        <button type="submit">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
