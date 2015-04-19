<?php
if (empty($_POST["address"])) {
		$addressERR = "Street Address is required.";
    echo $addressERR;
	}
	else {
		$address = test_input($_POST["address"]);
	}

if (empty($_POST["addressLineTwo"])) {
		$addressLineTwo = $_POST["addressLineTwo"];
	}
	else {
		$addressLineTwo = test_input($_POST["addressLineTwo"]);
	}

  if (empty($_POST["city"])) {
  	$cityERR = "City is required";
    echo $cityERR;
  }
  else {
  	$city = test_input($_POST["city"]);
  }

  if (empty($_POST["state"])) {
  	$stateERR = "State is required";
    echo $stateERR;
  }
  else {
  	$state = $_POST["state"];
  }

  if (empty($_POST["zipcode"])) {
  	$zipcodeERR = "Zipcode is required";
    echo $zipcodeERR;
  }
  elseif (pc_validate_zipcode($_POST['zipcode'])) {
    // U.S. Zip Code is okay, can proceed
    $zipcode = $_POST['zipcode'];
}
  else {
  	$zipcodeERR = "Invalid zipcode";
    echo $zipcodeERR;
  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function pc_validate_zipcode($zipcode) {
    return preg_match('/^[0-9]{5}([- ]?[0-9]{4})?$/', $zipcode);
}

$servername = "localhost";
$username = "rmyers7";
$password = "testpw";
$dbname = "golfclubsharingtestdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$insertAddressIntoAddressModel = "INSERT INTO addressmodel (streetAddressOne, streetAddressTwo, city, state, zipcode) VALUES ('$address','$addressLineTwo','$city','$state','$zipcode')";

if ($conn->query($insertAddressIntoAddressModel) === TRUE) {
    echo "New address record created successfuly";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
