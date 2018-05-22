<?php
session_start();

include("DBconfig.php");

$sql_fields = "SELECT * FROM data_type";
$result_fields = $conn->query($sql_fields);
$length = 0;
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

	<!-- Built CSS File -->
	<link href="css/formBuilder.css" type="text/css" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Animate.css CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

	<!-- FontAwesome CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- My own Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>


<header style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle = "collapse" data-target="#m-mainNavbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">JRLU</a>
			</div>

			<!-- Collect the nav links for toggling -->
			<div class="collapse navbar-collapse" id="m-mainNavbar">
				<p class="navbar-text navbar-right"><?php echo $_SESSION['fullname'] ?></p>

				<a href="logout.php" type="button" id="m-btn-logout" class="btn btn-default navbar-btn navbar-right">Log out</a>
			</div>
			<!-- End .navbar-collapse -->
		</div>
		<!-- End .container -->
	</nav>
</header>

<body>

	<div class="container">
		<form role="form" class="form-horizontal" action="createService.php" method="POST">

			<!-- Building Service -->
			<div class="row service-builder">
				<div class="col-xs-12 col-sm-8">
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



			<!--Building Fields -->
			<div class="row form-builder">
				<div class="col-xs-12">
					<label class="control-label" style="font-size: 30px; margin: 0"> Build Fields for the Service</label>
					<hr>
				</div>


				<!-- Checkboxes for the frequently used data fields -->
				
					<div class="col-xs-12 col-sm-12 checkboxes">
						<!-- PHP for loop to display all data types from database -->
						<?php while ($row = $result_fields->fetch_assoc()){
						echo
						'<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox'.++$length.'" name="common_fields[]" value="'.$row['dataTypeID'].'">'.$row['fieldName'].'
						</label>';
						}
						?>
						<!-- End of loop -->
					</div>
				<!-- End of Checkboxes for the frequently used data fields -->

					<div class="col-xs-12 col-sm-12">
						
						<!-- Container to dynamically increase and hold all fields --> 
						<div class="col-xs-12" id="fields-container"> </div>
						<!--End of Container to dynamically increase and hold all fields -->

						<!-- Button for adding fields -->	
						<div class="add-btn" style="text-align: center;">
							<input type="button" value="Add Field" class="btn btn-default" id="add_field" onclick="addFields();" style="margin-top: 10px;">
						</div>
						<!-- End of Button for adding fields -->

					</div>

					<!-- Container to dynamically increase and hold all fields --> 
					<div class="col-xs-12" id="fields-container"> </div>
					<!--End of Container to dynamically increase and hold all fields -->

					<!-- Submit and Reset buttons for entire form -->
					<div class="col-xs-12" style="margin-bottom: 40px;">
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