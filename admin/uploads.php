<?php
ob_start();
/*
============================================
== Manage uploads Page
== you can add edit delete uploads from here
============================================
*/

session_start();
$pageTitle = 'Uploads';
if (isset($_SESSION['UserName']))
{
    include 'init.php';
    include $tpl . 'footer.php';
        
     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    
/*------------------------------------------------------------------------------------------------------------------------------------------------    
******************************************************************  Manage  *********************************************************************
-------------------------------------------------------------------------------------------------------------------------------------------------*/    
    
if($do == 'Manage')
{
    $query = '';
    if(isset($_GET['page']) && $_GET['page'] == 'pending') {
        $query = 'AND RegStatus = 0';
    }   
    

    $stmt = $con->prepare("SELECT 
                                image.*, city.city_name AS City
                            FROM 
                                image
                            INNER JOIN
                                city
                            ON
                                city.city_id = image.loc_id");
    $stmt->execute();
 //assign to variable 
    $upds = $stmt->fetchAll();
?>



<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->



 <h1 class="text-center Dashboard">Manage Uploads</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="main-table manage-members text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Image</td>
                    <td>VR</td>
                    <td>Multi VR</td>
                    <td>Name</td> 
                    <td>City</td>   
                    <td>Address</td> 
                    <td>Price</td>                     
                    <td>Stars</td> 
                    <td>Parent</td>               
                    <td>Control</td>
                </tr>
                
                <?php
    
foreach($upds as $upd)
        {
                    echo "<tr>";
            
                         echo "<td>" . $upd['img_id'] . "</td>";
                         echo "<td><img src='layout/images/" . $upd['normal_img_url'] . "'/></td>";
                         echo "<td>" . $upd['single_img_url'] . "</td>";
                         echo "<td>" . $upd['multi_img_url'] . "</td>";
                         echo "<td>" . $upd['name'] . "</td>";
                         echo "<td>" . $upd['City'] . "</td>";
                         echo "<td>" . $upd['description'] . "</td>";
                         echo "<td>" . $upd['price'] . "</td>";
                         echo "<td>" . $upd['stars'] . "</td>";
                         echo "<td>" . $upd['parent'] . "</td>";


                        echo "<td>
                                <a href='uploads.php?do=Edit&vrid=" . $upd['img_id'] ." ' class='btn btn-success btn-control'><i class= 'fa fa-edit'></i>Edit</a>      
        
                                <a href='uploads.php?do=Delete&vrid=" . $upd['img_id'] . "' class='btn btn-danger confirm btn-delete'><i class= 'fa fa-close'></i>Delete</a>";
                        echo  "</td>";  
            
                    echo "</tr>";
                        
        }
                ?>
                         
          </table>
      </div>
          <a href="uploads.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New VR</a>      
    </div>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->       
<?php   }
    
/*------------------------------------------------------------------------------------------------------------------------------------------------    
******************************************************************   ADD  ************************************************************************
-------------------------------------------------------------------------------------------------------------------------------------------------*/

elseif($do== 'Add')
    {
?>

<div class="container add">  
  <form id="contact" action="?do=Insert" method="POST" enctype="multipart/form-data">
    <h3>Add VR</h3>
    
    <fieldset>
      <input placeholder="Script" type="text" name="vr" required>
    </fieldset>
      
      
    <fieldset>
                <input placeholder="" type="file" name="img" required>
    </fieldset>        
      
    <fieldset>
      <input placeholder="Multi_Script" type="text" name="multivr" required>
    </fieldset>      
      
    <fieldset>
      <input placeholder="Name" type="text" name="name" required>
    </fieldset>  
      
      
    <fieldset>
      <input placeholder="Address" type="text" name="address" required>
    </fieldset>    
      
    <fieldset>
      <input placeholder="Price" type="number" name="price" required>
    </fieldset>       
      
      
    <select name="star" required>
    <option value="0">Stars</option>  
        <option value="1">1</option> 
        <option value="2">2</option>  
        <option value="3">3</option>  
        <option value="4">4</option>  
        <option value="5">5</option>          
    </select>  
      
            <select name="loc" required>
                <option value="0">Location</option>
                <?php
                    $stmt = $con->prepare("SELECT * FROM city");
                    $stmt->execute();
                    $locs = $stmt->fetchAll();
                    foreach ($locs as $loc) {
                        echo "<option value='" . $loc['city_id'] . "'>" . $loc['city_name'] . "</option>";
                    }
                ?>
            </select>
      
      
            <select name="parent">
                <option value="0">Parent</option>
                <?php
                    $allvr = getAllFrom("*", "image", "where parent = 0", "", "img_id", "");
                    foreach ($allvr as $vr) {
                        echo "<option value='" . $vr['img_id'] . "'>" . $vr['name'] . "</option>";
                    }
                ?>
            </select>
            
      
      
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Add</button>
    </fieldset>
      
      
  </form>
</div>

<?php     }
    
/*------------------------------------------------------------------------------------------------------------------------------------------------    
******************************************************************   Insert  *********************************************************************
-------------------------------------------------------------------------------------------------------------------------------------------------*/
    
elseif($do == 'Insert')
    {
        
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<h1 class= 'text-center'> Add VR </h1>";
        echo "<div class='container'>";
                 
          $imgName = $_FILES['img']['name'];
                $imgSize = $_FILES['img']['size'];
                $imgTmp = $_FILES['img']['tmp_name'];
                $imgType = $_FILES['img']['type'];
        
                $imgExtension = array("jpeg", "jpg", "png", "gif");
                $imgExtensionEnd = strtolower(end(explode('.', $imgName)));
        
         
         
         
         
         
                //get variables from form
                  $vr     = $_POST['vr'];
                  $multivr     = $_POST['multivr'];
                  $name     = $_POST['name'];
                  $address  = $_POST['address']; 
                  $price = $_POST['price'];
                  $star = $_POST['star'];
                  $parent  = $_POST['parent']; 
                  $loc_id  = $_POST['loc']; 
         

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
                                                image(normal_img_url,single_img_url, multi_img_url, name, description, price, stars, Parent, loc_id) 
                                        VALUES
                                                (:znormal_img_url, :zsingle_img_url, :zmulti_img_url, :zname, :zdescription, :zprice, :zstars, :zparent, :zloc)
                                        ");
         
                  $stmt->execute(array(
                  'znormal_img_url' => $img,
                  'zsingle_img_url'   => $vr,
                  'zmulti_img_url'   => $multivr,
                  'zname'   => $name, 
                  'zdescription' =>$address,  
                  'zprice' =>$price,
                  'zstars' => $star,      
                  'zparent'   => $parent, 
                  'zloc'  => $loc_id
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


/*------------------------------------------------------------------------------------------------------------------------------------------------    
******************************************************************   Edit  ***********************************************************************
-------------------------------------------------------------------------------------------------------------------------------------------------*/
    
elseif($do == 'Edit')
    {    
        
    //check if get request vrid is numeric & get the integer value of it 
        
    $vrid = isset($_GET['vrid'])&&is_numeric($_GET['vrid'])?intval($_GET['vrid']):0;
        
    //select all data depend on this id  
        
    $stmt = $con->prepare("SELECT 
                                image.*,
                                city.city_name
                          FROM 
                                image
                          INNER JOIN
                                city
                          ON 
                                city.city_id = image.loc_id
                          WHERE 
                                img_id = ?
                          ");
    //execute data
    $stmt->execute(array($vrid));
    $upd = $stmt->fetch();
    $count = $stmt->rowCount();
  
if($count > 0){ ?>
    
   <div class="container add"> 
       

            <form id="contact" action="?do=Update" method="POST">
                <h3>Edit VR</h3>
                
                <fieldset>
                    <input type="hidden" name="vrid" value="<?php echo $vrid ?>" />
                </fieldset>
                  
               
                <fieldset>    
                     <?php echo $upd['single_img_url'] ?>   
                </fieldset>
                

                <fieldset>    
                     <?php echo $upd['multi_img_url'] ?>   
                </fieldset>                
                
                
                <fieldset>    
                     <input type="text" name ="name" value="<?php echo $upd['name'] ?>"/>   
                </fieldset> 
                
                <fieldset>    
                     <input type="text" name ="address" value="<?php echo $upd['description'] ?>"/>   
                </fieldset> 
  
                
                <fieldset>    
                     <input type="number" name ="price" value="<?php echo $upd['price'] ?>"/>   
                </fieldset>                 
                
                
                <select name="star">
                    <option value="<?php echo $upd['stars'] ?>"><?php echo $upd['stars'] ?></option>
                    <option value="1">1</option> 
                    <option value="2">2</option>  
                    <option value="3">3</option>  
                    <option value="4">4</option>  
                    <option value="5">5</option>  
                </select>
                
                
             <select name="locid">
                <option value="0">Location</option>
                <?php
                    $stmt = $con->prepare("SELECT * FROM city");
                    $stmt->execute();
                    $locs = $stmt->fetchAll();
                    foreach ($locs as $loc) {
                        echo "<option value='" . $loc['city_id'] . "'";
                        if ($upd['loc_id'] == $loc['city_id']) {echo 'selected';}
                        echo ">" . $loc['city_name'] . "</option>";
                    }
                ?>
            </select>    
                
                
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Save Changes</button>
                </fieldset>
        
            </form>
    </div>


<?php
              }
            }
    
/*------------------------------------------------------------------------------------------------------------------------------------------------    
******************************************************************   Update  ********************************************************************
-------------------------------------------------------------------------------------------------------------------------------------------------*/

elseif ($do == 'Update')
    {
        echo "<h1 class= 'text-center  Dashboard'> Update VR </h1>";
        echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get variables from form
                  $vrid   = $_POST['vrid'];
                  $name   = $_POST['name'];
                  $address = $_POST['address'];
                  $price = $_POST['price'];
                  $star = $_POST['star'];
                  $locid = $_POST['locid'];
  
                  $stmt = $con->prepare("UPDATE image SET name =?, description =?, price =?, stars=?, loc_id =? WHERE img_id =?");
                  $stmt->execute(array($name, $address, $price, $star, $locid, $vrid));
                
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
        
    }
    
/*------------------------------------------------------------------------------------------------------------------------------------------------    
****************************************************************** Delete  **********************************************************************
-------------------------------------------------------------------------------------------------------------------------------------------------*/
         
elseif($do == 'Delete'){
        
        //Delete 
        echo "<h1 class= 'text-center Dashboard'> Delete Location </h1>";
        echo "<div class='container'>";
               
        $vrid = isset($_GET['vrid'])&&is_numeric($_GET['vrid'])?intval($_GET['vrid']):0;
        
        //select all data depend on this id  
        
        $check = CheckItem('img_id', 'image', $vrid);        
        
        //execute data

if($check > 0) 
{
    
    $stmt = $con->prepare("DELETE FROM image WHERE img_id = :zvrid");
    $stmt->bindparam(":zvrid", $vrid);
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
       

    
/*================================================================================================================================================*/
/*================================================================================================================================================*/
/*================================================================================================================================================*/
    
include $tpl . "footer.php";
}
else 
{
    header('Location:index.php');
    exit();
}

ob_end_flush();
?>