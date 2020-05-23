<!-- navbar class "navbar", inverse **> change color from white to #222, not fixed top -->
<nav class="navbar navbar-inverse">
  <!-- class container not fulid that take fullwidth -->
  <div class="container">
      
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->      
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header"> 
      <!-- button for small screen like phone that collect links in dropdown -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <!-- brand logo or name --> 
        <a  class="navbar-brand" href="dashboard.php"><?php echo lang('HOME_ADMIN')?></a>
    </div>

<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->     
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav ">
          <li ><a href="uploads.php"><?php echo lang('UPLOADS')?></a></li>
          <li ><a href="location.php"><?php echo lang('Locations')?></a></li>
          <li ><a href="members.php"><?php echo lang('MEMBERS')?></a></li>
          <li ><a href="comments.php"><?php echo lang('COMMENTS')?></a></li>
          <li ><a href="feedback.php">Feedback</a></li>
          <li ><a href="favourite.php">Favourits</a></li>
      </ul>
        
        
        
    <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services
    <span class="caret"></span></a>
        
          <ul class="dropdown-menu">
              <li ><a href="car.php">Cars</a></li>
              <li ><a href="band.php">Bands</a></li>
              <li ><a href="photoghrapher.php">Photographer</a></li>          </ul>
        </li>
      </ul>         
        
        
        
        
        
        
        
        
        
        <!-- dropdown located on the right-->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MohammedKhalid
 <span class="caret"></span></a>
        
          <ul class="dropdown-menu">
            <li><a href="../index.php">Front Page</a></li>
            <li><a href="members.php?do=Edit&UserID=<?php echo $_SESSION['ID']?>">Edit Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>        
    </div>
      
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --><!-- ---------------------------------------------------------------------------------------------------------------------------------------------- --> 
      
  </div>
</nav>