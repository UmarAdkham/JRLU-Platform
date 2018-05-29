<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Add admin</title>

  <!-- icon -->
  <link rel="icon" href="icon.ico" type="image/x-icon">

  <!-- Google font: Oswald -->
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/login.css" rel="stylesheet">
</head>

<?php include "header.php"; ?>
<body>

<div class="container" id="login-section">
  <div><img src="zeroQ_logo.png" alt="logo" width="150" style="margin-left: -12px;"></div>
  <div class="row">

    <div class="col-sm-4 col-sm-offset-4 form-section">
      <h1 class="text-center" style="font-family: 'Oswald', sans-serif;">New Admin</h1>

      <div class="tab-content form-content">
        <div id="jobSeeker" class="tab-pane fade in active">
          <form data-toggle="validator" class="form-horizontal" id="jobSeeker-form" action="new_admin.php" method="POST">
            <fieldset>

              <div class="form-group has-feedback">
                <label class="control-label" for="fullname">Full Name</label>
                <div class="controls">
                  <input type="text" pattern="^[_A-z0-9]{1,}$" maxlength="15" id="fullname" name="fullname" class="form-control" required>
                  <p class="help-block with-errors"></p>
                </div>
              </div>

               <div class="form-group">
                      <label class="control-label" for="branch">Branch</label>
                      <div class="controls">
                        <select class="form-control" id="branchID" name="branchID" required>
                            <?php while($row2 = mysqli_fetch_array($result2)):;?>
                            <option value="<?php echo $row2['branchID'];?>"><?php echo $row2['branchName'];?></option>
                            <?php endwhile;?>
                        </select>
                        <p class="help-block with-errors">Please provide the category</p>
                      </div>
                    </div>

              <div class="form-group has-feedback">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                  <input type="text" id="username" name="username" class="form-control" maxlength = "50" required>
                  <p class="help-block with-errors"></p>
                </div>
              </div>

               <div class="form-group has-feedback">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                  <input type="password" data-minlength="6" id="password" name="password" class="form-control" data-error="Password should be at least 6 characters" maxlength = "50" required>
                  <p class="help-block with-errors">Please provide your password</p>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="control-label" for="password_confirm">Password (Confirm)</label>
                <div class="controls">
                  <input type="password" id="password_confirm" data-match="#password" data-match-error="Whoops, these don't match" name="password_confirm" class="form-control" maxlength = "50" required>
                  <p class="help-block with-errors">Please confirm password</p>
                </div>
              </div>


              <div class="controls">
                <button type="submit" name = "submit" class="btn btn-submit btn-success btn-block">Add</button>
              </div>

            </fieldset>
          </form>

        </div>

      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>



<!-- jQuery -->
<script src="js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!--Validator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


</body>

</html>
