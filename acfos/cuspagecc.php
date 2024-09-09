<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming session is started after customer logs in
session_start();

// Check if customer_name is set in session
if (isset($_SESSION['customer_name'])) {
    $customer_name = $_SESSION['customer_name']; // Customer name is set after login
} else {
    // Redirect to login page if session variable is not set
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            padding: 20px;
        }
        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #f0f0f0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        .circle img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .circle:hover {
            background-color: #e0e0e0;
        }
        .food-name {
            margin-top: 10px;
            font-weight: bold;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Welcome, <?php echo htmlspecialchars($customer_name); ?>! Order Your Favorite Food</h1>

    <div class="grid-container">
        <?php
        // Assuming food items are fetched from the database
        include 'dbconnection.php';

        // Check if the database connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT food_id, food_name, image_path FROM food_item LIMIT 12";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $food_id = $row['food_id'];
                $food_name = $row['food_name'];
                $image_path = $row['image_path'];
                ?>
                <div class="circle" onclick="openModal(<?php echo $food_id; ?>, '<?php echo htmlspecialchars($food_name); ?>')">
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($food_name); ?>">
                    <div class="food-name"><?php echo htmlspecialchars($food_name); ?></div>
                </div>
                <?php
            }
        } else {
            echo "No food items found.";
        }
        ?>
    </div>

    <!-- Modal Structure -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Order Form</h2>
            <form method="POST" action="submit_order.php">
                <input type="hidden" id="food_id" name="food_id">

                <label for="food_name">Food Name:</label>
                <input type="text" id="food_name" name="food_name" readonly><br><br>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required><br><br>

                <label for="payment_type">Payment Type:</label>
                <select id="payment_type" name="payment_type" required>
                    <option value="MOMO">MOMO</option>
                    <option value="COD">COD</option>
                </select><br><br>

                <input type="submit" value="Place Order">
            </form>
        </div>
    </div>

    <script>
        // Open Modal with pre-filled data
        function openModal(foodId, foodName) {
            document.getElementById('food_id').value = foodId;
            document.getElementById('food_name').value = foodName;
            document.getElementById('orderModal').style.display = "block";
        }

        // Close Modal
        function closeModal() {
            document.getElementById('orderModal').style.display = "none";
        }

        // Close modal if user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('orderModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
