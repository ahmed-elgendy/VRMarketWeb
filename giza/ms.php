<?php 
session_start();

    include 'init.php';

 $imgid = isset($_GET['imgid'])&&is_numeric($_GET['imgid'])?intval($_GET['imgid']):0;


$stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                image 
                            WHERE 
                                img_id = ?

                          ");
    $stmt->execute(array($imgid));
    $count = $stmt->rowCount();
    //assign to variable 
    $upds = $stmt->fetch();   

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min1.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/animate.min1.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="css/Giza.css">
    <title> Giza</title>
  </head>
  <body>

    <!--*******************end navegation********************-->



  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
        
      <li class="nav-item active">
        <a class="nav-link" href="giza.php">Back <span class="sr-only">(current)</span></a>
      </li>      <!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    city
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="Giza.html">Giza</a>
    <a class="dropdown-item" href="Cairo.html">Cairo</a>
    <a class="dropdown-item" href="Al-Dakahlia.html">Al-Dakahlia</a>
    <a class="dropdown-item" href="Menoufia.html">Menoufia</a>
    <a class="dropdown-item" href="October.html">October</a>
    <a class="dropdown-item" href="Sharm El-Shaikh.html">Sharm El-Shaikh</a>
  </div>
</div>
        <?php
        if(!isset($_SESSION['user'])){ ?>
          <li class="nav-item">
        <a class="nav-link" href="../login.php">Login</a>
      </li>
        <?php }
        else { ?>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">LogOut</a>
      </li>
            
        <?php } ?>
    </ul>
  </div>
</nav>
<!--******************* end nav***************-->
<br>
<br>
<br>
<br>


<div class="container">
    <div class="row test">

          <?php

if(isset($_SESSION['user'])){

        echo '<div class="col-lg-12 wow bounceInLeft data-wow-delay="1.2s">';
        echo '<div class="G">';
        
        
        
        
                echo "<iframe frameborder='0' width=100% height=500px allowfullscreen src='" .  $upds['multi_img_url'] . "'</iframe>";
            
        
        
        echo '</div>';
        echo '</div>';
      
} else {
    
    
        
        echo '<div class="col-lg-12 wow bounceInLeft data-wow-delay="1.2s">';
        echo '<div class="G">';
        
        
        
        echo "<iframe frameborder='0' width=100% height=500px allowfullscreen src='" .  $upds['single_img_url'] . "'</iframe>";
        
        
        
        echo '</div>';
        echo '</div>';
    
    
    
            
        echo '<div class="col-lg-12 wow bounceInLeft data-wow-delay="1.2s">';
        echo '<div class="s">';
        
        
        
        echo $upds['description'];
        
        
        
        echo '</div>';
        echo '</div>';
    
    
    
    
    
        
          
    
}
?>
</div>
      </div>
      

  <!--************************** row 3**********************-->


<br>


</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>

    <script src="js/wow.min1.js"></script>
       <script>
        new WOW().init();
    </script>

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


