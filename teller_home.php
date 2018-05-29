<?php
//error_reporting(0);
session_start();
include "DBconfig.php";
$username = $_SESSION['username'];
$today = (new DateTime("today", new DateTimeZone('Asia/Kuala_Lumpur')))->format('Y-m-d');
echo $today;
$sql_select_appointment = "SELECT time_interval FROM time_intervals, appointment WHERE time_intervals.interval_id = appointment.interval_id AND staffID = '$username' AND appointment_date = '$today' ORDER BY time_intervals.interval_id ASC";
if ($result_select_appointment = $conn->query($sql_select_appointment)) {
	$row_count_select_appointment =mysqli_num_rows($result_select_appointment);
	if ($row_count_select_appointment>0) {
		$i = 1;
		while($row_select_appointment=mysqli_fetch_assoc($result_select_appointment)) {
			$time = $row_select_appointment['time_interval'];
      $startTime[$i] = explode("-", $time)[0];
      $endTime[$i] = explode("-", $time)[1];
			$i++;
		}
	}
} else {
	$row_count_select_appointment = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bank Teller</title>

  <!-- icon -->
  <link rel="icon" href="icon.ico" type="image/x-icon">

  <!-- Google font: Oswald -->
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/login.css" rel="stylesheet">
  <link href="css/tellerHome.css" rel="stylesheet">
</head>

<?php include "header.php"; ?>
<body>
<div id="tellerHome" class="container">
	<div><img src="zeroQ_logo.png" alt="logo" width="150" style="margin-left: -12px;"></div>
	
  <div class="row">
    <div class="col-sm-6">
      <h2 style="margin-bottom: 50px;">Hi, <?php echo $_SESSION['fullname'] ?>! Your appointments for today</h2>
      <?php if ($row_count_select_appointment == 0) {
        echo "<p>There is no appointments for today</p>";
      } else {
        echo "
        <table class='table table-bordered table-hover'>
          <thead>
            <tr>
              <th>#</th>
              <th>Start Time</th>
              <th>End Time</th>
            </tr>
          </thead>
          <tbody>";
            for ($i = 1; $i <=$row_count_select_appointment; $i++) {
              echo "
                <tr>
                  <td>$i</td>
                  <td>$startTime[$i]</td>
                  <td>$endTime[$i]</td>
                </tr>
              ";
            } echo "
          </tbody>
        </table>
        ";
      }
       ?>

    </div>
    <div class="col-sm-6">
      <h2 class="text-center"><a href="teller_scanner.php">Scan QR Code</a></h2>
    </div>
  </div>
</div>


<!-- jQuery -->
<script src="js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!--Validator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


</body>

</html>
