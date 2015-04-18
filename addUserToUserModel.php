<?php
//define variables and set to empty values
$fName = $lName = $emailAdd = $pw = $cpw = "";
$fnameERR = $lnameERR = $emailERR = $pwERR = $cpwERR = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstName"])) {
		$fnameERR = "First Name is required.";
    echo $fnameERR;
	}
	else {
		$fName = test_input($_POST["firstName"]);
		  // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
      $fnameErr = "Only letters and white space allowed";
      echo $fnameERR;
    }
	}

	if (empty($_POST["lastName"])) {
		$lnameERR = "Last Name is required.";
    echo $lnameERR;
	}
	else {
		$lName = test_input($_POST["lastName"]);
		 if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
      $lnameErr = "Only letters and white space allowed";
      echo $lnameERR;
    }
	}

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

  if (empty($_POST["confirmPassword"])) {
  	$cpwERR = "Confirm password required";
    echo $cpwERR;
  }
  else {
  	$cpw = test_input($_POST["confirmPassword"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$servername = "localhost";
$username = "admin";
$password = "Smiggy77";
$dbname = "golfclubsharingtestdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO usermodel (
fname,
lname,
email,
password)

VALUES ('$fName', '$lName', '$emailAdd', '$pw')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
