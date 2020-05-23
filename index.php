<?php 
ob_start();
session_start();
include 'init2.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){

  $email = $_POST['email'];
  $msg = $_POST['message'];
                //insert userinfo in database
  $stmt = $con->prepare("INSERT INTO 
    feedback (email, message)
    VALUES(:zemail, :zmessage)");
  $stmt->execute(array(

    'zemail'         => $email,
    'zmessage'     => $msg    
  ));
  
                //Echo Success Message ..
  echo "<div class = 'container'>";
  $successMsg = '<h2 class="msg-success">Thanks Your Message is recevired</h2>';
  echo "</div>";
}


/*
$userid = isset($_GET['UserID'])&&is_numeric($_GET['UserID'])?intval($_GET['UserID']):0;


$stmt = $con->prepare("SELECT 
                                * 
  FROM 
  users 
  WHERE 
  UserID = ?
  LIMIT 1");
$stmt->execute(array($userid));
$mems = $stmt->fetch();
$count = $stmt->rowCount();

*/
?>

<!--  منطقة محظووووووورة  -->


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
  <link rel="stylesheet" href="layout/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
  <link href="layout/css/carousel.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="layout/css/animate.min1.css">
  <link rel="stylesheet" type="text/css" href="layout/css/style1.css">
  <title> VR </title>
</head>
<body>

  <!--*******************end navegation********************-->
  <!--Start NAV-->
  <!-- header section -->
  
  


  <?php
  if(isset($_SESSION['user'])){ 
    ?>

    <section class="" role="banner"> 
      <!--header navigation -->
      <header id="head">
        <div class="header-content clearfix"> <a class="logo" href="#"><img src="layout/images/logo.png" alt=""></a>
          <nav class="navigation" role="navigation">
            <ul class="primary-nav">
              <li><a href="#intro">Intro</a></li>
              <li><a href="#places">Cities</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#download">Dowload</a></li>
              <li><a href="#contact">Feedback</a></li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Account
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#"><?php echo $_SESSION["user"]; ?></a>
                  <a class="dropdown-item" href="myFavourite.php">Profile</a>
                  <a class="dropdown-item" href="logout.php">Sign out</a>
                </div>
              </li>
              
              
            </ul>
          </nav>
          <a href="#" class="nav-toggle">Menu</a> 
        </div>
      </header>
      <!--header navigation --> 
    </section>



    <?php
  }
  else {?>
    <section class="" role="banner"> 
      <!--header navigation -->
      <header id="head">
        <div class="header-content clearfix"> <a class="logo" href="#"><img src="layout/images/logo.png" alt=""></a>
          <nav class="navigation" role="navigation">
            <ul class="primary-nav">
              <li><a href="#intro">Intro</a></li>
              <li><a href="#places">Cities</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#download">Dowload</a></li>
              <li><a href="#contact">Feadback</a></li>
              <li><a href="giza/giza.php">Giza</a></li>

              <li><a class="dis" href="login.php">Log IN-SignUp</a></li>
            </ul>
          </nav>
          <a href="#" class="nav-toggle">Menu<span></span></a> </div>
        </header>
        <!--header navigation --> 
      </section>
    <?php  } ?>

    <!--END NaV-->
    <!-- end nav-->




    <!--start intro-->
    <section id="intro">
     <div id="header" class="header">
       <div class="container">
         <div class="row">
           <div class="col-lg-12 col-md-12 align-center typeing">
             <div id="app">
              <span id="ityped"></span>               
            </div>
            <br />
          </div>

        </div>
      </div>

    </div>

    <div class="down-button">
      <a href="#" ><i class="fa fa-arrow-down"></i></a>
    </div>
  </section>
  <!--end intro-->

  <section id="" class="Services">
    <div class="container">

      <h2 class="wow fadeInUp" data-wow-delay="0.1"><span>How</span> It Works</h2>
      <div class="row">
        <div class="col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="1.8s">


         <h4></h4>
         <p>We are using 360-degree technology to represent halls so you can feel you already in the place and save your time and money</p>
       </div>


       <div class="col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="1.4s">

         <h4></h4>    
         <p>We offer you some of the services you might need and, We are ready to hear from you, Feel free to leave a feedback</p>

       </div>    
     </div>
   </div>
 </section> 


 <!--**********************start places************************-->
 <section id="places">
  <!-- Carousel Begins -->
  <div class="container app-container">
    <div class="row">
      <div class="col-lg-12 col-md-12 animated" data-animation="fadeInUp" data-animation-delay="800">
        <h1>our <span>Places</span></h1>
        <!-- Carousel Slider Container Begins -->
        <div id="places-carousel" class="owl-carousel app-carousel-slider">
          <!-- Item 1 -->
          <div class="screen-item">
           <a href="giza/giza.php">
            <img src="layout/images/places/giza.jpg" width="314" height="236"  alt="giza" class="img-responsive" />
            <h2>Giza</h2>
          </a>
          
        </div>
        <!-- Item 2 -->
        <div class="screen-item">
         <a href="">
          <img src="layout/images/places/cairo.jpg" width="314" height="236"  alt="cairo" class="img-responsive" />
          <h2>Cairo</h2>
        </a>
      </div>
      <!-- Item 3 -->
      <div class="screen-item">
       <a href="">
        <img src="layout/images/places/alex.jpg" width="314" height="236" alt="Alex" class="img-responsive" />
        <h2>Alexandria</h2>
      </a>
      
    </div>
    <!-- Item 4 -->
    <div class="screen-item">
     <a href="">
      <img src="layout/images/places/fayom.jpg" width="314" height="236"  alt="Fayoum" class="img-responsive" />
      <h2>Fayom</h2>
    </a>                           
  </div>
  <!-- Item 5 -->
  <div class="screen-item">
   <a href="">
    <img src="layout/images/places/dakhalia.jpg" width="314" height="236" alt="Dakhalia" class="img-responsive" />
    <h2>Dakhalia</h2>
  </a>                          
