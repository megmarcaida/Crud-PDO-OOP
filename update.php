<?php
include_once 'config.php';
if(isset($_POST['update']))
{
 $array = explode(";", $_GET['edit_id']);
 $id = $array[1];

 $firstname = $_POST['firstname'];
 $middlename = $_POST['middlename'];
 $lastname = $_POST['lastname'];
 $email = $_POST['email'];
 
 if($crud->update($id,$firstname,$middlename,$lastname,$email))
 {
  $msg = "<div class='alert alert-info'>
    <strong>Record was updated successfully!</strong>  <a class='pull-right' href='index.php'> Back to Homepage</a>!
    </div>";
 }
 else
 {
  $msg = "<div class='alert alert-warning'>
    <strong>SORRY!</strong> ERROR while updating record !
    </div>";
 }
}

if(isset($_GET['edit_id']))
{
 $array = explode(";", $_GET['edit_id']);
 $id = $array[1];
 extract($crud->getID($id)); 
}

?>

<html>
<head>

    <title>Update Record</title>
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
    if(isset($msg))
    {
     echo $msg;
    }
    ?>
    

            <div class="container">
              
                 <div class="form-group">

                    <form action="" method="POST">
                                
                        <div class="form-group">
                            <label for="InputFirstName">First Name</label>
                            <input type="text" class="form-control" id="InputFirstName" value="<?php echo $firstname; ?>" name="firstname" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="InputFirstName">Middle Name</label>
                            <input type="text" class="form-control" id="InputMiddleName" value="<?php echo $middlename; ?>" name="middlename" placeholder="Middle Name" required>
                        </div>

                        <div class="form-group">
                            <label for="InputFirstName">Last Name</label>
                            <input type="text" class="form-control" id="InputLastName" value="<?php echo $lastname; ?>" name="lastname" placeholder="Last Name" required>
                        </div>

                        <div class="form-group">
                            <label for="InputFirstName">Email address</label>
                            <input type="email" class="form-control" id="InputEmail" value="<?php echo $email; ?>" name="email" placeholder="Email address" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary" name="update">
                           <span class="glyphicon glyphicon-edit"></span>  Update
                        </button>
                        <a href="index.php" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a>
                    
                    </form>
                 
                </div>
            </div>
        </div>
    </div>
</body>
</html>

