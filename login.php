<?php
ob_start();
session_start();
$pageTitle = 'Login';

if (isset($_SESSION['UserName'])){
   header('Location: index.php');
}

include 'init.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['login'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        //$hashedpass = sha1($pass);
        
//check if the user exist in database
        
        
        $stmt = $con->prepare("SELECT 
            UserID, UserName, Password 
            FROM 
            users 
            WHERE 
            UserName = ? 
            AND 
            Password = ? 
            AND
            RegStatus = 1
            ");
        
        
        $stmt->execute(array($user,$pass/*, $hashedpass*/));
        $get = $stmt->fetch();
        $count = $stmt->rowCount();
        
        if($count > 0 ){
            $_SESSION['user'] = $user;
            $_SESSION['uid']  = $get['UserID'];
            header('Location:index.php');
            exit();
        }
        
    }else{
        $formErrors = array();
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email    = $_POST['email'];
        $name    = $_POST['name'];
        
        if(isset($username)){
            $filterUser = filter_var($username, FILTER_SANITIZE_STRING);
            if(strlen($filterUser) < 4) {
                $formErrors[] = 'Username Must Be Larger Than 4 Characters';
            }
        }
        
        if(isset($password)){
            if(empty($password)){
                $formErrors[] = 'Sorry Password Can not Be Empty';
            }
            $pass = $password;// deleted sha1()
        }
        
        $formErrors = array();
        if(isset($email)){
            $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true) {
                $formErrors[] = 'This Email Is Not Valid';
            }
        }
        
        if (empty($formErrors)) {
                //check if user exist in database
            $check = checkItem("UserName", "users", $username);
            if($check == 1){
             $formErrors[] = 'Sorry, This User Is Exists';
         }
         
         $check = checkItem("Email", "users", $email);
         if($check == 1){
             $formErrors[] = 'Sorry, This Email Is Exists';
         }    
 
         else {
               //insert userinfo in database
            $stmt = $con->prepare("INSERT INTO 
              users(UserName, Password, Email, FullName, RegStatus, Date) 
              VALUES(:zuser, :zpass, :zmail, :zfullname, 0, now())");
            $stmt->execute(array(
                'zuser'         => $username,
                'zpass'         => $password,
                'zmail'         => $email,
                'zfullname'     => $name    
            ));
            
           //mailer  
             { 
    $str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
    $str = str_shuffle($str);
    $str = substr($str, 0, 10);
    $url = "https://rotq4all.000webhostapp.com/verifyRegister/confirm.php?token=$str&Email=$email";
     mail($email, "Confirmation", "To confirm your email, please visit this: $url", "From: VRMarketting@email.com\r\n");
    $stmt1=$con->prepare("UPDATE users SET token='$str' WHERE Email='$email' ");
            $stmt1->execute(array($str,$email));

    /*
    $result["success"]=true;
    $result["message"]="Your Confirmation link Has Been Sent To Your Email Address";
echo json_encode($result);

          mysqli_close($connection);
  
*/
             }
                //Echo Success Message 
            echo "<div class = 'container'>";
            $successMsg = 'Your Confirmation link Has Been Sent To Your Email Address';
             //    $successMsg = 'Congrats You Are Now Registerd User';
            echo "</div>";
        }
    }
}
}
?>
<link href="layout/css/login.css" rel="stylesheet" type="text/css" media="all"/>

    <nav>
        <div>
            <a href="index.php" class="log-logo">
               <img src="layout/images/logo.png"> 
            </a>
            <a class="log-home" href="index.php">Home</a>
        </div>
    </nav>
<div class="container login-page">
    <h1 class="text-center">
        <span class="selected btn btn-primary" data-class="login">Login</span> 
        <span class="btn btn-success" data-class="signup">SignUp</span>
    </h1>
    <!--start login form-->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <p>User Name</p>
        <input class="form-control" type="text" name="username" autocomplete="off" placeholder="UserName" />
        <p>Password</p>
        <input class="form-control" type="password" name="password" autocomplete="new-passowrd" placeholder="Password"/>
        <input class="btn btn-primary btn-block" name="login" type="submit" value="Login" />
        <a href="forgotPassword.php">Forget Password?</a>
    </form>
    <!--end login form-->
    
    
    
    <!--start signup form-->
    <form class="signup" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <p>User Name</p>
        <div class="input-container agileinfo">
            <input pattern=".{4,}" title="Username Must Be More Than 4 Chars" class="form-control transparent" type="text" name="username" autocomplete="off" placeholder="UserName" required="required"/>
        </div>
        
        <div class="input2-container agileinfo">
            <p>Email</p>
            <input class="form-control" type="email" name="email" autocomplete="off" placeholder="Email" required="required"/>
        </div>
        
        <div class="input3-container agileinfo">
            <p>Password</p>
            <input minlength="4" class="form-control transparent" type="password" name="password" autocomplete="new-passowrd" placeholder="Password" required="required"/>
        </div>
        
        <div class="input4-container agileinfo">
            <p>Full Name</p>
            <input class="form-control" type="text" name="name" autocomplete="off" placeholder="Full Name" required="required"/>
        </div>        


        <input class="btn btn-success btn-block" name="signup" type="submit" value="SignUp" />
    </form>
    <div class="the-errors text-center">
        <?php
        if(!empty($formErrors)){
           foreach ($formErrors as $error){
               echo $error . '<br>';
           }   
       }
       
       if(isset($successMsg)){
          echo '<div class="msg success">' . $successMsg . '</div>';
      }
      ?>
  </div>
</div>

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>