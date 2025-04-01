<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
require 'db.php';

// Fetch products
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 250px;
            background: #212529;
            color: white;
            padding: 20px;
            transition: 0.3s;
            position: fixed;
            height: 100%;
            left: -250px;
            top: 0;
            z-index: 1000;
        }
        .sidebar.active {
            left: 0;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            padding: 12px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
        }
        .sidebar a:hover {
            background: #343a40;
        }
        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            width: 100%;
            transition: margin-left 0.3s;
        }
        .menu-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 15px;
            background: #212529;
            color: white;
            font-size: 24px;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1100;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 20px;
            text-align: center;
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
        }
        @media (min-width: 769px) {
            .sidebar {
                left: 0;
            }
            .menu-toggle {
                display: none;
            }
            .content {
                margin-left: 250px;
            }
        }
        @media (max-width: 769px) {
            .intro {
                margin-top: 40px !important;
            }
        }
        @media (max-width: 769px) {
            .table-responsive {
                overflow-x: auto;
                display: block;
                white-space: nowrap;
            }
            .table {
                font-size: 12px;
            }
            .table th, .table td {
                padding: 8px;
                text-align: center;
                vertical-align: middle;
            }
            .table img {
                width: 40px;
                height: 40px;
                object-fit: cover;
            }
            .btn-sm {
                font-size: 12px;
                padding: 5px 8px;
            }
        }
    </style>
</head>
<body>
<button class="menu-toggle"><i class="fas fa-bars"></i></button>
    <div class="sidebar">
        <br>
        <h4 class="intro">Admin Panel</h4>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="add_product.php"><i class="fas fa-plus-circle"></i> Add Product</a>
        <a href="view_products.php"><i class="fas fa-box-open"></i> View Products</a>
 
        <a href="customers.php"><i class="fas fa-users"></i> Customers</a>
        <a href="logout.php" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="content">
        <div class="container mt-2">
            <h2 class="mb-4">Product List</h2>
            <table class="table table-bordered table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Brand Name</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Images</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['brand_name']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['category']) ?></td>
                            <td>
                                <?php for ($i = 1; $i <= 3; $i++):
                                    if (!empty($row["image$i"])): ?>
                                        <img src="<?= htmlspecialchars($row["image$i"]) ?>" width="50" height="50">
                                    <?php endif; endfor; ?>
                            </td>
                            <td>
                                <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="delete_product.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.querySelector(".menu-toggle").addEventListener("click", function() {
            document.querySelector(".sidebar").classList.toggle("active");
        });
    </script>
</body>
</html>
