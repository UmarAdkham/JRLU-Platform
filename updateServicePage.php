<?php
session_start();

include("DBconfig.php");

$serviceID = $_POST['serviceID'];

$sql_service = "SELECT * FROM service where serviceID = '$serviceID'";
if ($result_service = $conn->query($sql_service)) {
	$row_service=mysqli_fetch_assoc($result_service);
}

$sql_checked_fields = "SELECT * FROM service_data_type where serviceID = '$serviceID'";
$result_checked_fields = $conn->query($sql_checked_fields);
$row_count_checked_fields =mysqli_num_rows($result_checked_fields);
if ($row_count_checked_fields>0) {
	$i = 1;
	while($row_checked_fields=mysqli_fetch_assoc($result_checked_fields)) {
		$dataTypeID_checked_fields[$i] = $row_checked_fields['dataTypeID'];
		$required_checked_fields[$i] = $row_checked_fields['required'];
		$i++;
	}
}


$sql_checked_hardcopy = "SELECT * FROM service_hardcopy where serviceID = '$serviceID'";
$result_checked_hardcopy = $conn->query($sql_checked_hardcopy);
$row_count_checked_hardcopy =mysqli_num_rows($result_checked_hardcopy);
if ($row_count_checked_hardcopy>0) {
	$i = 1;
	while($row_checked_hardcopy=mysqli_fetch_assoc($result_checked_hardcopy)) {
		$hardcopyID_checked[$i] = $row_checked_hardcopy['hardcopyID'];
		$i++;
	}
}

$sql_fields = "SELECT * FROM data_type";
$result_fields = $conn->query($sql_fields);
$length = 0;

$sql_hardcopy = "SELECT * FROM hardcopy";
$result_hardcopy = $conn->query($sql_hardcopy);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Update Service Form</title>

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
		<h1 style="margin-top:100px; text-align:center;">Update Service</h1>
		<form role="form" class="form-horizontal" action="updateService.php" method="POST">

			<!-- Building Service -->
			<div class="row">
				<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 main-service">
					<div class="form-group">
						<label for="name" class="control-label">Service Name:</label>
						<input type="text" name="service_name" class="form-control" value="<?php echo $row_service['serviceName']; ?>">
					</div>
					<div class="form-group">
						<label for="description" class="control-label">Description of the Service:</label>
						<textarea name= "description" class="form-control" rows="5"><?php echo $row_service['description']; ?></textarea>
					</div>
				</div>
			</div>
			<!-- End of Building Service Row -->

				<!-- Checkboxes for the frequently used data fields -->

					<div class="col-lg-offset-2 col-lg-4 col-md-offset-1 col-md-6 checkboxes">

						<h3>Service Fields</h3>

						<!-- PHP for loop to display all data types from database -->
						<?php while ($rowField = $result_fields->fetch_assoc()){

							$isFieldChecked = false;
							$isRequiredChecked = false;
							for ($i=1; $i <= $row_count_checked_fields; $i++) {
								if ($rowField['dataTypeID'] == $dataTypeID_checked_fields[$i]) {
									$isFieldChecked = true;
									if ($required_checked_fields[$i] == 1) {
										$isRequiredChecked = true;
									}
									break;
								}
							}

							echo
							'<div class="checkbox">
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox'.++$length.'" name="common_fields[]"'; if ($isFieldChecked) {echo "checked";} echo' value="'.$rowField['dataTypeID'].'">'.$rowField['fieldName'].'
								</label>
								<label class="checkbox-inline pull-right">
									<input type="checkbox" name="requireds[]"'; if ($isRequiredChecked) {echo "checked";} echo' value="'.$rowField['dataTypeID'].'">Required
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
							$isHardcopyChecked = false;
							for ($i=1; $i <= $row_count_checked_hardcopy; $i++) {
								if ($row['hardcopyID'] == $hardcopyID_checked[$i]) {
									$isHardcopyChecked = true;
									break;
								}
							}

						echo
						'<div class="checkbox">
							<label class="checkbox">
								<input type="checkbox" name="hardcopies[]"'; if ($isHardcopyChecked) {echo "checked";} echo' value="'.$row['hardcopyID'].'">'.$row['documentName'].'
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
						<input class='hidden' name='serviceID' value='<?php echo $serviceID; ?>'>
						<button type="submit" class="btn btn-submit btn-success pull-right">Update Service</button>
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
