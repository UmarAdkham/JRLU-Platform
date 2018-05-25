<?php
	include("DBconfig.php");

	$serviceID = $_POST['serviceID'];

	$sql = "DELETE FROM service WHERE serviceID = $serviceID";

	if($conn->query($sql) === TRUE) {
			$message = "The service deleted successfully";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href = 'superAdmin.php';</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}


	$conn->close();

?>