</div>
<!-- Item 6 -->
<div class="screen-item">
 <a href="">
  <img src="layout/images/places/sharm.jpg" width="314" height="236" alt="sharm" class="img-responsive" />
  <h2>Sharm-Elshekh</h2>
</a>
</div>
</div><!-- Carousel Slider Container Ends -->
</div>
</div>
</div>
</section>
<!-- Carousel Ends -->
<!--********************end places****************************-->

<!-- Service-->


<section id="services" class="Services">
  <div class="container">

    <h2 class="wow fadeInUp" data-wow-delay="0.1">Services</h2>
    <p class="wow fadeInUp" data-wow-delay="0.4">we have alot of services that we are using VR Technology and More!</p>
    <div class="row">
      <div class="col-lg-4 col-md-4 wow fadeInLeft" data-wow-delay="1.8s">
       <a href="Services/weddingCar.php"> <i class="fa fa-car"></i>

         <h4>Wedding car</h4></a> 
         <p>Our promotional offers of cars for rent, ensuring that customers get value for money.</p>
       </div>

       <div class="col-lg-4 col-md-4 wow fadeInLeft" data-wow-delay="1.4s">
        <a href="Services/photographer.php"> <i class="fa fa-camera"></i>
          <h4>Photo and video</h4></a> 
          <p>We have Photography & Video available to you, both out of the hands of our experiences</p>

        </div>
        <div class="col-lg-4 col-md-4 wow fadeInLeft" data-wow-delay="0.8s">
         <a href="Services/musicBand.php">  <i class="fa fa-music"></i>
          <h4>Music band</h4></a> 
          <p>Find a wide range of wedding bands, djs and singers of the perfect wedding music.</p>

        </div>
        
      </div>
    </div>
  </section>
  <!-- end services-->
  <!--**********************start Gallery************************-->
