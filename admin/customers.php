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

// Fetch customer details
$sql = "
    SELECT
        id,
        name,
        email,
        mobile,
        address,
        door_number,
        street,
        pincode,
        created_at
    FROM
        customers
    ORDER BY
        created_at DESC
";

$result = $conn->query($sql);
$customers = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer List</title>
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
        <h2>Customers</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                     
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo $customer['id']; ?></td>
                            <td><?php echo $customer['name']; ?></td>
                            <td><?php echo $customer['email']; ?></td>
                            <td><?php echo $customer['mobile']; ?></td>
                            <td><?php echo $customer['address']; ?></td>
                   
                            <td><?php echo $customer['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
