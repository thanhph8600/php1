<?php
require '../../backend/db/dbhelper.php';

$sqlcategory = "select * from `category`";
$category = executeResult($sqlcategory);

$id = 0;

if (isset($_GET['slug']) && $_GET['slug']) {
    $id = $_GET['slug'];
    $sqlId = "SELECT * FROM `products` WHERE `id` = '" . $id . "'";
    $id = executeResult($sqlId);
}

$checkfile = false;
if (isset($_POST['addproduct']) && $_POST['addproduct']) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $content = $_POST['content'];
    $categoryID = $_POST['category'];
    $date = date('Y-m-d H:i:s');

    if(!empty($_FILES["upload"]["name"])){
        $randum = rand(1, 1000);
        $nameFile = $randum . $_FILES["upload"]["name"];

            //check file
            //file
            $target_dir = "thumb/";
            $target_file = $target_dir . $nameFile;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["upload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["upload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                die;
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    die;
                }
            }
    }

    //ktr xem co phai sua khong
    if (empty($id)) {
        if(!empty($_FILES["upload"]["name"])){
            
            // move_uploaded_file($_FILES['upload']["tmp_name"], 'files/' . $_FILES['upload']['name']);
            $sql = "INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `sale`, `content`, `thumb`, `created-at`, `updated-at`, `active`) VALUES (NULL, '" . $name . "', '" . $categoryID . "', '" . $price . "', '" . $sale . "', '" . $content . "', '" . $nameFile . "', '" . $date . "', '" . $date . "', '1')";
            execute($sql);
            header('location: ./product.php');
            }else{
                $checkfile = 'Bạn chưa chọn ảnh';
            }
    } else {
        if(empty($_FILES["upload"]["name"])){
            $sql = "UPDATE `products` SET `name`='" . $name . "',`category_id`='" . $categoryID . "',`price`='" . $price . "',`sale`='" . $sale . "',`content`='" . $content . "',`updated-at`='" . $date . "',`active`='1' WHERE `id` = '" . $id[0]['id'] . "'";

        }else{
            $sql = "UPDATE `products` SET `name`='" . $name . "',`category_id`='" . $categoryID . "',`price`='" . $price . "',`sale`='" . $sale . "',`content`='" . $content . "',`thumb`='" . $nameFile . "',`updated-at`='" . $date . "',`active`='1' WHERE `id` = '" . $id[0]['id'] . "'";
        }
        execute($sql);
        header('location: ./product.php');
    }
}

include '../header.php';
?>



<style>
    .input_Addproduct {
        background-color: #04AA6D;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 5px 15px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
    }

    .edit {
        color: #EACD11;
    }

    .delete {
        color: #FF0000;
    }

    .text-xs {
        border-radius: 8px;
        border: none;
        font-weight: bold;
        /* font-size: 14px !important; */
        background: none;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type=text],
    select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100px;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .pst-re {
        position: relative;
    }

    .pst-ab {
        position: absolute;
        top: 50%;
        right: 10%;
        transform: translate(100%, -50%);
        color: #fff;
        font-size: 25px;
    }

    a {
        color: #fff;
        text-decoration: none;
        transition: all .2s ease-in-out;
    }

    .pst-ab a:hover {
        color: #4CAF50;
        font-size: 30px;

    }

    .img-product {
        width: 300px;
        padding: 15px 0;
    }

    .img-product img {
        width: 100%;
        display: none;
    }

    input[type=file] {
        border: none;
        background: none;
    }
