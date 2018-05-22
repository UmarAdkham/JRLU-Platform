<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Add new Branch</title>

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
    <div class="row">

      <div class="col-sm-4 col-sm-offset-4 form-section">
        <h1 class="text-center" style="font-family: 'Oswald', sans-serif;">New Branch</h1>

        <div class="tab-content form-content">
          <div id="jobSeeker" class="tab-pane fade in active">
            <form data-toggle="validator" class="form-horizontal" id="jobSeeker-form" action="branch.php" method="POST">
              <fieldset>

                <div class="form-group has-feedback">
                  <label class="control-label" for="branch_name">Branch name</label>
                  <div class="controls">
                    <input type="text" pattern="^[_A-z0-9]{1,}$" maxlength="15" id="branch_name" name="branch_name" class="form-control" required>
                    <p class="help-block with-errors"></p>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label" for="address">Address</label>
                  <div class="controls">
                    <textarea class="form-control" id="address" name="address" rows="3" maxlength="500" style="resize: none;" required></textarea>
                    <p class="help-block with-errors"></p>  
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label class="control-label" for="postcode">Postcode</label>
                  <div class="controls">
                    <input type="number" id="postcode" name="postcode" class="form-control" maxlength = "50" required>
                    <p class="help-block with-errors"></p>
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
