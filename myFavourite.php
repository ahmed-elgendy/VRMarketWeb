<?php
ob_start();
session_start();
include "init.php"; 
if(isset($_SESSION['user'])){
echo '<h2 class="text-center">Profile</h2>';    
$getUser = $con->prepare("SELECT * FROM users WHERE UserName = ?");
$getUser->execute(array($sessionUser));
$info = $getUser->fetch();
    
echo "<h1>account data</h1>";    
echo "UserName: " . $info['UserName'] . "<br>";     
echo "Email: " . $info['Email'] . "<br>";    
echo "Full name: " . $info['FullName'];    
    

    
  if (! empty(getItem('user_id', $info['UserID']))) {
      echo '<div class="container">';
 echo '<div class="row">';
      
                echo "<h1>Your Favourites</h1>";
      
     
      foreach (getItem('user_id', $info['UserID'], 1) as $item){
           echo '<div class="col-sm-6 col-md-3">';
           echo '<div class="caption">';
                         echo '<p>' . $item['img_id'] . '</p>';
                 echo '</div>';
                    echo '</div>';
            }
                echo '</div>';
  }
}

?>
<hr>
<hr>

 
                <h2>الصفحة دي بتعرض ع الشمال فوق بيانات العميل علي حسب اللي عامل تسجيل دخول وتحت الارقام دي هي القاعات اللي العميل ده اختارهم عشان يضافوا لقايمة مفضلاته ناقص هنا اني اخليها بتتعرض بالبيانات بتاعتها لكن كده معروض ال اي دي بتاعهم بس واني اخلي اليوزر هو اللي يختار من القاعات المعروضه الي عايز يضيفهم لقايمة المفضلات بس لسه مش عارف اعملها انا دخلتهم بايدي م خلال الداتا بيز ناقص اني اعمل زرار علي كل قاعة معروضه ف الموقع لما العميل يدوس عليه تضاف لقايمة المفضلات </h2>
