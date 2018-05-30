<?php
include("DBconfig.php");
$outp = $_POST['outp'];
$appointmentID = $_POST['appointmentID'];


$sql = "UPDATE appointment SET status = 1 WHERE appointmentID = '$appointmentID'";

if ($conn->query($sql) === TRUE) 
{
echo "<script type='text/javascript'>alert('$outp');
				window.location.href = 'teller_home.php';
				</script>";
}
?>