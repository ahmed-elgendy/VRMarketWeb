<?php
ob_start();
/*
============================================
== Manage Comments Page
== you can add edit delete comments from here
============================================
*/

session_start();
$pageTitle = 'Comments';
 if (isset($_SESSION['UserName']))
{
     include 'init.php';
     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    
    
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
    
    
 if($do == 'Manage')
{
    
    $stmt = $con->prepare("SELECT 
                                comments.*, image.Name AS Name, users.UserName AS Member 
                            FROM 
                                comments
                            INNER JOIN
                                image
                            ON
                                image.img_id = comments.vr_id
                            INNER JOIN
                                users
                            ON
                                users.UserID = comments.user_id
                            ORDER BY
                                comment_id DESC
                                ");
    $stmt->execute();
 //assign to variable 
    $comments = $stmt->fetchAll();
?>
    


      <h1 class="text-center Dashboard">Manage Comments</h1>
        <div class="container">
          <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Comment</td>
                    <td>VR Name</td>
                    <td>User Name</td>
                    <td>Added Date</td>                    
                    <td>Control</td>
                </tr>
                
<?php
    
        foreach($comments as $comment)
        {
                        echo "<tr>";
                            echo "<td>" . $comment['comment_id'] . "</td>";
                            echo "<td>" . $comment['comment'] . "</td>";
                            echo "<td>" . $comment['Name'] . "</td>";
                            echo "<td>" . $comment['Member'] . "</td>";
                            echo "<td>" . $comment['comment_date'] . "</td>";
                            echo "<td>
                            <a href='comments.php?do=Edit&comid=" . $comment['comment_id'] ." ' class='btn btn-success btn-control'><i class= 'fa fa-edit'></i>Edit</a>      
                            
                            
                            <a href='comments.php?do=Delete&comid=" . $comment['comment_id'] . "' class='btn btn-danger confirm btn-delete'><i class= 'fa fa-close'></i>Delete</a>";
            
                            if($comment['status'] == 0){
                                echo "<a href='comments.php?do=Approve&comid=" . $comment['comment_id'] . "' class='btn btn-info activate'><i class= 'fa fa-check'></i>Approve</a>";
                                
                            }
                            echo  "</td>";    
                        echo "</tr>";
        }
    
?>
                
          <tr>               
          </table>
      </div>    
      </div>

             
<?php    }

/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
    
    

    elseif($do == 'Edit')
    {    
        
    //check if get request userid is numeric & get the integer value of it 
        
    $comid = isset($_GET['comid'])&&is_numeric($_GET['comid'])?intval($_GET['comid']):0;
        
    //select all data depend on this id  
        
    $stmt = $con->prepare("SELECT 
                                * 
                          FROM 
                                comments 
                          WHERE 
                                comment_id = ?
                          ");    //execute data
        
    $stmt->execute(array($comid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
        

        
if($count > 0){ ?>
    
        <div class="container cont">
            <form class="form-horizontal" action="?do=Update" method="POST">
            <input type="hidden" name="comid" value="<?php echo $comid ?>" />
            <div class="form-input form-group">
          <div class="col-sm-10 col-md-12 col-lg-10">    
                <textarea class="form-control" name="comment"><?php echo $row['comment'] ?></textarea>
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
        echo "<h1 class= 'text-center  Dashboard'> Update Comment </h1>";
        echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get variables from form
                  $comid       = $_POST['comid'];
                  $comment     = $_POST['comment'];
                
                    
                     $stmt = $con->prepare("UPDATE comments SET comment =? WHERE comment_id =?");
                     $stmt->execute(array($comment, $comid));
                
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
    elseif($do == 'Delete'){
        
        //Delete 
        echo "<h1 class= 'text-center Dashboard'> Delete Comment </h1>";
        echo "<div class='container'>";
        
                
    $comid = isset($_GET['comid'])&&is_numeric($_GET['comid'])?intval($_GET['comid']):0;
        
    //select all data depend on this id  
        
    $check = CheckItem('comment_id', 'comments', $comid);        
        
    //execute data

if($check > 0)
{
    
    $stmt = $con->prepare("DELETE FROM comments WHERE comment_id = :zid");
    $stmt->bindparam(":zid", $comid);
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
    
    elseif($do='Approve'){
        
        echo "<h1 class= 'text-center Dashboard'> Activate Comment </h1>";
        echo "<div class='container'>";
        
                
    $comid = isset($_GET['comid'])&&is_numeric($_GET['comid'])?intval($_GET['comid']):0;
        
    //select all data depend on this id  
        
    $check = CheckItem('comment_id', 'comments', $comid);        
        
    //execute data

if($check > 0)
{
    
    $stmt = $con->prepare("UPDATE comments SET Status = 1 WHERE comment_id = ?");
    $stmt->execute(array($comid));
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