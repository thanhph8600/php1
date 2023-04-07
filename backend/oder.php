<?php

include './header.php';

$oder = false;
if (isset($_GET['id']) && $_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT `oder`.`code`,`oder`.`name`,`oder`.`email`, `oder`.`phone`,`oder`.`address`, `oder`.`created_at`,`oder`.`totail`, `oder`.`payment`,`oder`.`active`,`products`.`name` AS 'nameProduct',`products`.`sale`,`oder_detail`.`quantity` FROM `oder` JOIN `oder_detail` ON `oder`.`id` = `oder_detail`.`oder_id` LEFT JOIN `products` ON `oder_detail`.`product_id` = `products`.`id` WHERE `oder`.`id` = '" . $id . "'";
    $oder = executeResult($sql);
}

if (isset($_POST['search']) && $_POST['search']) {
    $code = $_POST['code'];

    $sql = "SELECT `code` FROM `oder`";
    $odertable = executeResult($sql);
    foreach ($odertable as $item) {
        if ($item['code'] == $code) {
            $sql = "SELECT `oder`.`code`,`oder`.`name`,`oder`.`email`, `oder`.`phone`,`oder`.`address`, `oder`.`created_at`,`oder`.`totail`, `oder`.`payment`,`oder`.`active`,`products`.`name` AS 'nameProduct',`products`.`sale`,`oder_detail`.`quantity` FROM `oder` JOIN `oder_detail` ON `oder`.`id` = `oder_detail`.`oder_id` LEFT JOIN `products` ON `oder_detail`.`product_id` = `products`.`id` WHERE `oder`.`code` = '" . $code . "'";
            $oder = executeResult($sql);
            break;
        }
    }
}

?>
<style>
    .pst-re {
        position: relative !important;
        width: 10px !important;
    }

    .oder {
        color: #C17A74 !important;
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
        height: min-content;
    }

    .product-img img {
        width: 70% !important;
        margin: auto;
    }

    .oder-item {
        background-color: #eee;
        box-shadow: 0 0 3px .1px black;
        border-radius: 7px;
        padding: 10px 0;
    }

    .name-sp {
        width: 60%;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow-y: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 1;

    }

    .total-p {
        padding: 5px 0;
    }
</style>

</div>
</div>
<!-- Navbar End -->

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Oder Details</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Oder details</p>
        </div>
    </div>

</div>
<!-- Page Header End -->
<div class="container-fluid">
    <div class="row">
        <div style="margin: auto;text-align:center" class="col-lg-4">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Search for your order</label>
                    <div class="d-flex ">
                        <input name="code" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                        <input name="search" class="btn btn-default" type="submit" value="Search">
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

</div>

<?php
if ($oder != false) { ?>


    <div class="container-fluid">
        <div class="row px-xl-5 d-flex justify-content-between">
            <div class="col-lg-7 mb-12">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h4>PRODUCT</h4>
                    <h4>TOTAL</h4>
                </div>

                <?php
                foreach ($oder as $item) {
                    echo '
                    <div class=" d-flex justify-content-between align-items-center">
                    <p class="name-sp">' . $item['nameProduct'] . '</p>
                    <p>x ' . $item['quantity'] . '</p>
                        <p class="">
                            ' . $item['sale'] * $item['quantity'] . '
                        </p>
                    </div>
                    ';
                }
                ?>

                <div class="border-top border-bottom d-flex justify-content-between align-items-center">
                    <div>Subtotal:</div>
                    <div class="total-p">
                        <?= $oder[0]['totail'] ?>
                    </div>
                </div>
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <div>Payment:</div>
                    <div class="total-p">
                        <?= $oder[0]['payment'] ?>
                    </div>
                </div>
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <div>Total:</div>
                    <div style="font-size: 18px;font-weight: 600;" class="total-p">
                        <?= $oder[0]['totail'] ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-12">
                <div class="oder-item px-xl-5">
                    <p style="color: green">Thank you. Your order has been received.</p>
                    <ul>
                        <li>
                            <p>Order number:<span style="color: black;font-size:18px"> <?= $oder[0]['code'] ?></span> </p>
                        </li>
                        <li>
                            <p>Name: <span style="color: black;font-size:18px"> <?= $oder[0]['name'] ?></span></p>
                        </li>
                        <li>
                            <p>Email: <span style="color: black;font-size:18px"> <?= $oder[0]['email'] ?></span></p>
                        </li>
                        <li>
                            <p>Phone number: <span style="color: black;font-size:18px"> <?= $oder[0]['phone'] ?></span></p>
                        </li>
                        <li>
                            <p>Address: <span style="color: black;font-size:18px"> <?= $oder[0]['address'] ?></span></p>
                        </li>
                        <li>
                            <p>Date: <span style="color: black;font-size:18px"> <?= $oder[0]['created_at'] ?></span></p>
                        </li>
                        <li>
                            <p>Total: <span style="color: black;font-size:18px"> <?= $oder[0]['totail'] ?></span></p>
                        </li>
                        <li>
                            <p>Payment method: <span style="color: black;font-size:18px"> <?= $oder[0]['payment'] ?></span></p>
                        </li>
                        <li>
                            <?php
                            switch ($oder[0]['active']) {
                                case 0:
                                    $status =  "Đang chờ xác nhận";
                                    break;
                                case 1:
                                    $status =  "Đã xác nhận";
                                    break;
                                case 2:
                                    $status =  "Đang được gửi đi";
                                    break;
                                case 3:
                                    $status =  "Đã đến tay người mua";
                                    break;
                                case 4:
                                    $status =  "Đơn hàng đã bị hủy";
                                    break;
                            }
                            ?>
                            <p>Order status: <span style="color: black;font-size:18px"> <?= $status ?></span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>


<script>
    document.getElementById('navbar-vertical').classList.remove('show')
</script>
<?php
include './footer.php';
?>