<?php
ob_start();
include './header.php';
$products = 0;
$sql = "SELECT * FROM `products`";
$products = executeResult($sql);

// if (empty($_SESSION['cart'])) $_SESSION['cart'] = [];

// if (isset($_POST['addCart']) && $_POST['addCart']) {
//     $id = $_POST['id'];
//     // $index = $_POST['index'];
//     $sql = "SELECT * FROM `products` WHERE `id` ='" . $id . "'";
//     $product = executeResult($sql);

//     $check = 1;
//     /***************************** */
//     foreach ($_SESSION['cart'] as $key => $item) {
//         if ($item['id'] == $product[0]['id']) {
//             $_SESSION['cart'][$key]['quarity'] += 1;
//             $check = 0;
//             break;
//         }
//     }

//     if ($check == 1) {
//         $product[0]['quarity'] = 1;
//         $_SESSION['cart'][] = $product[0];
//     }

//     header('location: cart.php');
// }


//phân trang
//tìm tổng sản phẩm
$result = "select count(`id`) as total from `products`";
$count = executeResult($result);
$total_records = $count[0]['total'];

//limit va current_page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;

//tong so trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;

// Có limit và start rồi thì truy vấn CSDL lấy danh sách san pham
$result = "SELECT `category`.`name` AS `category`,`products`.`id`, `products`.`name`, `category_id`, `price`, `sale`, `content`, `thumb`, `products`.`created-at`, `products`.`updated-at`, `active` FROM `products` JOIN `category` ON `products`.`category_id` = `category`.`id` LIMIT $start, $limit";
$products = executeResult($result);

if (isset($_GET['category']) && $_GET['category']) {
    $sql = "SELECT * FROM `products` WHERE `category_id` = '" . $_GET['category'] . "'";
    $products = executeResult($sql);
}


$search = false;
if (isset($_POST['searchSP']) && $_POST['searchSP']) {
    $tensp = $_POST['tensp'];
    $sql = "SELECT * FROM `products` WHERE `name` LIKE '%" . $tensp . "%'";
    $products = executeResult($sql);
    $search = true;
}

ob_end_flush();
?>

<style>
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

    .shop {
        color: #C17A74 !important;
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

    .spagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .hover-item:hover p {
        text-decoration: none;
    }
</style>

</div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="./index.php">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="price-all">All Color</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-1">
                        <label class="custom-control-label" for="color-1">Black</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-2">
                        <label class="custom-control-label" for="color-2">White</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-3">
                        <label class="custom-control-label" for="color-3">Red</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-4">
                        <label class="custom-control-label" for="color-4">Blue</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="color-5">
                        <label class="custom-control-label" for="color-5">Green</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->

            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="" method="post">
                            <div class="input-group">
                                <input name="tensp" type="text" class="form-control" placeholder="Search by name">
                                <div class="input-group-append">
                                    <input name="searchSP" type="submit" value="Search" class="input-group-text bg-transparent text-primary">
                                    <!-- <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span> -->
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort by
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Latest</a>
                                <a class="dropdown-item" href="#">Popularity</a>
                                <a class="dropdown-item" href="#">Best Rating</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                $chek = 0;

                foreach ($products as $item) {
                    echo '
                        
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <a class="hover-item" href="./detail.php?id=' . $item['id'] . '">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                            <img class="img-fluid w-100" src="../admin/product/thumb/' . $item['thumb'] . '" alt="">
                                        </div>
                                    </a>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">' . $item['name'] . '</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>' . $item['price'] . ' đ</h6>
                                            <h6 class="text-muted ml-2"><del>' . $item['sale'] . ' đ</del></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="./detail.php?id=' . $item['id'] . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        

                                        <div class="input-group-btn" onclick="moreproduct(this)">
                                            <input type="hidden" name="id" value="' . $item['id'] . '">
                                            <button class="btn btn-sm text-dark p-0">
                                            <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        
                        ';
                    $chek++;
                }

                ?>
                                                        <!-- <form action="" method="post">
                                            <input type="hidden" name="index" value="' . $chek . '">
                                            <input type="hidden" name="id" value="' . $item['id'] . '">
                                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i> 

                                            <input name="addCart" class="btn btn-sm text-dark p-0" type="submit" value="Add To Cart"></a>
                                        </form> -->

                <!--  -->

            </div>
            <div class="spagination">
                <?php
            
                if (empty($_GET['category'])) {
                        // PHẦN HIỂN THỊ PHÂN TRANG
                        // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
                        if ($current_page > 1 && $total_page > 1) {
                            echo '<a href="shop.php?page=' . ($current_page - 1) . '"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a> | ';
                        }

                        // Lặp khoảng giữa
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span>' . $i . '</span> | ';
                            } else {
                                echo '<a href="shop.php?page=' . $i . '">' . $i . '</a> | ';
                            }
                        }

                        // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a href="shop.php?page=' . ($current_page + 1) . '"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>  ';
                        }
                }

                ?>
            </div>
        </div>
        <!-- Shop Product End -->

    </div>
</div>
<!-- Shop End -->

<script>
    document.getElementById('navbar-vertical').classList.remove('show')

    function moreproduct(e) {
        var id = e.getElementsByTagName('input')[0].value
        console.log(id)
        $.ajax({
                    method: "POST",
                    url: "./moresp.php",
                    data: {
                        id : id
                    }
                })
    }
</script>
<?php
include './footer.php';
?>