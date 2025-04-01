<?php
include 'admin/db.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Invalid product ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="assets/plugins/OwlCarousel/css/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
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
    <!-- Custom CSS -->

    <style>
    body {
        background-color: #ffffff !important; /* White background for a clean look */
    }

    .custom-modal-header {
        background-color: #4CAF50; /* Vibrant green for headers */
        color: white;
    }

    .custom-btn-primary {
        background-color: #007BFF; /* Vibrant blue for primary buttons */
        border-color: #007BFF;
    }

    .custom-btn-primary:hover {
        background-color: #0056b3; /* Darker blue for hover effect */
        border-color: #0056b3;
    }

    .product-gallery .item img,
    .owl-thumb-item img {
        width: 100%;
        height: 300px; /* Adjusted height */
        object-fit: contain;
        /* cursor: zoom-in; */
        transition: transform 0.2s ease-in-out;
    }

    .product-gallery .item,
    .owl-thumb-item {
        overflow: hidden;
        position: relative;
    }

    .product-gallery .item img,
    .owl-thumb-item img {
        transform-origin: center;
    }

    .product-info-section h3 {
        color: #CC1D1D !important; /* Vibrant orange for headers */
    }

    .product-info-section p, .product-info-section dd {
        color: #333; /* Darker text color for better contrast */
    }

    .product-info-section .in-stock {
        color: #28a745; /* Vibrant green for stock status */
    }

    .rates .fas.fa-star {
        color: #FFD700 !important; /* Gold color for star icons */
    }

    .btn-whatsapp {
    background-color: #228B22; /* Dark green color */
    border-color: #228B22;
    color: white;
}
        .btn-whatsapp:hover {
            /* Darker green for hover */
            border-color: red;
            color:green;
            font-weight: bold;
        }

        .btn-enquire {
            background-color: red; /* Red background color */
            border-color: red;
            color: white; /* White text color */
        }

        .btn-enquire:hover {
            background-color: white; /* Darker red for hover */
            border-color: red;
            color: red;
            font-weight: bold;
        }

    .owl-thumbs {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .owl-thumb-item {
        width: 70px; /* Adjusted width */
        height: 70px; /* Adjusted height */
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .owl-thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (min-width: 968px) {
        .product-details-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin: 50px auto;
            max-width: 1000px; /* Adjusted max-width */
            padding: 10px; /* Adjusted padding */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    }

    @media (max-width: 968px) {
        .mblclr {
            margin-top: 20px;
        }
        .product-gallery .item img {
            height: 250px; /* Adjusted height */
        }

        .owl-thumb-item {
            width: 50px; /* Adjusted width */
            height: 50px; /* Adjusted height */
        }
    }
</style>

</head>

<body>
    <?php include "nav.php" ?>

    <div class="product-details-container">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-down">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-12 col-lg-6">
                            <div class="image--section">
                                <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
                                    <?php
                                    $images = [$product['image1'], $product['image2'], $product['image3']];
                                    foreach ($images as $image) {
                                        if (!empty($image)):
                                            $imagePath = "admin/" . htmlspecialchars($image);
                                            if (file_exists($imagePath)) {
                                                ?>
                                                <div class="item">
                                                    <img src="<?= $imagePath ?>" class="img-fluid" alt="Product Image">
                                                </div>
                                                <?php
                                            } else {
                                                echo "Image not found: " . htmlspecialchars($imagePath) . "<br>";
                                            }
                                        endif;
                                    }
                                    ?>
                                </div>
                                <div class="owl-thumbs" data-slider-id="1">
                                    <?php foreach ($images as $image) {
                                        if (!empty($image)):
                                            ?>
                                            <button class="owl-thumb-item">
                                                <img src="admin/<?= htmlspecialchars($image) ?>" class="" alt="">
                                            </button>
                                        <?php endif;
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="product-info-section p-3">
                                <h3 class="mt-3 mt-lg-0 mb-0"><?= htmlspecialchars($product['name']) ?></h3>
                                <div class="product-rating d-flex align-items-center mt-2">
                                    <div class="rates cursor-pointer font-13">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="ms-1">
                                        <p class="mb-0">(Top Rating)</p>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <h6>Description:</h6>
                                    <p class="mb-0"><?= htmlspecialchars($product['description']) ?></p>
                                </div>
                                <dl class="row mt-3">
                                    <dt class="col-sm-3">Product ID</dt>
                                    <dd class="col-sm-9">#<?= htmlspecialchars($product['id']) ?></dd>
                                    <dt class="col-sm-3">Category</dt>
                                    <dd class="col-sm-9"><?= htmlspecialchars($product['category']) ?></dd>
                                    <dt class="col-sm-3">Stock</dt>
                                    <dd class="col-sm-9 in-stock">In Stock</dd>
                                </dl>

                                <br>
                                <!--end row-->
                                <div class="d-flex gap-2 mt-3">
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="https://wa.me/YOUR_PHONE_NUMBER" class="btn btn-whatsapp"
                                            target="_blank">
                                            <i class="fab fa-whatsapp"></i> WhatsApp
                                        </a>
                                        <button type="button" class="btn btn-enquire" data-bs-toggle="modal"
                                            data-bs-target="#enquireModal">
                                            Enquire
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>

    <!-- Enquire Modal -->
    <div class="modal fade" id="enquireModal" tabindex="-1" aria-labelledby="enquireModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquireModalLabel">Enquire About
                        <?php echo htmlspecialchars($product['name']); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="enquire_submit.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-enquire">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/OwlCarousel/js/owl.carousel.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/index.js"></script>

    <!-- Contact Javascript File -->

    <!-- Template Javascript -->

    <script>
    $(document).ready(function(){
        // Initialize the main carousel
        $(".product-gallery").owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: false
        });

        // Handle thumbnail clicks
        $(".owl-thumb-item").click(function(e) {
            e.preventDefault();
            var index = $(this).index();
            $(".product-gallery").trigger('to.owl.carousel', [index, 300, true]);
        });
    });
</script>

    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>
