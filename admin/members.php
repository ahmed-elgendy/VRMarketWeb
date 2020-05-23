<?php
ob_start();
/*
============================================
== Manage Members Page
== you can add edit delete members from here
============================================
*/

session_start();
$pageTitle = 'Members';
if (isset($_SESSION['UserName']))
{
    include 'init.php';
    include $tpl . 'footer.php';
        
     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    
if($do == 'Manage')
{
    $query = '';
    if(isset($_GET['page']) && $_GET['page'] == 'pending') {
        $query = 'AND RegStatus = 0';
    }   
    
    $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
    $stmt->execute();
 //assign to variable 
    $mems = $stmt->fetchAll();
?>




<!------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------>




      <h1 class="text-center Dashboard">Manage Members</h1>
        <div class="container">
          <div class="table-responsive">
            <table class="main-table manage-members text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>UserName</td>
                    <td>Email</td>
                    <td>Full Name</td>
                    <td>Registerd Date</td>                    
                    <td>Control</td>
                </tr>
                
                <?php
    
        foreach($mems as $mem)
        {
                        echo "<tr>";
                            echo "<td>" . $mem['UserID'] . "</td>";
                            echo "<td>" . $mem['UserName'] . "</td>";
                            echo "<td>" . $mem['Email'] . "</td>";
                            echo "<td>" . $mem['FullName'] . "</td>";
                            echo "<td>" . $mem['Date'] . "</td>";
                            echo "<td>
                            <a href='members.php?do=Edit&UserID=" . $mem['UserID'] ." ' class='btn btn-success btn-control'><i class= 'fa fa-edit'></i>Edit</a>      
                            
                            
                            <a href='members.php?do=Delete&UserID=" . $mem['UserID'] . "' class='btn btn-danger confirm btn-delete'><i class= 'fa fa-close'></i>Delete</a>";
            
                            if($mem['RegStatus'] == 0){
                                echo "<a href='members.php?do=Activate&UserID=" . $mem['UserID'] . "' class='btn btn-info activate'><i class= 'fa fa-check'></i>Activate</a>";
                                
                                
                            }
                            echo  "</td>";    
                        echo "</tr>";
                        
        }
    
                ?>
                
          <tr>               
          </table>
      </div>
          <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Member</a>      
      </div>

             
<?php    }
    
    
    
/*------------------------------------------------------------------------------    
--------------------------------------------------------------------------------
********ADD***********************ADD********ADD***************ADD**************
------------------------------------------------------------------------------*/
    
    
    
    elseif($do== 'Add')
    {
?>

<div class="container add">  
  <form id="contact" action="?do=Insert" method="POST" enctype="multipart/form-data">
    <h3>Add Member</h3>
    
    <fieldset>
      <input placeholder="Name" type="text" name="username" autocomplete="off" required autofocus>
    </fieldset>
      
    <fieldset>
      <input placeholder="Email" type="email" name="email" required>
    </fieldset>
      
    <fieldset>
      <input placeholder="FullName" type="text" name="full" autocomplete="off" required>
    </fieldset>
      
    <fieldset>
      <input placeholder="Password" type="password" name="pass" autocomplete="new-password" required>
    </fieldset>
      
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Add</button>
    </fieldset>
      
  </form>
</div>



<!------------------------------------------------------------------------------>
<!-----INSERT-----------------------INSERT---------------------INSERT-----------
<!------------------------------------------------------------------------------>



<?php
        
    }
    elseif($do == 'Insert')
    {
    
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<h1 class= 'text-center'> Add Member </h1>";
        echo "<div class='container'>";
                 
                
                //get variables from form
                  $user     = $_POST['username'];
                  $email    = $_POST['email'];
                  $name     = $_POST['full'];
                  $pass     = $_POST['pass'];
                  $hashpass = sha1($_POST['pass']);
                
                //validate the form
                  $formErrors = array();
                
                if (strlen($user) < 6){
                    $formErrors[] = 'Username Can\'t Be Less Than <strong> 6 Characters</strong>';
                }
                
                 if (strlen($user) > 20){
                    $formErrors[] = 'Username Can\'t Be More Than <strong> 20 Characters</strong>';
                }
           
                 if (empty($user)){
                     $formErrors[] = 'UserName Cant Be <strong>Empty</strong>';
                 }
                
                
                
                  if (empty($email)){
                     $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
                 }
                
                
                  if (empty($name)){
                     $formErrors[] = 'FullName Cant Be <strong>Empty</strong>';
                 }
                
             
               if (empty($pass)){
                     $formErrors[] = 'Password Cant Be <strong>Empty</strong>';
                 }
                            
                
                    foreach($formErrors as $error){
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                       
                  }
                   
                //check if there is no errors proced the update operation 
                if (empty($formErrors)) {
                
               
                //check if user exist in database
                $check = checkItem("UserName", "users", $user);
                    if($check == 1){
                          $theMsg = "<div class='alert alert-danger'>"  . 'Sorry This UserName Is Exist</div>';
                        redirectHome($theMsg,'back');
                    }
                    
                    
                    
                $check = checkItem("Email", "users", $email);
                    if($check == 1){
                          $theMsg = "<div class='alert alert-danger'>"  . 'Sorry This Email Is Exist</div>';
                        redirectHome($theMsg,'back');
                    }                    
                    
                    
                    
                    
                    
                    else {
                        
                    
                   
                //insert userinfo in database
                $stmt = $con->prepare("INSERT INTO 
                                      users(UserName, Password, Email, FullName, RegStatus, Date) 
                                      VALUES(:zuser, :zpass, :zmail, :zfullname, 1, now())");
                $stmt->execute(array(
                'zuser'         => $user,
                'zpass'         => $hashpass,
                'zmail'         => $email,    
                'zfullname'     => $name

               
                ));
                    
                //Echo Success Message 
                        echo "<div class = 'container'>";
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                        redirectHome($theMsg,'back'); 
                        echo "</div>";
                    }
                    
            }
                
                }else
            {
                echo "<div class= 'container'>";
               $theMsg = '<div class="alert alert-danger">Sorry You Can\'t browse this page directly</div>';
                
               redirectHome($theMsg);    
                echo "</div>";
            }
        echo "</div>";
        
        
        
/*-------------------------------------------------------------------------
*****EDIT*****************************EDIT****************EDIT*************
--------------------------------------------------------------------------*/
        
        
        
    }
    elseif($do == 'Edit')
    {    
        
    //check if get request userid is numeric & get the integer value of it 
        
    $userid = isset($_GET['UserID'])&&is_numeric($_GET['UserID'])?intval($_GET['UserID']):0;
        
    //select all data depend on this id  
        
      $stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                users 
                          WHERE 
                                UserID = ?
                          LIMIT 1");
    //execute data
        
    $stmt->execute(array($userid));
    $mem = $stmt->fetch();
    $count = $stmt->rowCount();
        

        
if($count > 0){ ?>
    
   <div class="container add"> 
       

            <form id="contact" action="?do=Update" method="POST">
                <h3>Edit Member</h3>
                
                <fieldset>
                    <input type="hidden" name="userid" value="<?php echo $userid ?>" />
                </fieldset>
                  
                <fieldset>    
                    <input type="text" name="UserName" placeholder="UserName" value="<?php echo $mem['UserName'] ?>" autocomlete="off" /> 
                </fieldset>
                
                <fieldset>
                    <input type="hidden" placeholder="Password" name="oldpassword" value="<?php echo $mem['password']?>"/>
                    <input type="password" name="newpassword" autocomplete='new-password' />    
                </fieldset>

                <fieldset>
                    <input type="email" placeholder="Email" name="email" value="<?php echo $mem['Email'] ?>" />    
                </fieldset>
   
                <fieldset>    
                    <input type="text" placeholder="Full Name" name="Full" value="<?php echo $mem['FullName'] ?>" />    
                </fieldset>
                
                
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Save Changes</button>
                </fieldset>
        
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
        
        
        
/*---------------------------------------------------------------------------
********UPDATE***********************UPDATE********************UPDATE********
----------------------------------------------------------------------------*/
        
        
        
    }
    
    elseif ($do == 'Update')
    {
        echo "<h1 class= 'text-center  Dashboard'> Update Member </h1>";
        echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get variables from form
                  $id       = $_POST['userid'];
                  $user     = $_POST['UserName'];
                  $email    = $_POST['email'];
                  $name     = $_POST['Full'];
                
                //Pass trick
                  $pass='';
                  $pass = empty($_POST['newpassword']) ?  $_POST['oldpassword'] : sha1($_POST['newpassword']);
                
                //validate the form
                  $formErrors = array();
                
                if (strlen($user) < 6){
                    $formErrors[] = 'Username Can\'t Be Less Than <strong> 6 Characters</strong>';
                }
                 if (strlen($user) > 20){
                    $formErrors[] = '<div class="alert alert-danger">Username Can\'t Be More Than <strong> 20 Characters</strong>';
                }
           
                
                    foreach($formErrors as $error){
                        echo '<div class="alert alert-danger">' .  $error . '</div>';
                  }
                   
                
                //check if there is no errors proced the update operation 
                if (empty($formErrors)) {
                    
                     $stmt2 = $con->prepare("SELECT * FROM users WHERE UserName = ? AND UserID != ?");
                     $stmt2->execute(array($user, $id));
                     $count = $stmt2->rowCount();
                    
                     if ($count == 1){
                         echo '<div class="alert alert-danger">Sorry This UserName Is Exist</div>';
                         redirectHome($theMsg,'back');
                         
                     }
                    
                    
                    
                    
                     $stmt2 = $con->prepare("SELECT * FROM users WHERE Email = ? AND UserID != ?");
                     $stmt2->execute(array($email, $id));
                     $count = $stmt2->rowCount();
                    
                     if ($count == 1){
                         echo '<div class="alert alert-danger">Sorry This Email Is Exist</div>';
                         redirectHome($theMsg,'back');
                         
                     }
                   
                    
                    
                    
                    
                    else{
                     $stmt = $con->prepare("UPDATE users SET UserName =?, Email= ?, FullName =?,  Password= ? WHERE UserID =?");
                     $stmt->execute(array($user, $email, $name, $pass, $id));
                
                //Echo Success Message 
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
                redirectHome($theMsg,'back');
            }
                }
                
                }else
            {
                
                echo "<div class = 'container'>";
                $theMsg = '<div class="alert alert-danger">Sorry You Can\'t browse this page directly</div>';
                redirectHome($theMsg);
                echo "</div>";
                
            }
        echo "</div>";
        
        
        
/*----------------------------------------------------------------------------
**DELETE****************DELETE******************DELETE************************
-----------------------------------------------------------------------------*/
        
        
        
    }
    elseif($do == 'Delete'){
        
        //Delete 
        echo "<h1 class= 'text-center Dashboard'> Delete Member </h1>";
        echo "<div class='container'>";
        
                
    $userid = isset($_GET['UserID'])&&is_numeric($_GET['UserID'])?intval($_GET['UserID']):0;
        
    //select all data depend on this id  
        
    $check = CheckItem('userid', 'users', $userid);        
        
    //execute data

if($check > 0)
{
    
    $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
    $stmt->bindparam(":zuser", $userid);
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
    
    
    
    
    
    
/*------------------------------------------------------------------------------------
----ACTIVATE------------------------ACTIVATE-------------------------------ACTIVATE---
------------------------------------------------------------------------------------*/
    
    
    
    elseif($do='Activate'){
        
        echo "<h1 class= 'text-center Dashboard'> Activate Member </h1>";
        echo "<div class='container'>";
        
                
    $userid = isset($_GET['UserID'])&&is_numeric($_GET['UserID'])?intval($_GET['UserID']):0;
        
    //select all data depend on this id  
        
    $check = CheckItem('userid', 'users', $userid);        
        
    //execute data

if($check > 0)
{
    
    $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
    $stmt->execute(array($userid));
       echo "<div class = 'container'>";
       $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Updated</div>';
       redirectHome($theMsg);
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
    
     include $tpl . "footer.php";
    
}
else 
{
    header('Location:index.php');
    exit();
}

ob_end_flush();
?>