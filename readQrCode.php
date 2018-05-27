<?php
session_start();

include("DBconfig.php");

$qrCode = $_POST['qrCode'];

echo $qrCode;

$conn->close();

?>
