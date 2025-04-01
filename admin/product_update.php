<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand_name = $_POST['Brand_name'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Handle file uploads
    $image1 = uploadFile('image1');
    $image2 = uploadFile('image2');
    $image3 = uploadFile('image3');

    $sql = "INSERT INTO products (brand_name, name, category, description, image1, image2, image3)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $brand_name, $name, $category, $description, $image1, $image2, $image3);

    if ($stmt->execute()) {
        echo "<script>
        alert('Product added successfully!');
        window.location.href = 'add_product.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function uploadFile($fileInputName) {
    $target_dir = "uploads/";
    $originalFileName = basename($_FILES[$fileInputName]["name"]);
    $target_file = $target_dir . $originalFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES[$fileInputName]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    $fileCounter = 1;
    $fileBaseName = pathinfo($originalFileName, PATHINFO_FILENAME);
    while (file_exists($target_file)) {
        $target_file = $target_dir . $fileBaseName . "_" . $fileCounter . "." . $imageFileType;
        $fileCounter++;
    }

    if ($_FILES[$fileInputName]["size"] > 300000) {
        echo "Sorry, your file is too large. Maximum size allowed is 300KB.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return "";
}
?>
