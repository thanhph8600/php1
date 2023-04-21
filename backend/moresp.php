<?php
 var_dump($_POST);
session_start();
include './db/dbhelper.php';

if (empty($_SESSION['cart'])) $_SESSION['cart'] = [];

if (!empty($_POST)) {

    //cộng trừ sản phẩm trong giỏ hàng
    if (isset($_POST['index'])) {
        $index = $_POST['index'];
        $active = $_POST['active'];
        if($active == 1){
            $_SESSION['cart'][$index]['quarity'] += 1;
        }else{
            $_SESSION['cart'][$index]['quarity'] -= 1;
        }
    }


    //them san pham vao gio hang
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        // $index = $_POST['index'];
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
}
