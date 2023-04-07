<?php
include './header.php';

$cart =0;
if(empty($_SESSION['cart'])) {
    include './footer.php';
    die;    
}else{
    $cart = $_SESSION['cart'];
}

if(isset($_POST['delete']) && $_POST['delete']){
    $name = $_POST['name'];
    unset($_SESSION['cart'][$name]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);

}


for ($i=0; $i < count($_SESSION['cart']); $i++) { 
    $totail = $_SESSION['cart'][$i]['quarity'] * $_SESSION['cart'][$i]['sale'];
    $_SESSION['cart'][$i]['totail'] = $totail;
}

$sum =$sumtatil = 0;
for ($i=0; $i < count($_SESSION['cart']); $i++) { 
    $sum += $_SESSION['cart'][$i]['totail'] ;
}
$sumtatil = $sum + 5000;
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

    .cart {
        color: #C17A74 !important;
    }

    .name{
        display: -webkit-box; -webkit-box-orient: vertical; overflow-y: hidden; text-overflow: ellipsis; -webkit-line-clamp: 2;
    }

</style>
</div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Img</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                            $i=0;
                            foreach($_SESSION['cart'] as $item){
                                echo '
                                <tr>
                                    <td class="align-middle">
                                        <img src="../admin/product/thumb/'.$item['thumb'].'" alt="" style="width: 50px;"> 
                                    </td>
                                    <td class="align-middle">
                                        <p class="name">'.$item['name'].'</p>
                                    </td>
                                    <td class="align-middle">'.$item['sale'].'</td>
                                    <td class="align-middle">
                                    
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn" onclick="moreproduct(this)">
                                                <button class="btn btn-sm btn-primary btn-minus" >
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input name="quarity" type="text" class="form-control form-control-sm bg-secondary text-center" value="'.$item['quarity'].'">
                                            <div class="input-group-btn" onclick="moreproduct(this)">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle totail">'.$item['totail'].'</td>
                                    <td class="align-middle">

                                    <form action="" method="post"onsubmit="return deleteproduct()">
                                        <input type="hidden" name="name" value="'.$i.'">
                                        <input name="delete" class="btn btn-sm btn-primary" type="submit" value="&#10006;">
                                    </form>
                                    </td>
                                </tr>
                                ';$i++;
                            }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4" >
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium sum"><?php echo $sum;?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">50000</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold sumTitail"><?php echo $totail;?></h5>
                        </div>
                        <form action="./checkout.php?name=" method="post">
                            <input type="hidden" value="<?php echo (!empty($_SESSION['user'])) ?'ok':'no'; ?>">
                            <input name="sum" type="hidden" value="<?php echo $sum;?>">
                            <input name="sumtotail" type="hidden" value="<?php echo $sumtatil;?>">
                            <input name="checkout" type="submit" class="btn btn-block btn-primary my-3 py-3" value="Proceed To Checkout">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->



<script>
    document.getElementById('navbar-vertical').classList.remove('show')

    function deleteproduct() {
        var result = confirm('Bạn có chắc chắn không!')
      if (result != true) {
        return false
      }
    }

    function moreproduct(e) {
        var quatily = e.parentElement.getElementsByTagName('input')[0].value
        var price = e.parentElement.parentElement.parentElement.getElementsByTagName('td')[2].innerHTML
        var totail = e.parentElement.parentElement.parentElement.getElementsByTagName('td')[4]

        totail.innerHTML = quatily * price

        var sum =0;
        var totails = document.getElementsByClassName('totail')
        for(let i=0;i< totails.length ;i++) {
            sum += Number(totails[i].innerHTML)
        }

        sum = document.getElementsByClassName('sum')[0].innerHTML = sum;
        if(sum==0){
            var ship = 0
        }else {
            var ship = 5000
        }
        document.getElementsByClassName('sumTitail')[0].innerHTML = sum + ship;
    }

    function loadtotail() {
        var sum =0;
        var totails = document.getElementsByClassName('totail')
        for(let i=0;i< totails.length ;i++) {
            sum += Number(totails[i].innerHTML)
        }
 
        document.getElementsByClassName('sum')[0].innerHTML = sum;
        if(sum==0){
            var ship = 0
        }else {
            var ship = 5000
        }
        document.getElementsByClassName('sumTitail')[0].innerHTML = sum + ship +' đ';

    }
</script>
<?php
include './footer.php';
?>