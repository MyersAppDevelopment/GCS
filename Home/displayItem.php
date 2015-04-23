<?php
$passedString = $_GET["golfItemAndSupplierId"];
$golfItemId = intval(strtok($passedString,"-"));
if (($pos = strpos($passedString, "-")) !== FALSE) {
    $supplierId = intval(substr($passedString, $pos+1));
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

$golfBagSearchQuery = "SELECT * FROM golfbagmodel WHERE golfItems_id='$golfItemId'";
$golfBagSearchResult = $conn->query($golfBagSearchQuery);
$userIdQuery = "SELECT email FROM usermodel WHERE id='$supplierId'";
$userIdResult = $conn->query($userIdQuery);
if (!$golfBagSearchResult) die ("Database access failed: " . $conn->error);

$userIdRow = $userIdResult->fetch_array(MYSQLI_NUM);
$golfBagIdRow = $golfBagSearchResult->fetch_array(MYSQLI_NUM);

echo "<table><tr> <th>Supplier Email</th> <th>Picture</th> <th>Description</th> <th>Daily Rate</th> </tr>";

  echo "<tr>";
  echo "<td>$userIdRow[0]</td>";
  echo "<td><image src='http://localhost/GCS/Profile/$golfBagIdRow[3]' style='width:128px;height:128px'></td>";
  for ($k = 4 ; $k < 6 ; ++$k)
  {
    echo "<td>$golfBagIdRow[$k]</td>";
  }
  echo "</tr>";

echo "</table>";
