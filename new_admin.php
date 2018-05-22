<?php
session_start();

include("DBconfig.php");

$fullname = $_POST['fullname'];
$branchID = $_POST['branchID'];
$username = $_POST['username'];
$password = $_POST['password'];

//$username = 'umarAdkham';
//$password = 'password';

$sql = "INSERT INTO staff VALUES ('$username', '$password', '$fullname', '".$_SESSION['bankID']."', '$branchID', 'Admin')";

if ($conn->query($sql) === TRUE) {
    $message = "New Admin added successfully";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href = 'new_adminPage.php';
    </script>";
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
    echo "<script type='text/javascript'>alert('$message');
    window.location.href = 'new_adminPage.php';
    </script>";
}


$conn->close();

?>