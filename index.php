<?php
// Include the database connection file
include 'admin/db.php';
// Fetch categories and count products for each category
$sql = "SELECT c.name AS category_name, COUNT(p.id) AS product_count, c.image_path
FROM categories c
LEFT JOIN products p ON c.name = p.category
GROUP BY c.name, c.image_path
";
$result = $conn->query($sql);
?>
<!DOCTYPE html> 
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <title>Naanayan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.html" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="js/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  
    <style>
    .product-box {
        display: flex;
        flex-direction: column;
        height: 100%;
        border-radius: 10px;

        
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .product-img-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        height: 350px; /* Adjust height as needed */
        position: relative;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the container */
        border-top-left-radius: 10px; /* Apply radius to top-left corner */
        border-top-right-radius: 10px; /* Apply radius to top-right corner */
        
    }

    .product-action {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .product-action .btn {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
    }

    .product-action .btn:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

        .text-primaryy{
            color:#C00000;
        }
        .btn-primaryy{
            color: white;
            font-weight: 500;
            background-color: #CC1D1D !important;
        }
    </style>
</head>
<body>
    <?php include "nav.php" ?>
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/banner/steel.webp" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">STEEL
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Unbreakable Strength,
                                        Unmatched Quality – Build with the Best Steel!</p>
                                    <a class="btn btn-primaryy py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Enquire</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/banner/paints.jpg"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">PAINTS
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Splash Your World with
                                        Colors that Last – Superior Paints for Every Wall!</p>
                                    <a class="btn btn-primaryy py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Enquire</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/banner/cement.jpg"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">CEMENT
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">The Foundation of Your
                                        Dreams Starts with Our Premium Cement!</p>
                                    <a class="btn btn-primaryy py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Enquire</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/banner/jcp.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Earth Movers</h3>
                        <a href="#" class="btn btn-primaryy">Enquire</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/banner/bricks.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Bricks</h3>
                        <a href="#" class="btn btn-primaryy">Enquire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Featured Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-3">
                <div class="d-flex align-items-center bg-light"
                    style="padding: 20px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);">
                    <i class="fa fa-check text-primaryy mr-3" style="font-size: 1.5rem;"></i>
                    <h5 class="mb-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-3">
                <div class="d-flex align-items-center bg-light"
                    style="padding: 20px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);">
                    <i class="fa fa-shipping-fast text-primaryy mr-3" style="font-size: 1.5rem;"></i>
                    <h5 class="mb-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-3">
                <div class="d-flex align-items-center bg-light"
                    style="padding: 20px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-exchange-alt text-primaryy mr-3" style="font-size: 1.5rem;"></i>
                    <h5 class="mb-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-3">
                <div class="d-flex align-items-center bg-light"
                    style="padding: 20px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);">
                    <i class="fa fa-phone-volume text-primaryy mr-3" style="font-size: 1.5rem;"></i>
                    <h5 class="mb-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Categories</span>
    </h2>
    <div class="row px-xl-5 pb-3">
    <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categoryName = $row['category_name'];
        $productCount = $row['product_count'];
        $categoryImage = $row['image_path']; // Fetch the image path from the database
?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="#">
                <div class="cat-item d-flex align-items-center mb-4" style="box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);">
                    <div class="overflow-hidden" style="width: 120px; height: 120px;"> <!-- Increased size -->
                        <!-- Use the image path from the database -->
                        <img class="img-fluid" src="admin/<?php echo $categoryImage; ?>" alt="<?php echo $categoryName; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6><?php echo $categoryName; ?></h6>
                        <small class="text-body"><?php echo $productCount; ?> Products</small>
                    </div>
                </div>
            </a>
        </div>
<?php
    }
} else {
    echo "No categories found.";
}
?>


    </div>
</div>
    <!-- Categories End -->


    <div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Featured Products</span>
    </h2>
    <div class="row px-xl-5">
        <?php
        // Fetch products from the database
        $sql = "SELECT id, brand_name, name, category, image1 FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-lg-2 col-md-4 col-sm-6 pb-3">
                    <div class="product-box bg-light mb-4">
                        <div class="product-img-container position-relative overflow-hidden">
                            <img class="img-fluid product-img" src="admin/' . htmlspecialchars($row['image1']) . '" alt="' . htmlspecialchars($row['name']) . '">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="product_detail.php?id=' . $row['id'] . '"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <p class="small text-muted mb-1">' . htmlspecialchars($row['category']) . '</p>
                            <a class="h6 text-decoration-none text-truncate" href="product_detail.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No products available.</p>';
        }
        ?>
    </div>
</div>



    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 350px;">
                    <img class="img-fluid" src="img/banner/tiles (2).jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">TILES</h3>
                        <a href="#" class="btn btn-primaryy">Enquire Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 350px;">
                    <img class="img-fluid" src="img/banner/sands.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">SAND AND AGGREGATE</h3>
                        <a href="#" class="btn btn-primaryy">Enquire Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent
                Products</span></h2>
                <div class="row px-xl-5">
        <?php
        // Fetch products from the database
        $sql = "SELECT id, brand_name, name, category, image1 FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-lg-2 col-md-4 col-sm-6 pb-3">
                    <div class="product-box bg-light mb-4">
                        <div class="product-img-container position-relative overflow-hidden">
                            <img class="img-fluid product-img" src="admin/' . htmlspecialchars($row['image1']) . '" alt="' . htmlspecialchars($row['name']) . '">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="product_detail.php?id=' . $row['id'] . '"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <p class="small text-muted mb-1">' . htmlspecialchars($row['category']) . '</p>
                            <a class="h6 text-decoration-none text-truncate" href="product_detail.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No products available.</p>';
        }
        ?>
    </div>
    </div>
    <!-- Products End -->

    <?php include "footer.php" ?>

    <!-- JavaScript Libraries -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>