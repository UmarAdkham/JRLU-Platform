<?php
session_start();
include 'AES.php';
include("DBconfig.php");

$qrCode = $_POST['qrCode'];

$appointmentID = explode("<>",$qrCode)[0];
$decryption_key = explode("<>", $qrCode)[1];

$blockSize = 256;

$getServiceName = mysqli_query($conn, "SELECT serviceName FROM service, appointment WHERE service.serviceID = appointment.serviceID and appointmentID = '$appointmentID'") or die(mysqli_error());
while ($myRow = mysqli_fetch_assoc($getServiceName)){
	$serviceName = $myRow['serviceName'];
}

$sql = "SELECT * FROM filleddata where appointmentID = '$appointmentID'";
$result = $conn->query($sql);
$row_cnt = mysqli_num_rows($result);
$i = 1;
while($row =mysqli_fetch_assoc($result)) {
	$aes = new AES($row['data'], $decryption_key, $blockSize);
	$dec[$i] = $aes->decrypt();
	$fieldName[$i] = $row['fieldName'];
	$i++;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bank Teller</title>

	<!-- Google font: Oswald -->
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/login.css" rel="stylesheet">
	<link href="css/tellerHome.css" rel="stylesheet">
</head>

<?php include "header.php"; ?>

<body>
	<div id="tellerHome" class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2 class="text-center" style="margin-bottom: 50px;"><?php echo $serviceName ?></h2>
				<?php if ($row_cnt == 0) {
					echo "<p>No data has been submitted</p>";
				} else {
					$outp = '[';
					echo "
					<table class='table table-bordered table-hover'>
					<thead>
					<tr>
					
					<th>Field name</th>
					<th>Value</th>
					</tr>
					</thead>
					<tbody>";
					for ($i = 1; $i <=$row_cnt; $i++) {
						$outp .= '{"fieldName":"'.$fieldName[$i].'",';
						$outp .= '"value":"'.$dec[$i].'"}';
						echo "
						<tr>
						<td>$fieldName[$i]</td>
						<td>$dec[$i]</td>
						</tr>
						";
						} 
						$outp .= ']}';
						echo "
						</tbody>
						</table>
						";
					}
					?>

				</div>
				<form role="form" class="form-horizontal" action="generateJson.php" method="POST">
					<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10" style="padding: 40px 15px;">
						<?php $new = htmlspecialchars($outp, ENT_QUOTES);?>
						<input id="json" name="outp" type="hidden" value="<?php echo $new; ?>">
						<input id="appointmentID" name="appointmentID" type="hidden" value="<?php echo $appointmentID; ?>">

						<button type="reset" class="btn btn-reset btn-default">Reject application</button>

						<button type="submit" class="btn btn-submit btn-success pull-right">Confirm application</button>
					</div>
				</form>
			</div>


			<!-- jQuery -->
			<script src="js/jquery-2.2.3.min.js"></script>

			<!-- Bootstrap Core JavaScript -->
			<script src="js/bootstrap.min.js"></script>

			<!--Validator -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


		</body>

		</html>

		<?php
		$conn->close();
		?>
