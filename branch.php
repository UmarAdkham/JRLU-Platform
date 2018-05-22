<?php
session_start();

include("DBconfig.php");

$branchName = $_POST['branch_name'];
$postcode = $_POST['postcode'];
$address = $_POST['address'];

/*$branchName = "branch_name";
$postcode = 60000;
$address = "TTDI";*/

echo $branchName;

//$username = 'umarAdkham';
//$password = 'password';

$sql = "INSERT INTO branch(branchName, bankID, address, postcode) VALUES ('$branchName', '".$_SESSION['bankID']."', '$address', '$postcode')";

if ($conn->query($sql) === TRUE) {
    $message = "New Branch added successfully";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href = 'branchPage.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>