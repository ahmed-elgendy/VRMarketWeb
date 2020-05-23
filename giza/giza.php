<?php 
session_start();

include 'init.php';



$stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                image 
                            WHERE 
                                city_id = 4

                          
                          ");
    $stmt->execute();
    //assign to variable 
    $upds = $stmt->fetchAll();   

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
      <!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    City
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="Giza.php">Giza</a>
    <a class="dropdown-item" href="Giza.php">Cairo</a>
    <a class="dropdown-item" href="Giza.php">6 October</a>
    <a class="dropdown-item" href="Giza.php">Fayom</a>
    <a class="dropdown-item" href="Giza.php">Dakhalia</a>
    <a class="dropdown-item" href="Giza.php">Sharm-Elshekh</a>
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
    <div class="row test" >

          <?php
          
$x=.4;	//	var_dump($upds);
$y=1;
$c=0;	//echo $upds['0']["img_id"];
	for($i=0;$i<count($upds);){
			for($j=0;$j<2;$j+=1)
				{
      if($c<=(count($upds)-1)){echo '<div class="col-lg-4 wow bounceInRight data-wow-delay="'.abs($x).'s" style="visibility: visible; animation-delay: '.abs($x).'s; animation-name: bounceInRight;">';
        echo '<div class="G">';
        
        $id = $upds[$c]['img_id'];


        echo '<a href="ms.php?imgid=' .$upds[$c]['img_id'] . '">';
        echo "<img src='" .$upds[$c]['normal_img_url'] .  "'/></a><br>";
        echo '</a>';
        
        echo '<h1>'.$upds[$c]['stars'].'</h1>' ;

        echo '<h5>Name:<small>'. $upds[$c]['img_name'].' </small></h5>' ;
      //  echo '<br>';
        
        echo '<h5>Description:<small>' .$upds[$c]['description'].'</small> </h5>' ;
       // echo '<br>';
        
        echo '<h5>Price:<small>'.$upds[$c]['price'].'</small> </h5>' ;
     //   echo '<br>';
   
       // echo '<br>';        
        
        
//        echo '<a class="waves-effect waves-light btn" href="">More</a>';
        
    echo    '<a class="waves-effect waves-light btn" href="ms.php?imgid=' . $upds[$c]['img_id'] . '">More Description</a>';
        echo '</div>';
        echo '</div>';
    //	$i++;



				// 	if($y==0){

				// 	$x-=.4;
				// }else {$x+=.4;}


				// 	if($j==2&&$y==0)
				// 		{	$x=.4;
				// 			$y=1;	
				// 			}
				// 	if($j==2&&$y==1)
				// 		{	$x=1.2;
				// 			$y=0;	
				// 			}



				// }$c++;

				    
					if($y==.4){

					$x-=.4;
				}else {$x+=.4;}


					if($j==2&&$y==0)
						{	$x=.4;
							$y=1;	
							}
					if($j==2&&$y==1)
						{	$x=1.2;
							$y=0;	
							}

								$i++;$c++;
				}
	}						//for($j=0;$j<3;$j++){
        }
//     foreach ($upds as $upd) {
    	
//     	//for($j=0;$j<3;$j++){
//         echo '<div class="col-lg-4 wow bounceInLeft data-wow-delay="'.$i.'s" style="visibility: visible; animation-delay: '.$i.'s; animation-name: bounceInLeft;">';
//         echo '<div class="G">';
        
//         $id = $upd['img_id'];


//         echo '<a href="ms.php?imgid=' . $upd['img_id'] . '">';
//         echo "<img src='../admin/layout/images/" . $upd['normal_img_url'] .  "'/></a><br>";
//         echo '</a>';
        
//         echo '<h1>'. $upd['stars'].'</h1>' ;

//         echo '<h5>Name:<small>'. $upd['name'].' </small></h5>' ;
//       //  echo '<br>';
        
//         echo '<h5>Description:<small>' . $upd['description'].'</small> </h5>' ;
//        // echo '<br>';
        
//         echo '<h5>Price:<small>'. $upd['price'].'</small> </h5>' ;
//      //   echo '<br>';
   
        
//        // echo '<br>';        
        
        
// //        echo '<a class="waves-effect waves-light btn" href="">More</a>';
        
//     echo    '<a class="waves-effect waves-light btn" href="ms.php?imgid=' . $upd['img_id'] . '">GO</a>';
//         echo '</div>';
//         echo '</div>';
    
//         $i-=.4;
//     } //}   

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

    <script src="js/bootstrap.min1.js"></script>
  </body>
</html>


