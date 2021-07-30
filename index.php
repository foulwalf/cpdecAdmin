<?php
session_start();
if (isset($_POST['email']) && isset($_POST['pass'])){
    include 'model/admin.php';
    $login = login($_POST['email'],$_POST['pass']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CPDEC Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<!--<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="views/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome-free/css/all.css">

<!--===============================================================================================-->
	<!--<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">-->
<!--===============================================================================================-->
<!--	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">-->
<!--===============================================================================================-->
<!--	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">-->
<!--===============================================================================================-->
<!--	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="views/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="views/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body style="font-family: sans-serif,'Times New Roman'">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title p-b-33">
						CPDEC ADMIN
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password" id="password">
                        <i class="fa fa-eye show" style="position: absolute;right: 5px;top: 39%; font-size: large; cursor: pointer"></i>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							Connexion
						</button>
					</div>


				</form>
			</div>
		</div>
	</div>



<!--===============================================================================================-->
	<script src="views/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--	<script src="login/vendor/animsition/js/animsition.min.js"></script>-->
<!--===============================================================================================-->
	<script src="views/login/vendor/bootstrap/js/popper.js"></script>
	<script src="views/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="views/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="views/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="views/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<!--	<script src="login/vendor/countdowntime/countdowntime.js"></script>-->
<!--===============================================================================================-->
	<script src="views/login/js/main.js"></script>
    <script src="assets/plugins/bootstrap-notify.js"></script>
    <script>
        $(document).ready(function () {
            var i = 0;
            $(".show").click(function () {
                i++;
                if (i%2 != 0) {
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash")
                    $("#password").attr("type","text")
                } else {
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye")
                    $("#password").attr("type","password")
                }
            })
        })
    </script>


</body>
</html>