<?php
//Configuration of database connection
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "new_jrlu"; /* Database name */

$conn = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$conn) {
 die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>