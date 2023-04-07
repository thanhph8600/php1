<?php
session_start();
if(empty($_SESSION['user'])) $_SESSION['user'] = [];
require('../backend/db/dbhelper.php');

setcookie("age", "18", time()+3600, "/", "",  0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

    <!-- <link href="../eshopper-1.0.0/css/style.css" rel="stylesheet"> -->
    <!-- <link href="../eshopper-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->

	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
	<link rel="stylesheet" href="../fontend/css/login.css">
	
</head>

<body>
	<div class="header">
		<div class="">
            <div class="">
                <a href="index.php" class="">
                    <h2 class="">
						<span class="header-E">E</span >
						<span class="header-S">Shopper</span>
					</h2>
                </a>
            </div>

        </div>
	</div>


<?php

$checklogin = false;


if (isset($_POST['signUp']) && $_POST['signUp']) {
	$checkSignUp = 0;

	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$pass = md5($_POST['password']);

	$sqlEmail = 'SELECT * FROM `user` WHERE email = "' . $email . '"';
	$checkEmail = executeResult($sqlEmail);
	if (empty($checkEmail)) {
		echo '<p style="color:green;">Sign Up Success</p>';

		$sql = 'INSERT INTO `user` (`id`, `name`, `phone`, `email`, `password`) VALUES (NULL, "' . $name . '", "' . $phone . '", "' . $email . '", "' . $pass . '")';

		execute($sql);
	} else {
		echo '<p style="color:red;">Email already in use, please use another email</p>';
	}
}


if (isset($_POST['signIn']) && $_POST['signIn']) {
	// $checkSignIn = 1;

	$email = $_POST['email'];
	$pass = md5($_POST['password']);

	$sqlEmail = 'SELECT * FROM `user` WHERE email = "'.$email.'"';

	$checkEmail = executeResult($sqlEmail);
	
	if($checkEmail){
		if($checkEmail[0]['email'] == $email && $checkEmail[0]['password'] ==$pass ) {
				$_SESSION['user']  = $checkEmail[0];
				echo '<p style="color:red;">OK</p>';
				header("location: index.php");
		}else {
			// echo '<p style="color:red;">Your username or account is incorrect</p>';
			$checklogin = 'Your username or account is incorrect';
		}
	}else {
		// echo '<p style="color:red;">Your username or account is incorrect</p>';
		$checklogin = 'Your username or account is incorrect';

	}

}

?>




	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="" method="post" onsubmit="return createFrom()">
				<h1>Create Account</h1>
				<span>use your email for registration</span>
				<input id="nameCreate" name="name" type="text" placeholder="UserName" value="" onkeypress="createFrom()" onkeydown="createFrom()" onkeyup="createFrom()" />
				<input id="phoneCreate" name="phone" type="number" placeholder="Phone number" value="" onkeypress="createFrom()" onkeydown="createFrom()" onkeyup="createFrom()" />
				<input id="emailCreate" name="email" type="email" placeholder="Email" value="" onkeypress="createFrom()" onkeydown="createFrom()" onkeyup="createFrom()" />
				<input id="passCreate" name="password" type="password" placeholder="Password" value="" onkeypress="createFrom()" onkeydown="createFrom()" onkeyup="createFrom()" />
				<input name="signUp" type="submit" value="Sign Up">
				<p id="checkCreate" style="color:red;">

				</p>
			</form>
		</div>


		<div class="form-container sign-in-container">
			<form action="" method="post" onsubmit="return signInFrom()">
				<h1>Sign in</h1>
				<span>or use your account</span>
				<input id="emailSignIn" name="email" type="text" placeholder="Email" />
				<input id="passSignIn" name="password" type="password" placeholder="Password" />
				<a href="./forgot.php">Forgot your password?</a>
				<span style="color:red"><?= $checklogin ?></span>
				<input name="signIn" onclick="signUp()" type="submit" value="Sign In">
				<p id="checkSignIn" style="color:red;">
					<?php
					// $echo = ($checkSignIn==1) ? 'Incorrect account or password' : '';
					// echo  $echo;
					?>
				</p>
			</form>
		</div>


		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Enter your personal details and start journey with us</p>
					<button  class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>


</body>
<script src="../fontend/js/index.js">
</script>

</html>
