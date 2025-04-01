<?php
include 'admin_nav.php';

// Correct the path to db.php if it's in the same directory
include 'db.php';

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the payment status filter
$paymentStatus = isset($_GET['payment_status']) ? $_GET['payment_status'] : '';

// Build the SQL query based on the payment status filter
$sql = "
    SELECT
        orders.id AS order_id,
        orders.product_id,
        orders.quantity,
        orders.offer_price,
        orders.selected_colors,
        orders.created_at,
        orders.product_details,
        orders.total_amount,
        orders.payment_status,
        customers.name AS customer_name,
        customers.email,
        customers.mobile,
        customers.address,
        customers.door_number,
        customers.street,
        customers.pincode
    FROM
        orders
    JOIN
        customers ON orders.customer_id = customers.id
";

// Add the WHERE clause if a payment status is selected
if ($paymentStatus) {
    $sql .= " WHERE orders.payment_status = ?";
}

$sql .= " ORDER BY orders.created_at DESC";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
if ($paymentStatus) {
    $stmt->bind_param("s", $paymentStatus);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Orders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
          body {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: #f4f4f4;
        }
        .content {
            padding: 20px;
        }

        .table-responsive {
            margin-top: 20px;
        }
        .color-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-left: 5px;
        }
        .btn-primary {
            margin-top: 20px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            padding: 12px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500 ;
        }
       
        .form-group{
            width: 180px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2 >View Orders</h2>
        <form method="GET" action="">
            <div class="form-group">
                <!-- <label for="payment_status">Payment Status:</label> -->
                <select name="payment_status" id="payment_status" class="form-control" onchange="this.form.submit()">
                    <option value="" <?php if (!$paymentStatus) echo 'selected'; ?>>Payment Status</option>
                    <option value="paid" <?php if ($paymentStatus === 'paid') echo 'selected'; ?>>Paid</option>
                    <option value="pending" <?php if ($paymentStatus === 'pending') echo 'selected'; ?>>Pending</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Product Details</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['customer_name']; ?></td>
                                <td><?php echo $row['mobile']; ?></td>
                                <td>
                                    <?php echo $row['address']; ?>
                                </td>
                                <td>
                                    <?php
                                    // Extract and replace all color codes with color boxes
                                    $product_details = $row['product_details'];
                                    preg_match_all('/Color: (#[0-9a-fA-F]{6}|rgba?\(\d+,\s*\d+,\s*\d+(,\s*\d*\.?\d+)?\))/', $product_details, $matches);
                                    if (!empty($matches[1])) {
                                        foreach ($matches[1] as $color_code) {
                                            $product_details = str_replace("Color: " . $color_code, "Color: <span class='color-box' style='background-color: " . $color_code . ";'></span>", $product_details);
                                        }
                                    }
                                    echo $product_details;
                                    ?>
                                </td>
                                <td>₹<?php echo $row['total_amount']; ?></td>
                                <td><?php echo ucfirst($row['payment_status']); ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
    </div>
</body>
</html>
