<?php
session_start();
include 'dbconnection.php';

$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $sql = "SELECT * FROM customer WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM customer";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Records</title>
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
            display: flex;
            justify-content: flex-start;
            margin: 20px 0;
        }
        .search-container input {
            padding: 10px;
            font-size: 1.2em;
            margin-right: 10px;
        }
        .search-container button {
            padding: 10px;
            font-size: 1.2em;
            background-color: yellow;
            color: #6f4f28;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    <form action="customers.php" method="get">
        <input type="text" name="search" placeholder="Search by Customer ID" value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<!-- Customer Records Table -->
<h2 style="text-align: center; color: yellow;">Customer Records</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Username</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>
                <form action='edit_customer.php' method='get' style='display:inline;'>
                    <input type='hidden' name='customer_id' value='" . $row['customer_id'] . "'>
                    <button type='submit' class='edit-btn'>Edit</button>
                </form>
                <form action='delete_customer.php' method='post' style='display:inline;'>
                    <input type='hidden' name='customer_id' value='" . $row['customer_id'] . "'>
                    <button type='submit' class='delete-btn'>Delete</button>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
    ?>
</table>

<?php include 'footer.php'; ?>

</body>
</html>
