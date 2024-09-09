<?php
// Assuming session is started after customer logs in
session_start();
$customer_id = $_SESSION['customer_id']; // Ensure this is set when the user logs in
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
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: brown;
            color: yellow;
            padding: 10px 20px;
        }
        .header img {
            height: 50px;
        }
        .header a {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            padding: 20px;
        }
        .circle {
            width: 300px; /* Increased width */
            height: 300px; /* Increased height */
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
            width: 250px; /* Increased width */
            height: 250px; /* Increased height */
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
        /* Footer Styles */
        .footer {
            background-color: brown;
            color: yellow;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="food/als.jfif" alt="Logo">
        <h1>AAMSTED CAMPUS FOOD ORDERING SYSTEM</h1>
        <a href="index.php">Logout</a>
    </div>

    <h3>Welcome Customer, Order Your Favorite Food</h3>

    <div class="grid-container">
        <?php
        // Assuming food items are fetched from the database
        include 'dbconnection.php';
        $query = "SELECT food_id, food_name, image_path FROM food_item LIMIT 12";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $food_id = $row['food_id'];
                $food_name = $row['food_name'];
                $image_path = $row['image_path'];
                ?>
                <div class="circle" onclick="openModal(<?php echo $food_id; ?>, '<?php echo $food_name; ?>')">
                    <img src="<?php echo $image_path; ?>" alt="<?php echo $food_name; ?>">
                    <div class="food-name"><?php echo $food_name; ?></div>
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
                <input type="hidden" id="food_name" name="food_name">
                <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>">

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

    <?php include 'footer.php'; ?>

</body>
</html>