<!--********************
<section id="galley">
  <div class="container">
    <div class="row">
      <div class="filter-list">
        <h3>our Amaizing Services</h3>
        <button class="btn btn-default filter-button active" data-filter="all">All</button>
        <button class="btn btn-default filter-button" data-filter="hall">Wedding Halls</button>
        <button class="btn btn-default filter-button" data-filter="wedding">Wedding Car</button>
        <button class="btn btn-default filter-button" data-filter="music">Music Bands</button>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 product filter wedding">
         <div class="hovereffect">
              <img src="images/wedding1.jpg" title="Product name" alt="Product name">
              <div class="overlay">
                 <h2>Audi</h2>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                 </p>
                 <a class="info" href="#">Show Me!</a>
              </div>
         </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 product filter hall">
         <div class="hovereffect">
              <img src="images/rest1.jpg" title="Product name" alt="Product name">
              <div class="overlay">
                 <h2>Hall 1</h2>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                 </p>
                 <a class="info" href="#">Show Me!</a>
              </div>
         </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 product filter music">
         <div class="hovereffect">
              <img src="images/music1.jpg" title="Product name" alt="Product name">
              <div class="overlay">
                 <h2>Band 1</h2>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                 </p>
                 <a class="info" href="#">Show Me!</a>
              </div>
         </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 product filter hall">
         <div class="hovereffect">
              <img src="images/rest2.jpg" title="Product name" alt="Product name">
              <div class="overlay">
                 <h2>Hall 2</h2>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                 </p>
                 <a class="info" href="#">Show Me!</a>
              </div>
         </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 product filter music">
        <div class="hovereffect">
              <img src="images/music2.jpg" title="Product name" alt="Product name">
              <div class="overlay">
                 <h2>Band 2</h2>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                 </p>
                 <a class="info" href="#">Show Me!</a>
              </div>
         </div>
      </div>
      
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 product filter wedding">
        <div class="hovereffect">
              <img src="images/wedding3.jpg" title="Product name" alt="Product name">
              <div class="overlay">
                 <h2>Mini Cooper</h2>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                 </p>
                 <a class="info" href="#">Show Me!</a>
              </div>
         </div>
      </div>
    </div>
  </div>
</section>
****************************-->
<!--********************end Gallery****************************-->
<!-- Download-->
<section id="download">
  <div class="overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-12 align-center">
          <h2 class="download">Download App Now!</h2>
          <i class="fa fa-android float-right"></i>
          <i class="fa fa-android float-left"></i>
          <button class="btn btn--android btn--radius">
            <!--start android svg-->
            <svg class="btn__logo" version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="708.662px" height="708.662px" viewBox="0 0 708.662 708.662" enable-background="new 0 0 708.662 708.662"
            xml:space="preserve">
            <path id="c" fill="#FFFFFF" d="M607.229,229.405L607.229,229.405c-26.838,0-48.596,21.756-48.596,48.594v172.106
            c0,26.838,21.758,48.594,48.596,48.594l0,0c26.839,0,48.595-21.756,48.595-48.594V277.997
            C655.823,251.159,634.067,229.405,607.229,229.405z"/>
            <path fill="#FFFFFF" d="M538.536,220.405c0-62.651-36.705-117.381-91.341-146.892l27.939-50.406
            c3.523-6.357,1.228-14.368-5.131-17.893c-6.357-3.523-14.367-1.228-17.891,5.131l-28.973,52.267
            c-21.274-7.918-44.514-12.287-68.859-12.287c-27.511,0-53.606,5.574-77.05,15.552l-30.781-55.53
            c-3.524-6.357-11.534-8.654-17.892-5.131c-6.357,3.523-8.654,11.534-5.13,17.893l30.344,54.741
            c-50.414,30.348-83.744,82.855-83.744,142.557L538.536,220.405L538.536,220.405z M264.242,148.322
            c-6.039,0-10.933-4.895-10.933-10.933s4.895-10.935,10.933-10.935c6.038,0,10.933,4.896,10.933,10.935
            S270.28,148.322,264.242,148.322z M434.322,148.322c-6.039,0-10.933-4.895-10.933-10.933c0-6.037,4.894-10.935,10.933-10.935
            s10.932,4.896,10.932,10.935C445.253,143.427,440.361,148.322,434.322,148.322z"/>
            <path fill="#FFFFFF" d="M170.241,240.093v269.753c0,24.602,19.943,44.545,44.545,44.545h17.06v92.115
            c0,26.838,21.756,48.594,48.594,48.594s48.594-21.756,48.594-48.594v-92.115h40.496v92.115c0,26.838,21.756,48.594,48.594,48.594
            s48.594-21.756,48.594-48.594v-92.115h27.486c24.602,0,44.545-19.943,44.545-44.545V240.093H170.241z"/>
            <path id="c_2_" fill="#FFFFFF" d="M101.435,229.405L101.435,229.405c-26.838,0-48.596,21.756-48.596,48.594v172.106
            c0,26.838,21.758,48.594,48.596,48.594l0,0c26.838,0,48.594-21.756,48.594-48.594V277.997
            C150.028,251.159,128.272,229.405,101.435,229.405z"/>
          </svg>
          <!--End android svg-->
          <div class="btn__content btn__content--big">Download</div>
        </button>
      </div>
    </div>
  </div>
