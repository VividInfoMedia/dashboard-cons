 <style>
    .text-primar{
        color: white;
    }
 </style>
 
 <!-- Topbar Start -->
 <div class="container-fluid" style="background-color:#3B3B3B;">
        <div class="row align-items-center py-3 px-xl-5 d-none d-lg-flex" style="background-color:#3B3B3B;">
            <div class="col-lg-4">
                <a href="#" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Naanayan</span>
                    <!-- <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span> -->
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="#">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right" style="color:white;">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0" style="color:white;">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid  mb-30" style="background-color:#CC1D1D;">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">STEEL <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="#" class="dropdown-item">TMT</a>
                                <a href="#" class="dropdown-item">TATA</a>
                                <!-- <a href="#" class="dropdown-item">Baby's Dresses</a> -->
                            </div>
                        </div>
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">PAINT <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="#" class="dropdown-item">TATA</a>
                                <a href="#" class="dropdown-item">OPUS</a>
                                <a href="#" class="dropdown-item">NIPPON</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg navbar-dark py-3 py-lg-0 px-0">
                    <a href="#" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Naanayan</span>
                        <!-- <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span> -->
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Bricks</a>
                            <a href="detail.php" class="nav-item nav-link">Steel</a>
                            <a href="detail.php" class="nav-item nav-link">Cement</a>
                            
                            <a href="contact.php" class="nav-item nav-link">Paint</a>
                            <a href="contact.php" class="nav-item nav-link">Earth Movers</a>
                            <a href="contact.php" class="nav-item nav-link">Paint</a>
                            <a href="contact.php" class="nav-item nav-link">Sand and Aggregate</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="#" class="btn px-0">
                                <i class="fas fa-heart text-primar"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="#" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primar"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->