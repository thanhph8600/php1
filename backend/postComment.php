<?php
include './db/dbhelper.php';
if(!empty($_POST)){
    if(isset($_POST['email']) && $_POST['email']){
        $email = $_POST['email'];
    }
    if(isset($_POST['name']) && $_POST['name']){
        $name = $_POST['name'];
    }
    if(isset($_POST['message']) && $_POST['message']){
        $message = $_POST['message'];
    }
    if(isset($_POST['idProduct']) && $_POST['idProduct']){
        $idProduct = $_POST['idProduct'];
    }

    $date = date('Y-m-d H:m:s');

    $sql = "INSERT INTO `comments`( `name`, `email`, `message`, `created_at`,`id_product`) VALUES ('".$name."','".$email."','".$message."','".$date."','".$idProduct."')";
    $id = getInset($sql);

    $sql = "SELECT * FROM `comments` WHERE `id` = '".$id."' and `id_product`='".$idProduct."'";
    $data = executeResult($sql);
    echo '
    <div class="media mb-4">
    <img src="https://www.kindpng.com/picc/m/130-1300217_user-icon-member-icon-png-transparent-png.png" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
    <div class="media-body">
        <h6>'.$data[0]['name'].'<small> - <i>'.$data[0]['created_at'].'</i></small></h6>
        <p>'.$data[0]['message'].'</p>
    </div>
</div>
    ';    
}
?>