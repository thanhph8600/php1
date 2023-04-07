<?php
ob_start();
include './header.php';
$cart = 0;
if (empty($_SESSION['cart'])) {
    include './footer.php';
    die;
} else {
    $cart = $_SESSION['cart'];
}


// tinh, huyen,xa
$sql = "SELECT * FROM `province`";
$province = executeResult($sql);


//
$sum = $sumtatil = 0;
for ($i = 0; $i < count($_SESSION['cart']); $i++) {
    $sum += $_SESSION['cart'][$i]['totail'];
}
$sumtatil = $sum ;


include  "../PHPMailer/PHPMailer.php";
include  "../PHPMailer/Exception.php";
include "../PHPMailer-master/src/OAuth.php";
include  "../PHPMailer/POP3.php";
include  "../PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//kiem tra user
$name = $phone = $email = "";
if (!empty($_SESSION['user'])) {
    $name = $_SESSION['user']['name'];
    $phone = '0' . $_SESSION['user']['phone'];
    $email = $_SESSION['user']['email'];
}


//submit form
if (isset($_POST['placeOrder']) && ($_POST['placeOrder'])) {
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $warpro = $_POST['warpro'];
    $add = $_POST['address'];
    $payment = $_POST['payment'];
    $date = date('Y-m-d');
    $code = rand(10000,99999);


    $sql = "SELECT `province`.`_name` as `province`,`district`.`_name` as `district`, `ward`.`_name` as `ward`  FROM `province`, `district`,`ward`  WHERE `province`.`id`= '".$province."' AND `district`.`id` = '".$district."' AND `ward`.`id` = '".$warpro."'";
    $data = executeResult($sql);
    $address = $data[0]['province'] .', '. $data[0]['district'].', '. $data[0]['ward'].', '. $add;

    // add order
    $sql = "INSERT INTO `oder` ( `name`, `email`, `phone`, `address`, `created_at`, `updated_at`, `totail`,`payment`, `active`) VALUES ('".$name."', '".$email."', '".$phone."', '".$address."', '".$date."', '".$date."', '".$sumtatil."','".$payment."', '0')";
    $oderID = getInset($sql);

    // add code
    $code = $oderID . $code;
    $sql = "UPDATE `oder` SET `code`='".$code."' WHERE `id` ='".$oderID."'";
    execute($sql);

    //add oder detail
    foreach($_SESSION['cart'] as $item) {
        $sql = "INSERT INTO `oder_detail` (`oder_id`,`product_id`,`quantity`) VALUE ('".$oderID."','".$item['id']."','".$item['quarity']."')";
        execute($sql);
    }

    // sendmail
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;                               
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true; 
        $mail->Username = 'tuyetnhung200201@gmail.com';
        $mail->Password = 'pevupqufusoaiatg';                          
        $mail->SMTPSecure = 'tls';            
        $mail->Port = 587;                    
        $mail->setFrom('tuyetnhung200201@gmail.com', 'E-Shopper');

        $mail->addAddress($email, 'User');    
        $mail->isHTML(true);                     
        $mail->Subject = 'Your Oder';
        $mail->Body    = '
        <p>Xin chào '.$name.',</p>
        <p>Đơn hàng của bạn đã được tạo thành công</p>
        <p>Mã đơn hàng của bạn là <span style="padding:15px;border:1px grey solid;font-size:22px">'.$code.'</span>
        hãy dùng mã đó để kiểm tra đơn hàng của bạn </p>
        ';
        $mail->send();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    
    unset($_SESSION['cart']);
    header('Location: oder.php?id='.$oderID.'');
    ob_end_clean();

}
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

    .name {
        max-width: 300px;
        padding-right: 15px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow-y: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 1;
    }
