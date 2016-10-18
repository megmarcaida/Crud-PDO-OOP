<?php
include_once 'config.php';

if(isset($_POST['btn-del']))
{
 $array = explode(";", $_GET['delete_id']);
 $id = $array[1];
 $crud->delete($id);
 header("Location: delete.php?deleted"); 
}

?>

<html>
<head>
  <title>Delete Record</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid">

    <div class="row">


        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Crud</a>
            </div>

          </div><!-- /.container-fluid -->
        </nav>
         <?php
         if(isset($_GET['deleted']))
         {
          ?>
                <div class="alert alert-success">
             <strong>Success!</strong> record was deleted... 
          </div>
                <?php
         }
         else
         {
          ?>
                <div class="alert alert-danger">
             <strong>Sure !</strong> to remove the following record ? 
          </div>
                <?php
         }
         ?> 

        <div class="container-fluid">
          
          <?php
          if(isset($_GET['delete_id']))
          {
           ?>
                 <table class='table table-bordered'>
                 <tr>
                 <th>First Name</th>
                 <th>Middle Name</th>
                 <th>Last Name</th>
                 <th>Email Address</th>
                 </tr>
                 <?php
                 $stmt = $DB_con->prepare("SELECT * FROM persons WHERE person_id=:id");
                 $stmt->execute(array(":id"=>$_GET['delete_id']));
                 while($row=$stmt->fetch(PDO::FETCH_BOTH))
                 {
                     ?>
                     <tr>
                     <td><?php print($row['firstname']); ?></td>
                     <td><?php print($row['middlename']); ?></td>
                     <td><?php print($row['lastname']); ?></td>
                     <td><?php print($row['email']); ?></td>
                     </tr>
                     <?php
                 }
                 ?>
                 </table>
                 <?php
          }
          ?>
        </div>

        <div class="container-fluid">
        <p>
        <?php
        if(isset($_GET['delete_id']))
        {
         ?>
           <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['person_id']; ?>" />
            <button class="btn btn-sm btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
            <a href="index.php" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-remove"></i> NO</a>
            </form>  
         <?php
        }
        else
        {
         ?>
            <a href="index.php" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-remove-circle"></i> Back to index</a>
            <?php
        }
        ?>
        </p>
        </div>
    </div>
</div>


</body>
</html>

