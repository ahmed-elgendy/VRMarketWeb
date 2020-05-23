<?php
ob_start();
/*
============================================
== Manage Comments Page
== you can add edit delete comments from here
============================================
*/

session_start();
$pageTitle = 'Favourits';
 if (isset($_SESSION['UserName']))
{
     include 'init.php';
     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    
    
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
/* --------------------------------------------------------------------------------------------------------------------------------------------- */   
    
    
 if($do == 'Manage')
{
    
    $stmt = $con->prepare("SELECT 
                                favourite.*, image.Name AS Name, users.UserName AS Member 
                            FROM 
                                favourite
                            INNER JOIN
                                image
                            ON
                                image.img_id = favourite.img_id
                            INNER JOIN
                                users
                            ON
                                users.UserID = favourite.user_id
                            ORDER BY
                                favourite_id DESC
                                ");
    $stmt->execute();
 //assign to variable 
    $favourits = $stmt->fetchAll();
?>
    


      <h1 class="text-center Dashboard">Manage Favourits</h1>
        <div class="container">
          <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Image Name</td>
                    <td>User Name</td>
                </tr>
                
<?php
    
        foreach($favourits as $favourite)
        {
                        echo "<tr>";
                            echo "<td>" . $favourite['favourite_id'] . "</td>";
                            echo "<td>" . $favourite['Name'] . "</td>";
                            echo "<td>" . $favourite['Member'] . "</td>";
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