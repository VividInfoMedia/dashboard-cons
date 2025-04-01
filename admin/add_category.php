<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    $image = $_FILES['category_image'];

    // Define the upload directory and allowed file types
    $uploadDir = 'uploads/';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Check if the uploaded file is an image and its type is allowed
    if (in_array($image['type'], $allowedTypes)) {
        // Generate a unique name for the image
        $imageName = uniqid() . '_' . $image['name'];
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Prepare and execute the SQL query to insert the category and image path
            $sql = "INSERT INTO categories (name, image_path) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $category_name, $imagePath);

            if ($stmt->execute()) {
                // Output a script to show an alert and then redirect
                echo "<script>
                        alert('New category created successfully!');
                        window.location.href = 'add_product.php';
                      </script>";
                exit(); // Ensure the script stops executing after the redirect
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: Failed to move uploaded file.";
        }
    } else {
        echo "Error: Invalid file type. Only JPEG, PNG, and GIF images are allowed.";
    }

    $conn->close();
}
?>
