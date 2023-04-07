<?php
// include './db/dbhelper.php';
include './header.php';

$sql = "SELECT * FROM `banner`";
$banner = executeResult($sql);
?>
<style>
    .home {
        color: #C17A74 !important;
    }
    .pst-re {
        position: relative !important;
        width: 10px !important;
    }

    .pst-ab {
        position: absolute;
        background-color: #fff;
        width: 100%;
        max-width: 314px;
    }

    .product-img {
        display: flex;
        justify-items: center;
        align-items: center;
        padding: 20px !important;
        min-height: 250px;
    }
    .product-img img {
        width: 70% !important;
        margin: auto;
    }
    .product-imgxx{
        display: flex;
        justify-items: center;
        align-items: center;
        min-height: 300px;
    }
    .product-imgxx img {
        width: 80% !important;
        margin: auto;
    }
</style>

                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                            for($i=0 ; $i< count($banner); $i++){
                                if($i==0) {
                                    echo '
                                    <div class="carousel-item active" style="height: 410px;">
                                    <img class="img-fluid" src="../admin//banner/uploads/'.$banner[$i]['thumb'].'" alt="Image">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">

                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">'.$banner[$i]['slogan'].'</h3>
                                            <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                    ';
                                }else{
                                    echo '
                                    <div class="carousel-item" style="height: 410px;">
                                    <img class="img-fluid" src="../admin//banner/uploads/'.$banner[$i]['thumb'].'" alt="Image">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">

                                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">'.$banner[$i]['slogan'].'</h3>
                                            <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                    ';
                                }

                            }
                        ?>
                        <!-- <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="../admin//banner/uploads/" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                    <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="https://prbaochi.cdn.vccloud.vn/wp-content/uploads/2021/07/mau-banner-quang-cao-san-pham-15.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                    <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="text-center cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3 product-imgxx">
                        <img  class="img-fluid" src="../admin/category/img/dien-thoai.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Điện thoại di động</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="text-center cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3 product-imgxx">
                        <img class="img-fluid" src="../admin/category/img/laptop.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Laptop</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="text-center cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3 product-imgxx">
                        <img class="img-fluid" src="../admin/category/img/dong-ho.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Đồng hồ</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="text-center cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3 product-imgxx">
                        <img class="img-fluid" src="../admin/category/img/tablet.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Tablet</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="text-center cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3 product-imgxx">
                        <img class="img-fluid" src="../admin/category/img/smartwatch.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Smartwatch</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="text-center cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3 product-imgxx">
                        <img class="img-fluid" src="../admin/category/img/phu-kien.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Phụ kiện</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->


    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <!-- <img src="../admin/category/img/ss gap.jpg" alt=""> -->
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <!-- <img src="../admin/category/img/png-transparent-apple-watch-series-3-smartwatch-apple-watch-series-2-others-electronics-watch-accessory-mobile-phones.png" alt=""> -->
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            $sql = "SELECT * FROM `products` LIMIT 9, 18";
            $products = executeResult($sql);
            
                foreach($products as $item){
                    echo '
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="../admin/product/thumb/' . $item['thumb'] . '" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">'.$item['name'].'</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>'.$item['price'].' đ</h6><h6 class="text-muted ml-2"><del>'.$item['sale'].' đ</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    ';
                }
            ?>

        </div>
    </div>
    <!-- Products End -->


    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
        <?php
        $sql = "SELECT * FROM `products` LIMIT 1, 8";
        $products = executeResult($sql);
        
                foreach($products as $item){
                    echo '
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="../admin/product/thumb/' . $item['thumb'] . '" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">'.$item['name'].'</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>'.$item['price'].' đ</h6><h6 class="text-muted ml-2"><del>'.$item['sale'].' đ</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-1.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-2.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-3.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-4.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-5.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-6.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-7.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="../eshopper-1.0.0/img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


<?php
include './footer.php';
?>