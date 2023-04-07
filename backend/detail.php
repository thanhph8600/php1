<?php

include './header.php';

$products = 0;
$sql = "SELECT * FROM `products`";
$products = executeResult($sql);

$sql = "SELECT * FROM `comments` WHERE  `id_product`='".$_GET['id']."'";
$dataCmt = executeResult($sql);


$product = false;
if (isset($_GET['id']) && $_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `products` WHERE `id` = '" . $id . "'";
    $product  = executeResult($sql);
} else {
    die;
}

if (isset($_POST['addCart']) && $_POST['addCart']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `products` WHERE `id` ='" . $id . "'";
    $product = executeResult($sql);

    $check = 1;
    /***************************** */
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product[0]['id']) {
            $_SESSION['cart'][$key]['quarity'] += 1;
            $check = 0;
            break;
        }
    }

    if ($check == 1) {
        $product[0]['quarity'] = 1;
        $_SESSION['cart'][] = $product[0];
    }
}
?>


<style>
    .borderad:hover {
        padding: 7px;
        border: 1px solid red;
        border-radius: 10px;
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

    .carousel-item {
        padding: 30px !important;
    }
</style>

</div>
</div>
<!-- Navbar End -->



<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="../admin/product/thumb/<?= $product[0]['thumb'] ?>" alt="Image">
                    </div>
                    <!-- <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-2.jpg" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-3.jpg" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-4.jpg" alt="Image">
                        </div> -->
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold"><?= $product[0]['name'] ?></h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(<?= count($dataCmt)?> Reviews)</small>
            </div>
            <h3 class="font-weight-semi-bold mb-4">$<?= $product[0]['sale'] ?></h3>
            <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd rebum.</p>


            <div class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-minus">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-secondary text-center" value="1">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <form action="" method="post">
                    <a href="" class="borderad">
                        <i class="fas fa-shopping-cart text-dark mr-1"></i>
                        <input name="addCart" class="btn  btn-sm p-0" type="submit" value="Add To Cart">
                    </a>
                </form>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (<?= count($dataCmt)?>)</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    <p>
                    <p><?= $product[0]['content'] ?></p>
                    </p>
                </div>

                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4"><?= count($dataCmt)?> review for "Colorful Stylish Shirt"</h4>
                            <div class="show-comment">
                                <?php

                                    foreach($dataCmt as $item){
                                        echo '
                                        <div class="media mb-4">
                                            <img src="https://www.kindpng.com/picc/m/130-1300217_user-icon-member-icon-png-transparent-png.png" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>'.$item['name'].'<small> - <i>'.$item['created_at'].'</i></small></h6>
                                                <p>'.$item['message'].'</p>
                                            </div>
                                        </div>
                                        ';
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <!-- <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                                <div class="text-primary">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div> -->
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control message"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Your Name *</label>
                                    <input class="form-control fullName" name="fullName" type="text" placeholder="John" value="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input name="email" class="form-control email" type="text" placeholder="example@email.com" value="">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="button" value="Leave Your Review" class="btn btn-primary px-3 review">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php
                foreach ($products as $item) {
                    echo '
                        <div class="card product-item border-0">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="../admin/product/thumb/' . $item['thumb'] . '" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">' . $item['name'] . '</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>$' . $item['price'] . '</h6>
                                    <h6 class="text-muted ml-2"><del>$' . $item['sale'] . '</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="./detail.php?id=' . $item['id'] . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
                        </div>
                        ';
                }
                ?>

            </div>
        </div>
    </div>
</div>
<!-- Products End -->


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    document.getElementById('navbar-vertical').classList.remove('show')

    var lf = 0;
    $(".message").on('input keyup paste', function() {
        var input = $(this)
        var re = /^[0-9a-zA-ZàáạãảầấậồốộổỗớờỡởợơẩẫằắặẳẵăêèẹẻẽếềểệễửữừứựơớờợởỡđéâäãåąáấâăčćęèéêëėįìíîïłńòóôöõøùúûüươứớựųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u
        var is_name = re.test(input.val());
        if (!is_name) {
            $(this).css('border', 'red 1px solid')
            lf = 1;
        } else {
            $(this).css('border', 'green 1px solid')
            lf = 0;
        }
    });
    $(".fullName").on('input keyup paste', function() {
        var input = $(this)
        var re = /^[0-9a-zA-ZàáạãảầấậồốộổỗớờỡởợơẩẫằắặẳẵăêèẹẻẽếềểệễửữừứựơớờợởỡđéâäãåąáấâăčćęèéêëėįìíîïłńòóôöõøùúûüươứớựųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u
        var is_name = re.test(input.val());
        if (!is_name) {
            $(this).css('border', 'red 1px solid')
            lf = 1;
        } else {
            lf = 0;
            $(this).css('border', 'green 1px solid')
        }
    });
    $(".email").on('input keyup paste', function() {
        var input = $(this)
        var re = /^([a-zA-Z0-9_\.\+\-])+\@(([a-zA-z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/
        var is_name = re.test(input.val());
        if (!is_name) {
            $(this).css('border', 'red 1px solid')
            lf = 1;
        } else {
            lf = 0;
            $(this).css('border', 'green 1px solid')

        }
    });

    $('.review').click(function() {
        if ($(".message").val() == '') {
            $(".message").css('border', 'red 1px solid')
            lf = 1;

        }
        if ($(".fullName").val() == '') {
            lf = 1;
            $(".fullName").css('border', 'red 1px solid')
        }
        if ($(".email").val() == '') {
            lf = 1;
            $(".email").css('border', 'red 1px solid')
        }

        if (lf == 0) {
            // $(".message").val()
            // $(".fullName").val()
            // $(".email").val()
            // // console.log($(".message").val(), $(".fullName").val(), $(".email").val())

            $.ajax({
                    method: "POST",
                    url: "./postComment.php",
                    data: {
                        email: $(".email").val(),
                        name : $(".fullName").val(),
                        message: $(".message").val(),
                        idProduct : <?=$_GET['id']?>
                    }
                })
                .done(function(msg) {
                    // console.log(JSON.parse(msg))
                    $('.show-comment').append(msg);
                    $(".message").val() = '';
                    $(".fullName").val() = '';
                    $(".email").val() = '';
                });
        }
    })
</script>
<?php
include './footer.php';
?>