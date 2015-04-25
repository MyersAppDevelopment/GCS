<?php
session_start();
$passedString = $_GET["golfItemAndSupplierId"];
$golfItemId = intval(strtok($passedString,"-"));
$_SESSION['golfItemId'] = $golfItemId;
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


echo <<<EOL
<table><tr> <th>Supplier Email</th> <th>Picture</th> <th>Description</th> <th>Daily Rate</th> <th>Date</th> <th>Reserve</th> </tr>

  <tr>
  <td>$userIdRow[0]</td>
  <td><image src='http://localhost/GCS/Profile/$golfBagIdRow[3]' style='width:128px;height:128px'></td>

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

EOL;

  for ($k = 4 ; $k < 6 ; ++$k)
  {
    echo "<td>$golfBagIdRow[$k]</td>";
  }
  echo "<form role='form' action='reserve.php' method='POST'>";
  echo "<td><input type='text' id='datepicker' name='reserveDate' placeholder='Enter Date MM/DD/YYYY'></td>";
  echo "<td><button type='submit' class='btn btn-default'>Reserve</button></td>";
  echo "</form>";
  echo "</tr>";

echo "</table>";

