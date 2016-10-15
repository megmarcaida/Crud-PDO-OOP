<?php
include_once 'config.php';
if(isset($_POST['save']))
{
     $firstname = $_POST['firstname'];
     $middlename = $_POST['middlename'];
     $lastname = $_POST['lastname'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     
     if($crud->insertPDO($firstname,$middlename,$lastname,$email,$password))
     {
      echo "<script>alert('Successfully Saved')</script>";
     }
     else
     {
     echo "<script>alert('Something went wrongssss!')</script>";
     }
}
?>
<html>
<head>
	<title>CRUD PDO</title>
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

            <div class="container-fluid">

                <div class="col-xs-12">

                        <button type="button" class="btn btn-sm btn-primary" aria-label="Left Align" data-toggle="modal" data-target="#addRecord">
                          <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Record
                        </button>

                        <table class='table table-bordered table-responsive'>
                         <tr>
                         <th>First Name</th>
                         <th>Middle Name</th>
                         <th>Last Name</th>
                         <th>Email Address</th>
                         <th colspan="2" align="center">Actions</th>
                         </tr>
                         <?php
                      $query = "SELECT * FROM persons where status = 1";       
                      $records_per_page=3;
                      $newquery = $crud->paging($query,$records_per_page);
                      $crud->dataview($newquery);
                      ?>
                        <tr>
                            <td colspan="7" align="center">
                        <div class="pagination-wrap">
                                <?php $crud->paginglink($query,$records_per_page); ?>
                             </div>
                            </td>
                        </tr>
                     
                    </table>
                </div>


            </div>

        </div>

    </div>


<form action="" method="POST">
     <div class="modal fade" id="addRecord" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Record</h4>
          </div>

          <div class="modal-body">
            

                    <div class="form-group">
                        <label for="InputFirstName">First Name</label>
                        <input type="text" class="form-control" id="InputFirstName" name="firstname" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="InputFirstName">Middle Name</label>
                        <input type="text" class="form-control" id="InputMiddleName" name="middlename" placeholder="Middle Name" required>
                    </div>

                    <div class="form-group">
                        <label for="InputFirstName">Last Name</label>
                        <input type="text" class="form-control" id="InputLastName" name="lastname" placeholder="Last Name" required>
                    </div>

                    <div class="form-group">
                        <label for="InputFirstName">Email address</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Email address" required>
                    </div>

                    <div class="form-group">
                        <label for="InputFirstName">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password" required>
                    </div>
                    

               
          </div>

          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Save" name="save">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>


<form action="" method="POST">
     <div class="modal fade" id="updateRecord" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Record</h4>
          </div>

          <div class="modal-body">
            
                    <div class="form-group">
                        <input type="text" class="form-control" id="person_id" name="person_id">
                    </div>
                    <div class="form-group">
                        <label for="InputFirstName">First Name</label>
                        <input type="text" class="form-control" id="InputFirstName" name="firstname" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="InputFirstName">Middle Name</label>
                        <input type="text" class="form-control" id="InputMiddleName" name="middlename" placeholder="Middle Name" required>
                    </div>

                    <div class="form-group">
                        <label for="InputFirstName">Last Name</label>
                        <input type="text" class="form-control" id="InputLastName" name="lastname" placeholder="Last Name" required>
                    </div>

                    <div class="form-group">
                        <label for="InputFirstName">Email address</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Email address" required>
                    </div>

                    <div class="form-group">
                        <label for="InputFirstName">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password" required>
                    </div>
                    

               
          </div>

          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Update" name="update">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>


</body>
<script>
$(document).ready(function(){
    $('#updateRecord').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'fetch.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('#person_id').html(data);//Show fetched data from database
            }
        });
     });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>