</div>
</section>

<!-- end  Download-->



<!--**************** Contact-**************-->

<section id="contact" class="Contact">
  <?php if(isset($_SESSION['user'])){ ?>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">                        
          <h2><span>Send</span> Your Feedback</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
          <div class="overlay align-center">
            <i class="fa fa-paper-plane"></i>
            <h2>we love to hear from you</h2>
          </div>
        </div>


        <!--  منطقة محظووووووورة  -->
        <!--  منطقة محظووووووورة  -->
        

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
          <form id="contact-form" class="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" role="form">
             <!--
              <div class="form-group">
                  <label class="form-label" for="name">Your Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Your name" tabindex="1" required>
              </div> 
            -->
            <div class="form-group">
              <label class="form-label" for="email">Your Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" tabindex="2" required>
            </div>  
              <!--
              <div class="form-group">
                  <label class="form-label" for="subject">Subject</label>
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" tabindex="3">
              </div> 
            -->
            <div class="form-group">
              <label class="form-label" for="message">Message</label>
              <textarea rows="5" cols="50" name="message" class="form-control" id="message" placeholder="Message..." tabindex="4" required></textarea>                                 
            </div>
            <div class="text-center">
              <button id="feedback" type="submit" class="btn btn-start-order">Send Feedback</button>
              <h2 class="text-center none">Thanks</h2>
            </div>
          </form>
        </div>
          <! -- .. -->
      <?php
           if(isset($successMsg)){
            echo '<div class="msg success">' . $successMsg . '</div>';
        }
    
    
    }else { ?>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-12">
              <div class="normal-info">
                <h2>Contact US</h2>
                <h4>Email: wedgo@info.com</h4>
                <h4>Phone: +20 0100000000</h4>
                <h4>Address: 6 of october</h4>
              </div>
            </div> 
          </div>
        </div>
        
      <?php } ?>

      <!--  منطقة محظووووووورة  -->
      <!--  منطقة محظووووووورة  -->



    </div>
  </div>
</section>
<!-- End Contact-->



<!-- footer Start -->
<footer id="footer" class="page-section container">
  <div class="row">
    <!-- logo -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
      <img src="layout/images/logo.png" alt=" " class="responsive-img ">
      <!-- SOCIAL ICONS -->
      <ul class="social-icons ">
       <li><a href=" "><i class="fa fa-facebook " aria-hidden="true "></i></a></li>
       <li><a href=" "><i class="fa fa-twitter " aria-hidden="true "></i></a></li>
       <li><a href=" "><i class="fa fa-pinterest-square " aria-hidden="true "></i></a></li>
       <li><a href=" "><i class="fa fa-google-plus-official " aria-hidden="true "></i></a></li>
       <li><a href=" "><i class="fa fa-instagram " aria-hidden="true "></i></a></li>
       <li><a href=" "><i class="fa fa-dribbble " aria-hidden="true "></i></a></li>
     </ul>

     <!-- COPYRIGHT TEXT -->
     <p class="copyright ">
      ©2018 <span>VR Team</span>, All Rights Reserved
    </p>
  </div>
</div>

</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript" src="layout/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="layout/js/jquery.fancybox.pack.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="layout/js/index1.js"></script>
<script src="layout/js/wow.min1.js"></script>
<script>
  new WOW().init();
  ityped.init("#ityped");
</script>

<script src="layout/js/bootstrap.min1.js"></script>
<script type="text/javascript" src="layout/js/carousel.min1.js"></script>
<script type="text/javascript" src="layout/js/plugin1.js"></script>
</body>
</html>

<?php    
ob_end_flush();
?>
