<?php
session_start();

include("DBconfig.php");

$username = $_SESSION['username'];
$sql_select_service = "SELECT serviceID, serviceName, description FROM service JOIN staff ON service.bankID = staff.bankID WHERE staff.username = '$username'";
if ($result_select_service = $conn->query($sql_select_service)) {
	$row_count_select_service =mysqli_num_rows($result_select_service);
	if ($row_count_select_service>0) {
		$i = 1;
		while($row_select_service=mysqli_fetch_assoc($result_select_service)) {
			$serviceID_selected_service[$i] = $row_select_service['serviceID'];
			$serviceName_selected_service[$i] = $row_select_service['serviceName'];
			$description_selected_service[$i] = $row_select_service['description'];
			$i++;
		}
	}
} else {
	$row_count_select_service = 0;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Super Admin</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- icon -->
	<link rel="icon" href="icon.ico" type="image/x-icon">

	<!-- Google font: Oswald -->
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

	<!-- Built CSS File -->
	<link href="css/service.css" type="text/css" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Animate.css CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

	<!-- FontAwesome CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- My own Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<?php include "header.php"; ?>

<body>

	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="col-sm-offset-1 col-sm-10">
				<h2 class="text-center" style="margin-bottom: 50px;">Current Services</h2>
				<?php if ($row_count_select_service == 0) {
					echo "<p>No services have been created yet</p>";
				} else {
					echo "
					<table class='table table-striped'>
						<thead>
							<tr>
								<th>#</th>
								<th>Service</th>
								<th>Description</th>
								<th>Update</th>
							</tr>
						</thead>
						<tbody>";
							for ($i = 1; $i <=$row_count_select_service; $i++) {
								echo "
									<tr>
										<td>$i</td>
										<td>$serviceName_selected_service[$i]</td>
										<td>$description_selected_service[$i]</td>
										<td>
												<form action='updateService.php' method='post'>
														<input class='hidden' name='serviceID' value='$serviceID_selected_service[$i]'>
														<button type='submit' class='btn btn-success' style='margin-right:20px;'><i class='fas fa-edit'></i></button>
												</form>
												<form id='deleteServiceForm' action='deleteService.php' method='post'>
														<input class='hidden' name='serviceID' value='$serviceID_selected_service[$i]'>
														<button type='button' onclick='deleteConfirmation()' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button>
												</form>
										</td>
									</tr>
								";
							} echo "
						</tbody>
					</table>
					";
				}
				?>
				<div class="create-service text-center" style="margin-top:50px;">
					<h3><a href="createServicePage.php">Create New Service</a></h3>
				</div>
			</div>
		</div>
	</div>




	<!-- jQuery -->
	<script src="js/jquery-2.2.3.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script>
		function deleteConfirmation() {
				if (confirm("Are you sure that you want to delete this service?")) {
					document.getElementById("deleteServiceForm").submit();
				}
		}
	</script>
</body>
</html>
