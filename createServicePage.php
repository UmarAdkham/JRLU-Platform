<?php
session_start();

include("DBconfig.php");

$sql_fields = "SELECT * FROM data_type";
$result_fields = $conn->query($sql_fields);
$length = 0;

$sql_hardcopy = "SELECT * FROM hardcopy";
$result_hardcopy = $conn->query($sql_hardcopy);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Build Service Form</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- icon -->
	<link rel="icon" href="icon.ico" type="image/x-icon">

	<!-- Google font: Oswald -->
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Built CSS File -->
	<link href="css/formBuilder.css" type="text/css" rel="stylesheet">

	<!-- Animate.css CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

	<!-- FontAwesome CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- My own Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<?php include "header.php"; ?>

<body>

	<div class="container">
		<h1 style="margin-top:100px; text-align:center;">Create New Service</h1>
		<form role="form" class="form-horizontal" action="createService.php" method="POST">

			<!-- Building Service -->
			<div class="row">
				<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 main-service">
					<div class="form-group">
						<label for="name" class="control-label">Service Name:</label>
						<input type="text" name="service_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="description" class="control-label">Description of the Service:</label>
						<textarea name= "description" class="form-control" rows="5"></textarea>
					</div>
				</div>
			</div>
			<!-- End of Building Service Row -->

				<!-- Checkboxes for the frequently used data fields -->

					<div class="col-lg-offset-2 col-lg-4 col-md-offset-1 col-md-6 checkboxes">

						<h3>Service Fields</h3>

						<!-- PHP for loop to display all data types from database -->
						<?php while ($row = $result_fields->fetch_assoc()){
						echo
						'<div class="checkbox">
							<label class="checkbox-inline">
								<input type="checkbox" id="inlineCheckbox'.++$length.'" name="common_fields[]" value="'.$row['dataTypeID'].'">'.$row['fieldName'].'
							</label>
							<label class="checkbox-inline pull-right">
								<input type="checkbox" name="required" value="">Required
							</label>
						</div>
						';
						}
						?>
						<!-- End of loop -->


						<!-- Container to dynamically increase and hold all fields -->
						<div id="fields-container"> </div>
						<!--End of Container to dynamically increase and hold all fields -->

						<!-- Button for adding fields -->
						<div class="add-btn">
							<input type="button" value=" + " class="btn btn-default" id="add_field" onclick="addFields();" style="margin-top: 10px; background-color: green; color: white;">
						</div>
						<!-- End of Button for adding fields -->

					</div>
					<!-- End of Checkboxes for the frequently used data fields -->

					<div class="col-md-offset-1 col-md-3 checkboxes">

						<h3>Service Hardcopies</h3>

						<!-- PHP for loop to display all data types from database -->
						<?php while ($row = $result_hardcopy->fetch_assoc()){
						echo
						'<div class="checkbox">
							<label class="checkbox">
								<input type="checkbox" name="hardcopies[]" value="'.$row['hardcopyID'].'">'.$row['documentName'].'
							</label>
						</div>
						';
						}
						?>
						<!-- End of loop -->

					</div>

					<!-- Submit and Reset buttons for entire form -->
					<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10" style="padding: 40px 15px;">
						<button type="reset" class="btn btn-reset btn-default">Clear All</button>
						<button type="submit" class="btn btn-submit btn-success pull-right">Add Service</button>
					</div>
			</div>

			<!-- End Building Fields -->
		</form>
	</div>




	<!-- jQuery -->
	<script src="js/jquery-2.2.3.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="js/form_builder.js"></script>

</body>
</html>