</style>


        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white " href="../index.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../category/category.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active bg-gradient-primary" href="./product.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Product</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../billing/billing.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Billing</span>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../banner/banner.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Banner</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../../pages/sign-in.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">login</i>
                        </div>
                        <span class="nav-link-text ms-1">Sign In</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../../pages/sign-up.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assignment</i>
                        </div>
                        <span class="nav-link-text ms-1">Sign Up</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Tables</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Type here...</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign In</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../../public/admin/assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../../public/admin/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                                    <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Add product</h6>
                            </div>
                            <div class="pst-ab">
                                <a href="./product.php"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <form action="" enctype="multipart/form-data" method="post" onsubmit="return checkproduct()" style="display:flex;width:95%;margin:auto">
                                    <label for="">Name</label>
                                    <input name="name" type="text" id="nameproduct" value="<?php echo (!empty($id)) ? $id[0]['name'] : ''; ?>" onkeydown="checkproduct()" onkeypress="checkproduct()" onkeyup="checkproduct()">

                                    <label for="">Price</label>
                                    <input name="price" type="text" id="priceproduct" value="<?php echo (!empty($id)) ? $id[0]['price'] : ''; ?>">

                                    <label for="">Sale</label>
                                    <input name="sale" type="text" id="saleproduct" value="<?php echo (!empty($id)) ? $id[0]['sale'] : ''; ?>">

                                    <label for="">Category</label>
                                    <select name="category" id="category" require>
                                        <option value="0">- - Category - -</option>
                                        <?php
                                        foreach ($category as $value) {
                                            echo '<option ' ?><?php if (!empty($id)) echo ($id[0]['category_id'] == $value['id']) ? 'selected' : ''; ?><?php echo ' value="' . $value['id'] . '">' . $value['name'] . '</option>';
                                                                                                                                                }
                                                                                                                                                    ?>

                                    </select>

                                    <label for="">content</label>
                                    <textarea name="content" id="" cols="30" rows="10" value=""><?php echo (!empty($id)) ? $id[0]['content'] : ''; ?></textarea>

                                    <label for="">Thumb</label>
                                    <input type="file" name="upload" id="file-input" accept="image/*">
                                    <div class="img-product">
                                        <img style="display: block;" src="./thumb/<?php echo (!empty($id)) ? $id[0]['thumb'] : ''; ?>" alt="" id="img-preview">
                                    </div>

                                    <label style="color:red;" for=""><?=$checkfile?></label>
                                    <input name="addproduct" type="submit" value="Add">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard">Free Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../../public/admin/assets/js/core/popper.min.js"></script>
    <script src="../../public/admin/assets/js/core/bootstrap.min.js"></script>
    <script src="../../public/admin/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../public/admin/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }


        const input = document.getElementById('file-input');
        const image = document.getElementById('img-preview');

        function checkproduct() {
            var lf = 0;
            var name = document.getElementById('nameproduct')
            var price = document.getElementById('priceproduct')
            var category = document.getElementById('category')

            if (name.value == '') {
                name.style.border = '1px solid red'
                lf = 1;
            } else {
                name.style.border = '1px solid green'
            }

            var priceRegex = /^\w([0-9]{1,13})$/;
            if (!price.value.match(priceRegex)) {
                price.style.border = '1px solid red'
                lf = 1;
            } else {
                price.style.border = '1px solid green'
            }


            if (category.value == 0) {
                category.style.border = '1px solid red'
                lf = 1;
            } else {
                category.style.border = '1px solid green'
            }

            if (!lf == 0) {
                return false
            }
        }
        //preview img


        input.addEventListener('change', (e) => {
            if (e.target.files.length) {

                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    // lay dung luong va kieu file tu the input file
                    var fsize = e.target.files[0].size;
                    var ftype = e.target.files[0].type;
                    var fname = e.target.files[0].name;


                    if (fsize > 1048576) //thuc hien dieu gi do neu dung luong file vuot qua 1MB
                    {

                        alert(fsize + " bites\nToo big!");
                    } else {
                        switch (ftype) {
                            case 'image/png':
                            case 'image/gif':
                            case 'image/jpeg':
                            case 'image/jpg':
                            case 'image/pjpeg':
                                break;
                            default:
                        }

                        image.style.display = 'block'
                        const src = URL.createObjectURL(e.target.files[0]);
                        image.src = src;
                    }
                }

            }
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../../public/admin/assets/js/material-dashboard.min.js?v=3.0.2"></script>
</body>

</html>