</style>
</div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <form action="" method="post" onsubmit="return checkFromOder()">
        <div class="row px-xl-5">
            <div class="col-lg-7">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Full Name</label>
                            <input class="form-control fullName" name="fullName" type="text" placeholder="John" value="<?php echo $name; ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input name="email" class="form-control email" type="text" placeholder="example@email.com" value="<?php echo $email; ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input name="phone" class="form-control phone" type="text" placeholder="+84 911 999 764" value="<?php echo $phone; ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select" name="province" id="province">
                                <option value="null">-- Province --</option>
                                <?php
                                foreach ($province as $item) {
                                    echo '
                                        <option value="' . $item['id'] . '">' . $item['_name'] . '</option>
                                        ';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>District</label>
                            <select class="custom-select district" name="district" id="district">
                                <option value="null">-- District --</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ward</label>
                            <select class="custom-select warpro" name="warpro" id="warpro">
                                <option value="null"> -- Ward --</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input name="address" class="form-control address" type="text" placeholder="123 Street">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-5">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php
                        foreach ($_SESSION['cart'] as $item) {
                            echo '
                                <div class="d-flex justify-content-between">
                                    <p class="name">' . $item['name'] . '</p>
                                    <p>' . $item['quarity'] . '</p>
                                    <p>' . $item['totail'] . '</p>
                                </div>
                                ';
                        }
                        ?>

                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><?php echo $sumtatil; ?> đ</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body checkradio">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal" value="Paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck" value="Direct Check">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="" id="inputne">
                            <div class="custom-control custom-radio">
                                <input  type="radio" class="custom-control-input" name="payment" id="banktransfer" value="Bank Transfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                        <span class="errradio" style="color:red;padding-left:10px"></span>
                    </div>

                    <div class="card-footer border-secondary bg-transparent">
                        <input name="placeOrder" type="submit" value="Place Order" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- Checkout End -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    document.getElementById('navbar-vertical').classList.remove('show')

    var province = document.getElementById('province')
    province.addEventListener('change', function() {
        $.post('district.php', {
            "provinceId": province.value
        }, function(data) {
            $("#district").html(data)
        })
    })

    var district = document.getElementById('district')
    district.addEventListener('change', function() {
        $.post('ward.php', {
            "district": district.value
        }, function(data) {
            $(".warpro").html(data)
        })
    })

    var lf = 0;
    $(".fullName").on('input keyup paste', function() {
        var input = $(this)
        var re = /^[0-9a-zA-ZàáạãảầấậẩẫằắặẳẵăêèẹẻẽếềểệễửữừứựơớờợởỡđéâäãåąáấâăčćęèéêëėįìíîïłńòóôöõøùúûüươứớựųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u
        var is_name = re.test(input.val());
        if (!is_name) {
            $(this).css('border', 'red 1px solid')
            lf = 1;
        } else {
            $(this).css('border', 'green 1px solid')
        }
        console.log($(this).val())
    });

    $(".email").on('input keyup paste', function() {
        var input = $(this)
        var re = /^([a-zA-Z0-9_\.\+\-])+\@(([a-zA-z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/
        var is_name = re.test(input.val());
        if (!is_name) {
            $(this).css('border', 'red 1px solid')
            lf = 1;
        } else {
            $(this).css('border', 'green 1px solid')

        }
    });
    $(".phone").on('input keyup paste', function() {
        var input = $(this)
        var re = /^([0-9]{10})$/
        var is_name = re.test(input.val());
        if (!is_name) {
            $(this).css('border', 'red 1px solid')
            lf = 1;
        } else {
            $(this).css('border', 'green 1px solid')

        }
    });
    $(".address").on('input keyup paste', function() {
        var input = $(this)
        var re = /^[a-zA-ZàáạãảầấậẩẫằắặẳẵăêèẹẻẽếềểệễửữừứựơớờợởỡđéâäãåąáấâăčćęèéêëėįìíîïłńòóôöõøùúûüươứớựųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u
        var is_name = re.test(input.val());
        if (!is_name) {
            $(this).css('border', 'red 1px solid')
            lf = 1;
        } else {
            $(this).css('border', 'green 1px solid')

        }
    });

    $("select").change(function() {
        for (var i = 0; i < $("select").length; i++) {
            if ($("select").eq(i).val() == 'null') {
                $("select").eq(i).css('border', 'red 1px solid');
                lf = 1
            } else {
                $("select").eq(i).css('border', 'green 1px solid');
            }
            console.log(i)
        }
    });

    $('input:radio').change(function() {
        var value = $("form input[type='radio']:checked").val();
        // alert("Value of Changed Radio is : " + value);
    });

    function checkFromOder() {
        if ($(".fullName").val() == '') $(".fullName").css('border', 'red 1px solid')
        if ($(".email").val() == '') $(".email").css('border', 'red 1px solid')
        if ($(".phone").val() == '') $(".phone").css('border', 'red 1px solid')
        if ($(".address").val() == '') $(".address").css('border', 'red 1px solid')
        for (var i = 0; i < $("select").length; i++) {
            if ($("select").eq(i).val() == 'null') {
                $("select").eq(i).css('border', 'red 1px solid');

            } else {
                $("select").eq(i).css('border', 'green 1px solid');
            }
        }

        $("input[type='radio']").css('box-shadow', '1em 1em red')

        var radio = $("form input[type='radio']:checked").val()
        if (radio != 'Direct Check' && radio != 'Paypal' && radio != 'Bank Transfer' ) {
            $('.errradio').html('Bạn chưa chọn trường này!')
        }else{
            $('.errradio').html('')
        }

        

        if (lf == 0) {
            return false
        }

    }
</script>
<?php
include './footer.php';

?>