<?php
session_start();
include 'dbconnection.php';

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $sql = "SELECT * FROM order_table WHERE order_id LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM order_table";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Records</title>
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
            text-align: left;
            margin: 20px;
        }
        .search-container input[type="text"] {
            padding: 5px;
            font-size: 1em;
        }
        .search-container input[type="submit"] {
            padding: 5px 10px;
            font-size: 1em;
            background-color: #6f4f28;
            color: yellow;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: white;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
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

<h2 style="text-align: center; color: yellow;">Order Records</h2>

<div class="search-container">
    <form method="get" action="orders.php">
        <input type="text" name="search" placeholder="Search by Order ID" value="<?php echo $search_query; ?>">
        <input type="submit" value="Search">
    </form>
</div>

<table>
    <tr>
        <th>Order ID</th>
        <th>Customer ID</th>
        <th>Food ID</th>
        <th>Quantity</th>
        <th>Payment Type</th>
        <th>Status</th>
        <th>Order Date</th>
        <th>Total Amount</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['food_id'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['payment_type'] . "</td>";
            echo "<td>" . $row['order_status'] . "</td>";
            echo "<td>" . $row['order_date'] . "</td>";
            echo "<td>" . $row['total_amount'] . "</td>";
            echo "<td>
                <form action='edit_order.php' method='get' style='display:inline;'>
                    <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                    <button type='submit' class='edit-btn'>Edit</button>
                </form>
                <form action='delete_order.php' method='post' style='display:inline;'>
                    <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                    <button type='submit' class='delete-btn'>Delete</button>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No records found</td></tr>";
    }
    ?>
</table>

<?php include 'footer.php'; ?>

</body>
</html>
