<?php
ob_start();
/*
============================================
== Manage location Page
== you can add edit delete location from here
============================================
*/

session_start();
$pageTitle = 'Locations';
if (isset($_SESSION['UserName']))
{
    include 'init.php';
    include $tpl . 'footer.php';
        
     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    
/*================================================================================================================================================*/
/*   =========================================                         Manage                    ==============================================*/
/*================================================================================================================================================*/
    
if($do == 'Manage')
{
    
    $stmt = $con->prepare("SELECT * FROM city");
    $stmt->execute();
 //assign to variable 
    $locs = $stmt->fetchAll();
?>




<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->





<h1 class="text-center Dashboard">Manage Locations</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="main-table manage-members text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>City</td>               
                    <td>Control</td>
                </tr>
                
<?php

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------------------- */

foreach($locs as $loc)
        {
            echo "<tr>";
            
            echo "<td>" . $loc['city_id'] . "</td>";
            echo "<td>" . $loc['city_name'] . "</td>";
                           
                      echo "<td>
                      <a href='location.php?do=Edit&locid=" . $loc['city_id'] ." ' class='btn btn-success btn-control'><i class= 'fa fa-edit'></i>Edit</a>      
                                 
                      <a href='location.php?do=Delete&locid=" . $loc['city_id'] . "' class='btn btn-danger confirm btn-delete'><i class= 'fa fa-close'></i>Delete</a>";
                       echo  "</td>";  
            
            echo "</tr>";
                        
        }
    
?>
                
                <tr>               
            </table>
        </div>
            <a href="location.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add Location</a>      
      </div>

             
<?php    }
   
/*--------------------------------------------------------------------------------------------------------------------------------------------------  
-------------------------------------------                           ADD                               --------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------------*/
    
    
    
elseif($do== 'Add') {
    
?>

     <div class="container add">  
          <form id="contact" action="?do=Insert" method="POST" enctype="multipart/form-data">
              
            <h3>Add Location</h3>

            <fieldset>
                <input placeholder="Location" type="text" name="location" required>
            </fieldset>

            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Add</button>
            </fieldset>
              
          </form>
     </div>



<!--------------------------------------------------------------------------------------------------------------------------------------------------->
<!-----INSERT--------------------------------------------------------------------------------------------INSERT---------------------INSERT-----------
<!--------------------------------------------------------------------------------------------------------------------------------------------------->

<?php  
    }
    
    
elseif($do == 'Insert') {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<h1 class= 'text-center'> Add Location </h1>";
        echo "<div class='container'>";
 
                //get variables from form
                $loc     = $_POST['location'];

                //insert userinfo in database
                $stmt = $con->prepare("INSERT INTO 
                                      city(city_name) 
                                      VALUES(:zlocation)");
        
                $stmt->execute(array(
                'zlocation'    => $loc

                ));
                    
                //Echo Success Message 
                echo "<div class = 'container'>";
                     $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                     redirectHome($theMsg,'back'); 
                 echo "</div>";
     
            }
                else
            {
               echo "<div class= 'container'>";
               $theMsg = '<div class="alert alert-danger">Sorry You Can\'t browse this page directly</div>'; 
               redirectHome($theMsg);    
               echo "</div>";
            }
               echo "</div>";
}
      
/*================================================================================================================================================*/
/*=========================================                           Edit                          ==============================================*/
/*================================================================================================================================================*/
    
    
elseif($do == 'Edit')
    {    
        
    //check if get request userid is numeric & get the integer value of it 
        
    $locid = isset($_GET['locid'])&&is_numeric($_GET['locid'])?intval($_GET['locid']):0;
        
    //select all data depend on this id  
        
      $stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                city 
                          WHERE 
                                city_id = ?
                          ");
    //execute data
        
    $stmt->execute(array($locid));
    $loc = $stmt->fetch();
    $count = $stmt->rowCount();
        

        
if($count > 0){ ?>
    
   <div class="container add"> 
       

      <form id="contact" action="?do=Update" method="POST">
            <h3>Edit Location</h3>
                
            <fieldset>
                    <input type="hidden" name="locid" value="<?php echo $locid ?>" />
             </fieldset>
                  
             <fieldset>    
                    <input type="text" name="location" placeholder="UserName" value="<?php echo $loc['city_name'] ?>" autocomlete="off" /> 
             </fieldset>
                
                
            <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Save Changes</button>
            </fieldset>
        
       </form>
    </div>


<?php } 
        
     else
{
    echo "<div class = 'container'>";
    $theMsg = '<div class="alert alert-danger">There is no such ID</div>';
    redirectHome($theMsg);
    echo "</div>";
}
    
    }
    
/*================================================================================================================================================*/
/*=========================================                           Update                        ==============================================*/
/*================================================================================================================================================*/    
elseif ($do == 'Update')
    {
        echo "<h1 class= 'text-center  Dashboard'> Update Location </h1>";
        echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get variables from form
                  $locid       = $_POST['locid'];
                  $location    = $_POST['location'];
                

                
            
                    $stmt = $con->prepare("SELECT * FROM city WHERE city_name = ? AND city_id != ?");
                    $stmt->execute(array($user, $locid));
                    $count = $stmt->rowCount();
                    
            if ($count == 1){
                    echo '<div class="alert alert-danger">Sorry This UserName Is Exist</div>';
                    redirectHome($theMsg,'back');
                         
                     }else{
                     $stmt = $con->prepare("UPDATE city SET city_name =?  WHERE city_id =?");
                     $stmt->execute(array($location, $locid));
                
                //Echo Success Message 
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
                redirectHome($theMsg,'back');
            }
                
                
            }
                    else
                        {

                     echo "<div class = 'container'>";
                     $theMsg = '<div class="alert alert-danger">Sorry You Can\'t browse this page directly</div>';
                     redirectHome($theMsg);
                     echo "</div>";
            }
        
        echo "</div>";
    }
        

/*================================================================================================================================================*/
/*=========================================                           Delete                     =================================================*/
/*================================================================================================================================================*/
        
        
    
elseif($do == 'Delete'){
        
        //Delete 
        echo "<h1 class= 'text-center Dashboard'> Delete Location </h1>";
        echo "<div class='container'>";
        
                
        $locid = isset($_GET['locid'])&&is_numeric($_GET['locid'])?intval($_GET['locid']):0;
        
        //select all data depend on this id  
        
        $check = CheckItem('city_id', 'city', $locid);        
        
        //execute data

if($check > 0) 
{
    
    $stmt = $con->prepare("DELETE FROM city WHERE city_id = :zlocid");
    $stmt->bindparam(":zlocid", $locid);
    $stmt->execute();
    echo "<div class = 'container'>";
    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Deleted</div>';
    redirectHome($theMsg, 'back');
    echo "</div>";

}
    else
        {
                echo "<div class = 'container'>";
                $theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';
                redirectHome($theMsg);
                echo "</div>";
        }
        echo '</div>';
    }
    
/*============================================================================================================================================== */
/*============================================================================================================================================== */

    
include $tpl . "footer.php";
    
}
else 
{
    header('Location:index.php');
    exit();
}

ob_end_flush();
?>