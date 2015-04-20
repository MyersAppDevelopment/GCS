<?php

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

$zipcodeSearchQuery = "SELECT id,fname,lname,email FROM usermodel WHERE address1_id IN (SELECT address_id FROM addressmodel WHERE zipcode='$zipcode')";
$zipcodeSearchResult = $conn->query($zipcodeSearchQuery);
if (!$zipcodeSearchResult) die ("Database access failed: " . $conn->error);

$rows = $zipcodeSearchResult->num_rows;
echo "<table><tr> <th>Id</th> <th>First Name</th> <th>Last Name</th> <th>Email Address</th> </tr>";

for ($j = 0 ; $j < $rows ; ++$j)
{
	$zipcodeSearchResult->data_seek($j);
	$row = $zipcodeSearchResult->fetch_array(MYSQLI_NUM);
	echo "<tr>";
	for ($k = 0 ; $k < 4 ; ++$k)
	{
		echo "<td>$row[$k]</td>";
	}
  echo "</tr>";
}

echo "</table>";
