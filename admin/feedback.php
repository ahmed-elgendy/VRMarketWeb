<?php
ob_start();
/*
============================================
== Manage Comments Page
== you can add edit delete comments from here
============================================
*/

session_start();
$pageTitle = 'Feedback';
 if (isset($_SESSION['UserName']))
{
     include 'init.php';
     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    
    
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
    
    
 if($do == 'Manage')
{
    
    $stmt = $con->prepare("SELECT * FROM feedback");
    $stmt->execute();
 //assign to variable 
    $comments = $stmt->fetchAll();
?>
    


      <h1 class="text-center Dashboard">Manage Feedback</h1>
        <div class="container">
          <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Message</td>
                    <td>Email</td>
                    <td>Added Date</td>                    
                </tr>
                
<?php
    
        foreach($comments as $comment)
        {
                        echo "<tr>";
                            echo "<td>" . $comment['feedback_id'] . "</td>";
                            echo "<td>" . $comment['message'] . "</td>";
                            echo "<td>" . $comment['email'] . "</td>";
                            echo "<td>" . $comment['message_date'] . "</td>";
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