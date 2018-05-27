<?php
session_start();

include("DBconfig.php");

$qrCode = $_POST['qrCode'];

$appintmentID = explode("<>",$qrCode)[0];

$sql = "SELECT * FROM filleddata where appointmentID = '$appintmentID'";
$result = $conn->query($sql);
while($row =mysqli_fetch_assoc($result)) {
  echo $row['fieldName']." - ";
  echo $row['data'];
  echo "<hr>";
}

$conn->close();

?>
