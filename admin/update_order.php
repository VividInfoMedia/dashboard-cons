<?php
include 'admin_nav.php';
include 'db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to send email
function sendEmail($to, $subject, $message) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@yourwebsite.com" . "\r\n";

    return mail($to, $subject, $message, $headers);
}

// Handle Confirm and Ship actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $action = $_POST['action'];

    if ($orderId > 0) {
        if ($action === 'confirm') {
            $subject = "Order Confirmation";
            $message = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
                        .header { text-align: center; }
                        .header img { max-width: 150px; }
                        .content { margin-top: 20px; }
                        .btn { display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <img src='https://yourwebsite.com/path-to-logo/logo.png' alt='Logo'>
                            <h2>Order Confirmation</h2>
                        </div>
                        <div class='content'>
                            <p>Thank you for your purchase. Your order has been confirmed!</p>
                            <a class='btn' href='https://yourwebsite.com/orders'>View Your Order</a>
                        </div>
                    </div>
                </body>
                </html>
            ";
            $status = "Confirmed";
        } elseif ($action === 'ship') {
            $subject = "Order Shipped";
            $message = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
                        .header { text-align: center; }
                        .header img { max-width: 150px; }
                        .content { margin-top: 20px; }
                        .btn { display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <img src='https://yourwebsite.com/path-to-logo/logo.png' alt='Logo'>
                            <h2>Order Shipped</h2>
                        </div>
                        <div class='content'>
                            <p>Your order is on its way. Thank you for shopping with us!</p>
                            <a class='btn' href='https://yourwebsite.com/orders'>Track Your Order</a>
                        </div>
                    </div>
                </body>
                </html>
            ";
            $status = "Shipped";
        }

        // Update order status
        $stmt = $conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $orderId);
        $stmt->execute();
        $stmt->close();

        // Fetch customer email
        $stmt = $conn->prepare("SELECT customers.email FROM orders JOIN customers ON orders.customer_id = customers.id WHERE orders.id = ?");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $customerEmail = $row['email'];

        // Send email
        sendEmail($customerEmail, $subject, $message);
    } else {
        echo "Invalid order ID for update action.";
    }
}

// Fetch order details for display
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($orderId > 0) {
    $stmt = $conn->prepare("
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
        WHERE
            orders.id = ?
    ");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        echo "No order found.";
    }
} else {
    // Fetch all orders if no specific order ID is provided
    $stmt = $conn->prepare("
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
        ORDER BY
            orders.created_at DESC
    ");
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Order</title>
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
        .color-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-left: 5px;
        }
        .btn-custom {
            margin-top: 20px;
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 25px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-custom:hover {
            transform: translateY(-3px);
        }
        .btn-confirm {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-confirm:hover {
            background-color: #0056b3;
        }
        .btn-ship {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-ship:hover {
            background-color: #218838;
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
    </style>
</head>
<body>
    <div class="content">
    <h2 class="mb-4">Update Status</h2>
        <?php if (isset($order)): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order ID: <?php echo $order['order_id']; ?></h5>
                    <p><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
                    <p><strong>Mobile:</strong> <?php echo $order['mobile']; ?></p>
                    <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
                    <p><strong>Product Details:</strong>
                        <?php
                        $product_details = $order['product_details'];
                        preg_match_all('/Color: (#[0-9a-fA-F]{6}|rgba?\(\d+,\s*\d+,\s*\d+(,\s*\d*\.?\d+)?\))/', $product_details, $matches);
                        if (!empty($matches[1])) {
                            foreach ($matches[1] as $color_code) {
                                $product_details = str_replace("Color: " . $color_code, "Color: <span class='color-box' style='background-color: " . $color_code . ";'></span>", $product_details);
                            }
                        }
                        echo $product_details;
                        ?>
                    </p>
                    <p><strong>Total Amount:</strong> ₹<?php echo $order['total_amount']; ?></p>
                    <p><strong>Payment Status:</strong> <?php echo ucfirst($order['payment_status']); ?></p>
                    <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
                    <button class="btn btn-custom btn-confirm" id="confirmBtn" data-order-id="<?php echo $order['order_id']; ?>" <?php echo ($order['payment_status'] === 'Confirmed' || $order['payment_status'] === 'Shipped') ? 'disabled' : ''; ?>>Confirm</button>
                    <button class="btn btn-custom btn-ship" id="shipBtn" data-order-id="<?php echo $order['order_id']; ?>" <?php echo ($order['payment_status'] === 'Shipped') ? 'disabled' : ''; ?>>Ship</button>
                </div>
            </div>
        <?php elseif (isset($orders)): ?>
            <!-- <h3>All Orders</h3> -->
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <!-- <th>Email</th> -->
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Product Details</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo $order['customer_name']; ?></td>
                        
                            <td><?php echo $order['mobile']; ?></td>
                            <td><?php echo $order['address']; ?></td>
                            <td>
                                <?php
                                $product_details = $order['product_details'];
                                preg_match_all('/Color: (#[0-9a-fA-F]{6}|rgba?\(\d+,\s*\d+,\s*\d+(,\s*\d*\.?\d+)?\))/', $product_details, $matches);
                                if (!empty($matches[1])) {
                                    foreach ($matches[1] as $color_code) {
                                        $product_details = str_replace("Color: " . $color_code, "Color: <span class='color-box' style='background-color: " . $color_code . ";'></span>", $product_details);
                                    }
                                }
                                echo $product_details;
                                ?>
                            </td>
                            <td>₹<?php echo $order['total_amount']; ?></td>
                            <td><?php echo ucfirst($order['payment_status']); ?></td>
                            <td><?php echo $order['created_at']; ?></td>
                            <td>
                                <button class="btn btn-custom btn-confirm btn-sm confirm-btn" data-order-id="<?php echo $order['order_id']; ?>" <?php echo ($order['payment_status'] === 'Confirmed' || $order['payment_status'] === 'Shipped') ? 'disabled' : ''; ?>>Confirm</button>
                                <button class="btn btn-custom btn-ship btn-sm ship-btn" data-order-id="<?php echo $order['order_id']; ?>" <?php echo ($order['payment_status'] === 'Shipped') ? 'disabled' : ''; ?>>Shipped</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders available.</p>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.confirm-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const orderId = this.getAttribute('data-order-id');
                    fetch('update_order.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'order_id=' + orderId + '&action=confirm'
                    }).then(response => response.text()).then(data => {
                        this.disabled = true;
                        const shipBtn = this.nextElementSibling;
                        if (shipBtn) shipBtn.disabled = false;
                        alert('Order confirmed!');
                    });
                });
            });

            document.querySelectorAll('.ship-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const orderId = this.getAttribute('data-order-id');
                    fetch('update_order.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'order_id=' + orderId + '&action=ship'
                    }).then(response => response.text()).then(data => {
                        this.disabled = true;
                        alert('Order shipped!');
                    });
                });
            });
        });
    </script>
</body>
</html>
