<?php

session_start();
if (isset($_SESSION['UserName'])){
    $pageTitle = 'Dashboard';
    include 'init.php';
    
     /* Start dashboard page */  
    
   ?> 
    
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->

    <div class="home-stats">
    <div class="container text-center">
        <h1><div class="text-center Dashboard">Dashboard</div></h1>
        <div class="row">
            
            <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Total Members</span>
                    <span><a href= "members.php"><?php echo countItems('UserID', 'users') ?></a></span> 
                </div>    
            </div>
            
            
            <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Pending Members</span>
                    <span><a href ="members.php?do=Manage&page=pending"><?php echo CheckItem("RegStatus", "users", 0)?></a></span>
                </div>
            </div>
         
            
             <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Total Images</span>
                    <span><a href ="uploads.php"><?php echo CountItems("img_id", "image")?></a></span>
                </div>
            </div>
            
             <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Total Locations</span>
                    <span><a href= "location.php"><?php echo countItems('city_id', 'city') ?></a></span> 
                </div>    
            </div>
            
             <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Feedback</span>
                    <span><a href= "feedback.php"><?php echo countItems('feedback_id', 'feedback') ?></a></span> 
                </div>    
            </div>  
            
             <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Favourites</span>
                    <span><a href= "favourite.php"><?php echo countItems('favourite_id', 'favourite') ?></a></span> 
                </div>    
            </div>   
            
            
             <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Cars</span>
                    <span><a href= "car.php"><?php echo countItems('car_id', 'wedding_car') ?></a></span> 
                </div>    
            </div>  
            
             <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Music Band</span>
                    <span><a href= "band.php"><?php echo countItems('music_band_id', 'music_band') ?></a></span> 
                </div>    
            </div>   
            
            
             <div class="col-md-4">
                <div class="stat">
                    <span class="label label-info">Photoghraphers</span>
                    <span><a href= "photoghrapher.php"><?php echo countItems('photographer_id', 'photographer') ?></a></span> 
                </div>    
            </div>               
            
        </div>
    </div>
</div>

<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->

<?php

}
else {
    header('Location: index.php');
    exit();
}

