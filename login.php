<?php
session_start();

include("DBconfig.php");

$username = $_POST['login-username'];
$password = $_POST['login-password'];

//$username = 'umarAdkham';
//$password = 'password';

  $sql_admin = mysqli_query($conn, "SELECT * from staff where username = '$username'");

  $row_cnt = $sql_admin->num_rows;
  if ($row_cnt > 0) {
     while($row = $sql_admin->fetch_array()){
     $hashed_password = $row['password'];
       if ($hashed_password === $password) {
         $_SESSION['username'] = $username;
         $_SESSION['fullname'] = $row['fullname'];
         $_SESSION['bankID'] = $row['bankID'];
         $_SESSION['branchID'] = $row['branchID'];
         $_SESSION['type'] = $row['type'];
         if ($_SESSION['type'] === 'Superadmin') {
           header("location: home.php");
         }
         elseif ($_SESSION['type'] === 'Admin') {
           header("location: addStaffPage.php");
         }
         else{
           header("location: teller_home.php");
         }

         
         
         }
       else{
         $message = "Wrong username or password";
         echo "<script type='text/javascript'>alert('$message'); 
         window.location.href = 'index.php';
        </script>";
        }
     }
  }else{
         $message = "Wrong username or password";
         echo "<script type='text/javascript'>alert('$message');
         window.location.href = 'index.php'; 
        </script>";
        }

$conn->close();

?>