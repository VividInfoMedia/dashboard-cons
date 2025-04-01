
<?php
include 'db.php';

$sql = "SELECT name FROM categories";
$result = $conn->query($sql);
?>



<?php
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            position: fixed;
            height: 100%;
            left: -250px;
            top: 0;
            transition: 0.3s;
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
            font-weight: 500 ;
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
        .intro {
            font-weight: bold !important;
                margin-top: 0px !important;
                margin-bottom: 40px !important;
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
        
        body {
            background-color: #f4f4f4;
            /* font-family: 'Poppins', sans-serif; */
        }
        .container {
            max-width: 70%;
            margin: 25px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: 600;
        }
        .color-boxes {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .color-box {
            width: 40px; height: 40px;
            cursor: pointer;
            border: 3px solid transparent;
            border-radius: 5px;
        }
        .color-box.selected {
            outline: 3px solid black; /* White outline */
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.8); /* Glow effect */
            border-radius: 5px; /* Smooth corners */
        }
        .btn-custom {   
            background: #28a745;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #218838;
        }
        .form-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
  .color-boxes {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .color-box {
        width: 30px;
        height: 30px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: 0.2s;
    }
    .color-box.selected {
        border: 2px solid #000;
    }

  @media (max-width: 768px) {
    .container {
            max-width: 100%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    .form-container {
      grid-template-columns: 1fr; /* Single column for mobile */
    }
  }

        </style>
    
<body>
    
    <button class="menu-toggle"><i class="fas fa-bars"></i></button>
    <div class="sidebar">
        <br>
        <h4 class="inro">Admin Panel</h4>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="add_product.php"><i class="fas fa-plus-circle"></i> Add Product</a>
        <!-- <a href="edit_product.php"><i class="fas fa-edit"></i> Edit Product</a> -->
        <a href="view_products.php"><i class="fas fa-box-open"></i> View Products</a>
        
        <a href="customers.php"><i class="fas fa-users"></i> Customers</a>
        <a href="logout.php" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="content">
    <div class="container">
    <form action="product_update.php" method="POST" enctype="multipart/form-data">
        <div class="row">
        <h2 class="text-center intro">Add Product</h2>
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Brand Name</label>
                    <input type="text" class="form-control" name="Brand_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select class="form-control" name="category" required>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        echo "<option value=''>No categories available</option>";
    }
    ?>
</select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>   
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                

                <!-- Separate File Upload Inputs for 5 Images -->
                <div class="mb-3">
                    <label class="form-label">Upload Image 1</label>
                    <input type="file" class="form-control" name="image1" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image 2</label>
                    <input type="file" class="form-control" name="image2" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image 3</label>
                    <input type="file" class="form-control" name="image3" accept="image/*" required>
                </div>
              
                
            </div>
        </div>

        <div class="text-center">
            <br>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>

    <br>
    <br><br>
    
    <form action="add_category.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3 col-md-6">
        <label class="form-label">Add New Category</label>
        <input type="text" class="form-control" name="category_name" required>
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Category Image</label>
        <input type="file" class="form-control" name="category_image" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>

</div>


    </div> 


  


    <script>
        document.querySelector(".menu-toggle").addEventListener("click", function() {
            document.querySelector(".sidebar").classList.toggle("active");
        });
    </script>
</body>
</html>
