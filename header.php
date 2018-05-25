
<?php
if(!isset($_SESSION)) { 
		session_start();
}
include "DBconfig.php";

$query = "SELECT bankName FROM bank WHERE bankID='".$_SESSION['bankID']."'";

$result = mysqli_query($conn, $query);

//Query to retrieve branch names for new_adminPage.php
$query2 = "SELECT * FROM branch WHERE bankID='".$_SESSION['bankID']."'";
$result2 = mysqli_query($conn, $query2);
//End of query
?>

<header style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle = "collapse" data-target="#cl-mainNavbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#" style="color: white;"><?php $row = mysqli_fetch_array($result);
				echo strtoupper($row[0]) . " (" . $_SESSION['type'] . ")"; ?></a>

			</div>
			<!-- Collect the nav links for toggling -->
			<div class="collapse navbar-collapse" id="cl-mainNavbar">
				<?php  if ($_SESSION['type'] === 'Superadmin') {
					echo '<ul class="nav navbar-nav">
					<li><a href="superAdmin.php" id="upcoming-button">Service</a></li>
					<li><a href="branchPage.php" id="passed-button">Branch</a></li>
					<li><a href="new_adminPage.php" id="current-button">Admin</a></li>
					</ul>';
				}
				?>

				<p class="navbar-text navbar-right"><?php echo $_SESSION['fullname'];?></p>
				<a href="logout.php" type="button" id="btn-logout" class="btn btn-default navbar-btn navbar-right">Log out</a>
			</div>
			<!-- End .navbar-collapse -->
		</div>
		<!-- End .container -->
	</nav>

</header>
</header>
