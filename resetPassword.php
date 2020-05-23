<!--  ممنوووع الاقتراب من الملف ده --><!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->
<!--  منطقة محظووووووورة  -->


<?php
	if (isset($_GET["token"]) && isset($_GET["email"])) {
		$connection = new mysqli("localhost", "root", "", "fproject");
		
		$email = $connection->real_escape_string($_GET["email"]);
		$token = $connection->real_escape_string($_GET["token"]);

		$data = $connection->query("SELECT UserID FROM users WHERE Email='$email' AND token='$token' AND token <> '' AND expire > NOW()");

		if ($data->num_rows > 0) {
			$str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
			$str = str_shuffle($str);
			$str = substr($str, 0, 15);

			$password = sha1($str);

			$connection->query("UPDATE users SET Password = '$password', token = '' WHERE Email='$email'");

			echo "Your new password is: $str";
		} else {
			echo "Please check your link!";
		}
	} else {
		header("Location: login.php");
		exit();
	}
?>