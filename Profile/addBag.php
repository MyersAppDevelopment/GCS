<?php
session_start();
$customerId = $_SESSION['customerId'];
$addressId = $_SESSION['addressId'];

if (empty($_POST["description"])) {
		$descriptionERR = "Description is required.";
    echo $descriptionERR;
	}
	else {
		$description = test_input($_POST["description"]);
	}

if (empty($_POST["dailyRate"])) {
		$dailyRateERR = "Daily Rate is required.";
    echo $dailyRateERR;
	}
	else {
		$dailyRate = test_input($_POST["dailyRate"]);
	}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

$insertGolfBagIntoGolfBagModel = "INSERT INTO golfbagmodel (address_id, pictureReference, description, dailyRate, availability) VALUES ('$addressId','$pictureReference','$description','$dailyRate','TRUE')";

if ($conn->query($insertAddressIntoAddressModel) === TRUE) {
    echo "New bag record created.";
    	$lastBagId =  $conn->insert_id;
    	echo $lastBagId;

    	$updateUserModelForBag = "UPDATE usermodel SET golfItems_id='$conn->insert_id' WHERE id='$customerId'";
    	if ($conn->query($updateUserModelForAddress) === TRUE) {
    		echo "golfItems_id added into user model";
    	}
    	else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
    	}

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
