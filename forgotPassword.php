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
	if (isset($_POST["forgotPass"])) {
    include 'admin/config.php';
        
        
    $email = $_POST['email'];
    
    $stmt = $con->prepare("SELECT 
                               UserID
                          FROM 
                                users 
                          WHERE 
                                Email = '$email' 
                          ");
    
    
    $stmt->execute(array($email));
    $get = $stmt->fetch();
    $count = $stmt->rowCount();
    

		if($count > 0 ) {
			$str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
			$str = str_shuffle($str);
			$str = substr($str, 0, 10);
			$url = "http://domain.com/members/resetPassword.php?token=$str&email=$email"; //will change it

			//mail($email, "Reset password", "To reset your password, please visit this: $url", "From: myanotheremail@domain.com\r\n");

			$con->query("UPDATE users SET token='$str' WHERE Email='$email'");

			echo "Please check your email!";
		} else {
			echo "Please check your inputs!";
		}
	}
?>
<html>
    <head>
    
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    
    </head>
    
	<body>
		<form action="forgotPassword.php"  method="post">
			<input type="text" name="email" placeholder="Email"><br>
			<input type="submit" name="forgotPass" value="Request Password">
		</form>
        
        
	</body>
</html>

