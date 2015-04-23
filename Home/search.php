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

$zipcodeSearchQuery = "SELECT * FROM golfbagmodel WHERE address_id IN (SELECT address_id FROM addressmodel WHERE zipcode='$zipcode')";
$zipcodeSearchResult = $conn->query($zipcodeSearchQuery);
if (!$zipcodeSearchResult) die ("Database access failed: " . $conn->error);

$rows = $zipcodeSearchResult->num_rows;


$zipcodeSearchQuery = "SELECT * FROM golfbagmodel WHERE address_id IN (SELECT address_id FROM addressmodel WHERE zipcode='$zipcode')";
$zipcodeSearchResult = $conn->query($zipcodeSearchQuery);
if (!$zipcodeSearchResult) die ("Database access failed: " . $conn->error);

$rows = $zipcodeSearchResult->num_rows;

echo "<table><tr> <th>Picture</th> <th>Description</th> <th>Daily Rate</th> </tr>";

for ($j = 0 ; $j < $rows ; ++$j)
{
  $zipcodeSearchResult->data_seek($j);
  $row = $zipcodeSearchResult->fetch_array(MYSQLI_NUM);
  echo "<tr>";
  echo "<td><a href='http://localhost/GCS/Home/displayItem.php?golfItemAndSupplierId=$row[0]-$row[1]'><image src='http://localhost/GCS/Profile/$row[3]' style='width:128px;height:128px'></a></td>";
  for ($k = 4 ; $k < 6 ; ++$k)
  {
    echo "<td>$row[$k]</td>";
  }
  echo "</tr>";
}

echo "</table>";

