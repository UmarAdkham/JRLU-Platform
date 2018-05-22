<?php
  session_start();
  unset($_SESSION["username"]);
  unset($_SESSION["type"]);
  unset($_SESSION["fullname"]);
  unset($_SESSION["bankID"]);
  unset($_SESSION["branchID"]);
  header("Location: index.php");
?>
