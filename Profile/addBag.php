<?php
session_start();
$customerId = $_SESSION['customerId'];
$addressId = $_SESSION['addressId'];
echo $customerId;
echo $addressId;

$target_dir = "bagPics/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

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

$insertGolfBagIntoGolfBagModel = "INSERT INTO golfbagmodel (address_id, pictureReference, description, dailyRate, availability) VALUES ('$addressId','$target_file','$description','$dailyRate','TRUE')";

if ($conn->query($insertGolfBagIntoGolfBagModel) === TRUE) {
    echo "New bag record created.";
    	$lastBagId =  $conn->insert_id;
    	echo $lastBagId;

    	$updateUserModelForBag = "UPDATE usermodel SET golfItems_id='$conn->insert_id' WHERE id='$customerId'";
    	if ($conn->query($updateUserModelForBag) === TRUE) {
    		echo "golfItems_id added into user model";
    	}
    	else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
    	}

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
