<?php
session_start();

require_once('../backend/db/dbhelper.php');

$email = 0;
$rand = 0;
if (isset($_GET['email']) && $_GET['email']) $email = $_GET['email'];

if (isset($_SESSION['getRand'])) {
    $rand = $_SESSION['getRand'];
}


$checkSecurity = 0;
if (isset($_POST['continue']) && $_POST['continue']) {
    $number = $_POST['security'];

    if ($rand == $number) {
        header('location: ./forgot.php?email=fist');
    } else {
        $checkSecurity = 1;
    }
}


$checknewPass =1;
if(isset($_SESSION['email'])) ;
if(isset($_POST['addNewPass']) && $_POST['addNewPass']){ 


    if(strlen($_POST['newpass'])>5){
        $newpass = md5($_POST['newpass']);
        
        $sql = "UPDATE `user` SET `password` = '".$newpass."' WHERE `user`.`email` = '".$_SESSION['email']."'";
        execute($sql);
        $checknewPass =0;
        header('location: login.php');
    }

}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../fontend/css/forgot.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</head>

<body>
    <div class="container padding-bottom-3x mb-2 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="forgot">

                    <h2>Forgot your password?</h2>
                    <p>Change your password in three easy steps. This will help you to secure your password!</p>
                    <ol class="list-unstyled">
                        <li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
                        <li><span class="text-primary text-medium">2. </span>Our system will send you a 6-digit security code.
                        </li>
                        <li><span class="text-primary text-medium">3. </span>Use the security code to reset your password.</li>
                    </ol>

                </div>

                <?php
                if (!isset($_GET['email']) || $_GET['email'] == 'notEmail') { ?>
                    <form class="card mt-4" action="./sentEmail.php" method="post">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="email-for-pass">Enter your email address</label>
                                <input name="email" class="form-control" type="text" id="" required="">
                                <small class="form-text text-muted">Enter the email address you used during the registration on
                                    BBBootstrap.com. Then we"ll email a link to this address.
                                </small>
                            </div>
                            <p style="color:red">
                                <?php
                                echo ($email == "notEmail") ? "Email does not exist" : "";
                                ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" type="submit" name="getNewPass" value="Get New Password"></input>
                            <button class="btn btn-danger" type="submit"><a href="./login.php">Back to Login</a></button>
                        </div>
                    </form>

                <?php
                } elseif (!isset($_GET['email']) || $_GET['email'] == 'ok') { ?>
                    <form class="card mt-4" action="" method="post">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="email-for-pass">Enter the security code:</label>
                                <input name="security" class="form-control" type="number" id="" placeholder="_ _ _ _ _ _" required="">
                                <small class="form-text text-muted">We have sent you the code to your email. This code consists of 6 numbers.
                                </small>
                            </div>
                            <p style="color:red">
                                <?php
                                echo ($checkSecurity == 0) ? "" : "Incorrect code";
                                ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" type="submit" name="continue" value="Continue"></input>
                            <button class="btn btn-danger" type="submit"><a href="./login.php">Back to Login</a></button>
                        </div>
                    </form>

                <?php
                } elseif (!isset($_GET['email']) || $_GET['email'] == 'fist') { ?>

                    <form class="card mt-4" action="" method="post">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="email-for-pass">Choose a new password:</label>
                                <input name="newpass" class="form-control" type="password" id="" required="">
                                <small class="form-text text-muted">Create a new password with a minimum of 6 characters. A strong password is a password that is a combination of characters, numbers, and punctuation.
                                </small>
                            </div>
                            <p style="color:red">
                                <?php
                                if(isset($_POST['addNewPass']) && $_POST['addNewPass']){
                                     echo ($checknewPass == 0) ? "" : "Create a new password with a minimum of 6 characters";
                                }
                                ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" type="submit" name="addNewPass" value="Continue"></input>
                            <button class="btn btn-danger" type="submit"><a href="./login.php">Back to Login</a></button>
                        </div>
                    </form>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>