<?php
session_start();
require_once('../backend/db/dbhelper.php');

if(isset($_SESSION['getRand'])) $_SESSION['getRand'] = 0;

if(isset($_SESSION['email'])) $_SESSION['email'] = 0;


include  "../PHPMailer/PHPMailer.php";
include  "../PHPMailer/Exception.php";
include "../PHPMailer-master/src/OAuth.php";
include  "../PHPMailer/POP3.php";
include  "../PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['getNewPass']) && $_POST['getNewPass']) {
    $email = $_POST['email'];

    $sql = 'SELECT * FROM `user` WHERE email = "' . $email . '"';

    $item =  executeResult($sql);
    if (!empty($item)) {
        // lưu email lên sesstion
        $_SESSION['email'] = $email;

        // lưu số ngẫu nhiên lên sesstion
        $randum =rand(100000,999999);
        $_SESSION['getRand'] = $randum;
        $mail = new PHPMailer(true);
        // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'tuyetnhung200201@gmail.com';                 // SMTP username
            $mail->Password = 'pevupqufusoaiatg';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('tuyetnhung200201@gmail.com', 'E-Shopper');

            $mail->addAddress($email, 'User');     // Add a recipient

            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reset password: '.$randum.'';
            $mail->Body    = '
            <p>Xin chào '.$item[0]['name'].', <br>
                    Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn. <br>
                    Nhập mã đặt lại mật khẩu sau đây: <br></p>
                    <span style="padding:15px;border:1px grey solid;font-size:22px">'.$randum.'</span>
                    <p>Cảm ơn bạn đã dùng dịch vụ của chúng tôi</p>
            ';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // header('location: ./forgot.php');
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        header('location: ./forgot.php?email=ok');
    } else {
        header('location: ./forgot.php?email=notEmail');
        // die;
    }
}
?>