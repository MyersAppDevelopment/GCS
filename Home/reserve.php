<?php
session_start();
$golfItemId = $_SESSION['golfItemId'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["reserveDate"])) {
		$reserveDateERR = "Requested reserve date required.";
    echo $reserveDateERR;
	}
	else {
		$reserveDateInitial = test_input($_POST["reserveDate"]);
		date_default_timezone_set('America/New_York');
		$reserveDate = date("Y-m-d", strtotime($reserveDateInitial));
		}
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

$checkForExistingReservationOnDate = "SELECT * FROM reservedClubsModel WHERE golfItems_id='$golfItemId' AND dateReserved='$reserveDate'";
$existingReservationResult = $conn->query($checkForExistingReservationOnDate);
if (!$existingReservationResult) die ("Database access failed: " . $conn->error);

$rows = $existingReservationResult->num_rows;

if ($rows == 0){
$insertGolfBagIntoReserveModel = "INSERT INTO reservedclubsmodel (golfItems_id, dateReserved) VALUES ('$golfItemId','$reserveDate')";

if ($conn->query($insertGolfBagIntoReserveModel) === TRUE) {
    echo "New reservation created.";
    unset($golfItemId);
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
else {
	echo "The clubs are already reserved for that date";
}
