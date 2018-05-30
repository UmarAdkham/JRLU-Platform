<?php
session_start();

include("DBconfig.php");

//Variables for service table
$name = $_POST['service_name'];
$desc = $_POST['description'];
$branchID = $_SESSION['branchID'];
$common_fields = $_POST['common_fields'];
$requireds = $_POST['requireds'];
$fieldName = $_POST['field_name'];
$fieldType = $_POST['field_type'];
$common_hardcopies = $_POST['common_hardcopies'];
$hardcopies = $_POST['hardcopies'];


//Get bankID from branchID
$sql_bank = "SELECT bank.bankID from bank, branch WHERE bank.bankID = branch.bankID and branchID='$branchID'";
  $result_bank = $conn->query($sql_bank);


  while ($rs_bank = $result_bank->fetch_array()) {
     $_SESSION['bankID'] = $rs_bank['bankID'];
 }
 $bankID = $_SESSION['bankID'];

//Variables for data_type table
$sql = "INSERT INTO service (serviceName, bankID, description) VALUES ('$name', '$bankID', '$desc')";

//Getting auto inserted ID of the service
if ($conn->query($sql) === TRUE)
{
	$last_service_id = $conn->insert_id;

//Inserting values into data_type table from checkboxes
$numOfCheckBoxes = count($common_fields);

  $numOfRequireds = count($requireds);
	for ($i=0; $i < $numOfCheckBoxes; $i++) {
    $isRequired = false;
    for ($j=0; $j < $numOfRequireds; $j++) {
      if ($common_fields[$i] == $requireds[$j]) {
        $isRequired = true;
        break;
      }
    }
    if ($isRequired) {
      ${"sqlBridge$i"} = "INSERT INTO service_data_type VALUES ('$last_service_id', '$common_fields[$i]', '1')";
    } else {
      ${"sqlBridge$i"} = "INSERT INTO service_data_type VALUES ('$last_service_id', '$common_fields[$i]', '0')";
    }
		$conn -> query(${"sqlBridge$i"});
	}

  //Inserting values into hardcopy table from checkboxes
    $numOfHardcopies = count($common_hardcopies);
  	for ($i=0; $i < $numOfHardcopies; $i++) {
        ${"sqlBridgeHardcopy$i"} = "INSERT INTO service_hardcopy VALUES ('$last_service_id', '$common_hardcopies[$i]')";
        $conn -> query(${"sqlBridgeHardcopy$i"});
    }


//Inserting values into data_type table from POSTed array
	$numOfFields = count($fieldName);
	for ($i=0; $i < $numOfFields; $i++) {
		if ($fieldName[$i] != NULL) {
			${"sql$i"} = "INSERT INTO data_type (fieldName, fieldType) VALUES ('$fieldName[$i]', '$fieldType[$i]')";
			if ($conn->query(${"sql$i"}) === TRUE)
		{
			${"last_datatype_id$i"} = $conn->insert_id;
		}
		//Inserting into bridge table service_data_type
		${"sqlBridge$i"} = "INSERT INTO service_data_type VALUES ('$last_service_id', '${"last_datatype_id$i"}', 0)";
		$conn -> query(${"sqlBridge$i"});
		}
	}

  //Inserting values into hardcopy table (additional)
    $numOfHardcopyCheckboxes = count($hardcopies);
  	for ($i=0; $i < $numOfHardcopyCheckboxes; $i++) {
  		if ($hardcopies[$i] != NULL) {
  			${"sql$i"} = "INSERT INTO `hardcopy`(`documentName`) VALUES ('$hardcopies[$i]')";
  			if ($conn->query(${"sql$i"}) === TRUE)
  		{
  			${"last_hardcopy_id$i"} = $conn->insert_id;
  		}
  		//Inserting into bridge table service_data_type
  		${"sqlBridge$i"} = "INSERT INTO service_hardcopy VALUES ('$last_service_id', '${"last_hardcopy_id$i"}')";
  		$conn -> query(${"sqlBridge$i"});
  		}
  	}


	$message = "New Service created successfully";
  echo "<script type='text/javascript'>alert('$message');
  window.location.href = 'superAdmin.php';
  </script>";


} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
