<?php
ob_start();
/*
============================================
== Manage uploads Page
== you can add edit delete uploads from here
============================================
*/

session_start();
$pageTitle = 'Wedding Car';
 if (isset($_SESSION['UserName']))
{
    include 'init.php';
        
     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    
/*------------------------------------------------------------------------------------------------------------------------------------------------    
******************************************************************  Manage  *********************************************************************
-------------------------------------------------------------------------------------------------------------------------------------------------*/    
    
if($do == 'Manage')
{

    $stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                wedding_car 
                            ORDER BY
                            car_id
                                    DESC
                          ");
    $stmt->execute();
    //assign to variable 
    $cars = $stmt->fetchAll();    


    ?>




      <h1 class="text-center Dashboard">Wedding Cars</h1>
        <div class="container">
          <div class="table-responsive">
            <table class="main-table manage-img text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Car Model</td>
                    <td>Description</td>   
                    <td>Image</td>
                    <td>Control</td>
                </tr>
                
                
               
<?php
    
        foreach($cars as $car)
        {
                        echo "<tr>";
                            echo "<td>" . $car['car_id'] . "</td>";
                            echo "<td>" . $car['car_model'] . "</td>";
                            echo "<td>" . $car['car_description'] . "</td>";
                            echo "<td><img src='layout/images/" . $car['car_img'] .  "'/></td>";
            
            
 
                            echo "<td>
                            <a href='car.php?do=Edit&carid=" . $car['car_id'] ." ' class='btn btn-success btn-control'><i class= 'fa fa-edit'></i>Edit</a>
            
                                 
                            <a href='car.php?do=Delete&carid=" . $car['car_id'] . "' class='btn btn-danger confirm btn-delete'><i class= 'fa fa-close'></i>Delete</a>";                            

                            echo  "</td>";    
                        echo "</tr>";
        }
    
?>
                
          <tr>               
          </table>
      </div>    
            <a href="car.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add Car</a> 
      </div>

             
<?php    }

/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
                    
  
/*--------------------------------------------------------------------------------------------------------------------------------------------------  
-------------------------------------------                           ADD                               --------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------------*/
    
    
    
elseif($do== 'Add') {
    
?>

     <div class="container add">  
          <form id="contact" action="?do=Insert" method="POST" enctype="multipart/form-data">
              
            <h3>Add Car</h3>

            <fieldset>
                <input placeholder="Model" type="text" name="model" required>
            </fieldset>
              
              
            <fieldset>
                <input placeholder="" type="file" name="img" required>
            </fieldset>                
 
              
            <fieldset>
                <input placeholder="Description" type="text" name="description" required>
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
        echo "<h1 class= 'text-center'> Add Car </h1>";
        echo "<div class='container'>";
 
                $imgName = $_FILES['img']['name'];
                $imgSize = $_FILES['img']['size'];
                $imgTmp = $_FILES['img']['tmp_name'];
                $imgType = $_FILES['img']['type'];
        
                $imgExtension = array("jpeg", "jpg", "png", "gif");
                $imgExtensionEnd = strtolower(end(explode('.', $imgName)));
        
                //get variables from form
                $model    = $_POST['model'];
                $description     = $_POST['description'];
        
        
                $formErrors = array();
        
                if (! empty($imgName) && ! in_array($imgExtensionEnd, $imgExtension)) {
                    $formErrors[] = 'This extension is not allowed';
                }
        
                if (empty($imgName)) {
                    $formErrors[] = 'Image is required';
                }        
        
        
                if ($imgSize > 4194304) {
                    $formErrors[] = 'Image cannot be larger than 4MB ';
                } 
        
                foreach($formErrors as $error){
                    echo '<div class"alert alert-danger">' . $error . '</div>';
                }
        
        
                if (empty($formErrors)) {
                    $img = rand(0, 100000) . '_' . $imgName;
                    move_uploaded_file($imgTmp, "layout\images\\" . $img);
                


                //insert userinfo in database
                $stmt = $con->prepare("INSERT INTO 
                                      wedding_car(car_model, car_img, car_description) 
                                      VALUES(:zcar_model, :zcar_img, :zcar_description)");
        
                $stmt->execute(array(
                'zcar_model'    => $model,
                'zcar_img' => $img,
                'zcar_description' => $description

                ));
                    
                //Echo Success Message 
                echo "<div class = 'container'>";
                     $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                     redirectHome($theMsg,'back'); 
                 echo "</div>";
     
            }
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
      
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
    
    

    elseif($do == 'Edit')
    {    
        
    //check if get request userid is numeric & get the integer value of it 
        
    $carid = isset($_GET['carid'])&&is_numeric($_GET['carid'])?intval($_GET['carid']):0;
        
    //select all data depend on this id  
        
    $stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                wedding_car 
                          WHERE 
                                car_id = ?
                          ");    //execute data
        
    $stmt->execute(array($carid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
        

        
if($count > 0){ ?>
    
        <div class="container cont">
            <form class="form-horizontal" action="?do=Update" method="POST">
            <input type="hidden" name="carid" value="<?php echo $carid ?>" />
                
            <div class="form-input form-group">
                <div class="col-sm-10 col-md-12 col-lg-10">    
                    <textarea class="form-control" name="model"><?php echo $row['car_model'] ?></textarea>
                </div>    
            </div>


            <div class="form-input form-group">
                <div class="col-sm-10 col-md-12 col-lg-10">    
                    <textarea class="form-control" name="description"><?php echo $row['car_description'] ?></textarea>
                </div>    
            </div>

 
                
            <div class="form-input form-group">
            <div class="col-sm-offset-0 col-sm-10">
            <input type="submit" value="Save" class="btn btn-success btn-block" />    
        </div>    
        </div>    
        </form>
        </div>

<!--=========================================--!>


<?php
}
    
else
{
    echo "<div class = 'container'>";
    $theMsg = '<div class="alert alert-danger">There is no such ID</div>';
    redirectHome($theMsg);
    echo "</div>";
}
        
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
        
    }
   elseif ($do == 'Update')
    {
        echo "<h1 class= 'text-center  Dashboard'> Update Car </h1>";
        echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get variables from form
                  $carid            = $_POST['carid'];
                  $model           = $_POST['model'];
                  $description     = $_POST['description'];
                
                    
                     $stmt = $con->prepare("UPDATE wedding_car SET car_model =?, car_description =? WHERE car_id =?");
                     $stmt->execute(array($model, $description, $carid));
                
                //Echo Success Message 
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
                redirectHome($theMsg,'back');
            }
                
                
            else
            {
                
                echo "<div class = 'container'>";
                $theMsg = '<div class="alert alert-danger">Sorry You Can\'t browse this page directly</div>';
                redirectHome($theMsg);
                echo "</div>";
                
            }
        echo "</div>";
        
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   

        
    }
    
    

/*================================================================================================================================================*/
/*=========================================                           Delete                     =================================================*/
/*================================================================================================================================================*/
        
        
    
elseif($do == 'Delete'){
        
        //Delete 
        echo "<h1 class= 'text-center Dashboard'> Delete Location </h1>";
        echo "<div class='container'>";
        
                
        $carid = isset($_GET['carid'])&&is_numeric($_GET['carid'])?intval($_GET['carid']):0;
        
        //select all data depend on this id  
        
        $check = CheckItem('car_id', 'wedding_car', $carid);        
        
        //execute data

if($check > 0) 
{
    
    $stmt = $con->prepare("DELETE FROM wedding_car WHERE car_id = :zcarid");
    $stmt->bindparam(":zcarid", $carid);
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
        
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   

    
    
}
else 
{
    header('Location:index.php');
    exit();
}

ob_end_flush();
?>
    
