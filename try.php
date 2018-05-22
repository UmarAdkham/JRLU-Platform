<?php
error_reporting(0);

session_start();
include "DBconfig.php";

$query = "SELECT * FROM branch WHERE bankID='".$_SESSION['bankID']."'";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)){
        echo $row['branchName'];
     }


?>