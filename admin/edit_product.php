<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
require 'db.php';

$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = $id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Image Upload Handling
    $imagePaths = [$product['image1'], $product['image2'], $product['image3']];
    for ($i = 1; $i <= 3; $i++) {
        if (isset($_FILES["image$i"]) && $_FILES["image$i"]["name"] != "") {
            $imageName = $_FILES["image$i"]["name"];
            $imageTmpName = $_FILES["image$i"]["tmp_name"];
            $newImageName = uniqid("product_", true) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);
            $uploadPath = "uploads/" . $newImageName;

            if (move_uploaded_file($imageTmpName, $uploadPath)) {
                $imagePaths[$i - 1] = $uploadPath;
            }
        }
    }

    // Update database
    $query = "UPDATE products SET
                brand_name='$brand_name', name='$name', category='$category', description='$description',
                image1='{$imagePaths[0]}', image2='{$imagePaths[1]}', image3='{$imagePaths[2]}'
              WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product Updated Successfully!'); window.location.href='view_products.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            font-size: 16px;
            padding: 10px;
        }
        .btn-primary {
            width: 100%;
            font-size: 18px;
            padding: 10px;
        }
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4">Edit Product</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" value="<?= htmlspecialchars($product['brand_name']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <h5 class="mt-3">Product Images</h5>
                <div class="row g-3">
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <div class="col-6">
                            <label class="form-label">Image <?= $i ?></label>
                            <input type="file" name="image<?= $i ?>" class="form-control">
                            <?php if (!empty($product["image$i"])): ?>
                                <img src="<?= htmlspecialchars($product["image$i"]) ?>" class="image-preview">
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>
