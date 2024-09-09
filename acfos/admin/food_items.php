<?php
session_start();
include 'dbconnection.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM food_item WHERE food_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM food_item";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Items</title>
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
            background-color: #6f4f28;
            padding: 10px;
            color: yellow;
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
        .search-container {
            margin-top: 20px;
            display: flex;
            justify-content: flex-start;
            padding-left: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            font-size: 1em;
            width: 200px;
        }
        .search-container button {
            padding: 10px;
            font-size: 1em;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
            background-color: white;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #6f4f28;
            color: yellow;
        }
        .edit-btn, .delete-btn {
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            color: white;
            font-weight: bold;
        }
        .edit-btn {
            background-color: blue;
        }
        .delete-btn {
            background-color: red;
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

<!-- Search Form -->
<div class="search-container">
    <form method="get" action="">
        <input type="text" name="search" placeholder="Search food by name" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>
</div>

<!-- Food Items Table -->
<h2 style="text-align: center; color: yellow; margin-top: 20px;">Food Items</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Food Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Available Quantity</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['food_id'] . "</td>";
            echo "<td>" . $row['food_name'] . "</td>";
            echo "<td>₵" . $row['price'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['available_qty'] . "</td>";
            echo "<td><img src='" . $row['image_path'] . "' alt='Food Image' width='50' height='50'></td>";
            echo "<td>
                <form action='edit_food_item.php' method='get' style='display:inline;'>
                    <input type='hidden' name='food_id' value='" . $row['food_id'] . "'>
                    <button type='submit' class='edit-btn'>Edit</button>
                </form>
                <form action='delete_food_item.php' method='post' style='display:inline;'>
                    <input type='hidden' name='food_id' value='" . $row['food_id'] . "'>
                    <button type='submit' class='delete-btn'>Delete</button>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No food items found</td></tr>";
    }
    ?>
</table>

<?php include 'footer.php'; ?>

</body>
</html>
