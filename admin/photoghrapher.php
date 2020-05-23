<?php
ob_start();
/*
============================================
== Manage uploads Page
== you can add edit delete uploads from here
============================================
*/

session_start();
$pageTitle = 'Photographer';
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
                                photographer
                            ORDER BY
                            photographer_id
                                    DESC
                          ");
    $stmt->execute();
    //assign to variable 
    $bands = $stmt->fetchAll();    


    ?>




      <h1 class="text-center Dashboard">Photographer</h1>
        <div class="container">
          <div class="table-responsive">
            <table class="main-table manage-img text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Description</td>   
                    <td>Image</td>
                    <td>Control</td>
                </tr>
                
                
               
<?php
    
        foreach($bands as $band)
        {
                        echo "<tr>";
                            echo "<td>" . $band['photographer_id'] . "</td>";
                            echo "<td>" . $band['photographer_name'] . "</td>";
                            echo "<td>" . $band['photographer_description'] . "</td>";
                            echo "<td><img src='layout/images/" . $band['photographer_img'] .  "'/></td>";
            
            
 
                            echo "<td>
                            <a href='photoghrapher.php?do=Edit&bandid=" . $band['photographer_id'] ." ' class='btn btn-success btn-control'><i class= 'fa fa-edit'></i>Edit</a>
            
                                 
                            <a href='photoghrapher.php?do=Delete&bandid=" . $band['photographer_id'] . "' class='btn btn-danger confirm btn-delete'><i class= 'fa fa-close'></i>Delete</a>";                            

                            echo  "</td>";    
                        echo "</tr>";
        }
    
?>
                
          <tr>               
          </table>
      </div>    
            <a href="photoghrapher.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add Photoghrapher</a> 
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
              
            <h3>Add Photographer</h3>

            <fieldset>
                <input placeholder="Name" type="text" name="name" required>
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
        echo "<h1 class= 'text-center'> Add photographer </h1>";
        echo "<div class='container'>";
 
                $imgName = $_FILES['img']['name'];
                $imgSize = $_FILES['img']['size'];
                $imgTmp = $_FILES['img']['tmp_name'];
                $imgType = $_FILES['img']['type'];
        
                $imgExtension = array("jpeg", "jpg", "png", "gif");
                $imgExtensionEnd = strtolower(end(explode('.', $imgName)));
        
                //get variables from form
                $name    = $_POST['name'];
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
                                      photographer(photographer_name, photographer_img, photographer_description) 
                                      VALUES(:zphotographer_name, :zphotographer_img, :zphotographer_description)");
        
                $stmt->execute(array(
                'zphotographer_name'    => $name,
                'zphotographer_img' => $img,
                'zphotographer_description' => $description

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
        
    $bandid = isset($_GET['bandid'])&&is_numeric($_GET['bandid'])?intval($_GET['bandid']):0;
        
    //select all data depend on this id  
        
    $stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                photographer
                          WHERE 
                                photographer_id = ?
                          ");    //execute data
        
    $stmt->execute(array($bandid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
        

        
if($count > 0){ ?>
    
        <div class="container cont">
            <form class="form-horizontal" action="?do=Update" method="POST">
            <input type="hidden" name="bandid" value="<?php echo $bandid ?>" />
                
            <div class="form-input form-group">
                <div class="col-sm-10 col-md-12 col-lg-10">    
                    <textarea class="form-control" name="name"><?php echo $row['photographer_name'] ?></textarea>
                </div>    
            </div>


            <div class="form-input form-group">
                <div class="col-sm-10 col-md-12 col-lg-10">    
                    <textarea class="form-control" name="description"><?php echo $row['photographer_description'] ?></textarea>
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
        echo "<h1 class= 'text-center  Dashboard'> Update photographer </h1>";
        echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get variables from form
                  $bandid            = $_POST['bandid'];
                  $name           = $_POST['name'];
                  $description     = $_POST['description'];
                
                    
                     $stmt = $con->prepare("UPDATE photographer SET photographer_name =?, photographer_description =? WHERE photographer_id =?");
                     $stmt->execute(array($name, $description, $bandid));
                
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
        echo "<h1 class= 'text-center Dashboard'> Delete photographer </h1>";
        echo "<div class='container'>";
        
                
        $bandid = isset($_GET['bandid'])&&is_numeric($_GET['bandid'])?intval($_GET['bandid']):0;
        
        //select all data depend on this id  
        
        $check = CheckItem('photographer_id', 'photographer', $bandid);        
        
        //execute data

if($check > 0) 
{
    
    $stmt = $con->prepare("DELETE FROM photographer WHERE photographer_id = :zbandid");
    $stmt->bindparam(":zbandid", $bandid);
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
    
