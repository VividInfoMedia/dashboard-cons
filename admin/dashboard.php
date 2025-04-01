<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
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
            background: #f8f9fa;
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
            .intro{
                margin-top: 40px !important;
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
        <!-- <a href="edit_product.php"><i class="fas fa-edit"></i> Edit Product</a> -->
        <a href="view_products.php"><i class="fas fa-box-open"></i> View Products</a>
        
        <a href="customers.php"><i class="fas fa-users"></i> Customers</a>
        <a href="logout.php" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="content">
    <br>
        <h2 class="intro">Welcome</h2><br>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="card bg-primary text-white">
                    <h3>50</h3>
                    <p>Total Products</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card bg-success text-white">
                    <h3>120</h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card bg-warning text-dark">
                    <h3>₹1,00,000</h3>
                    <p>Total Revenue</p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.querySelector(".menu-toggle").addEventListener("click", function() {
            document.querySelector(".sidebar").classList.toggle("active");
        });
    </script>
</body>
</html>
