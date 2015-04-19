<?php

	if (empty($_POST["emailAddress"])) {
		$emailERR = "Email Address is required.";
    echo $emailERR;
	}
	else {
		$emailAdd = test_input($_POST["emailAddress"]);
		// check if e-mail address is well-formed
    if (!filter_var($emailAdd, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      echo $emailERR;
    }
	}

  if (empty($_POST["password"])) {
  	$pwERR = "Password is required";
    echo $pwERR;
  }
  else {
  	$pw = test_input($_POST["password"]);
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


$passwordVerificationResult = mysqli_query($conn, "SELECT * FROM usermodel WHERE email='$emailAdd' AND password='$pw'");
while($row = mysqli_fetch_array($passwordVerificationResult)) {
      $customerId = $row[0];
      $firstName = $row[1];
      $lastName = $row[2];
      $emailAddress = $row[3];
      $success = true;
    }
    if($success == true) {
      session_start();
      $_SESSION['customerId'] = $customerId;
      $_SESSION['firstName'] = $firstName;
      $_SESSION['lastName'] = $lastName;
      $_SESSION['emailAddress'] = $emailAddress;

     header('Location: http://localhost/GCS/Profile/Profile.html');
    }
    else {
      echo '<div class="alert alert-danger">Oops! It looks like your username and/or password are incorrect. Please try again.</div>';
    }
