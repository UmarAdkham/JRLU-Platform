<?php
session_start();

include("DBconfig.php");

$fullname = $_POST['fullname'];
$branchID = $_SESSION['branchID'];
$username = $_POST['username'];
$password = $_POST['password'];

//$username = 'umarAdkham';
//$password = 'password';

$sql = "INSERT INTO staff VALUES ('$username', '$password', '$fullname', '".$_SESSION['bankID']."', '$branchID', 'Bank Teller')";

if ($conn->query($sql) === TRUE) {
    $message = "New Admin added successfully";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href = 'addStaffPage.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>