<?php
$passedString = $_GET["golfItemAndSupplierId"];
echo $passedString;

echo "<br>";
$golfItemId = intval(strtok($passedString,"-"));
echo $golfItemId;
echo "<br>";
if (($pos = strpos($passedString, "-")) !== FALSE) {
    $supplierId = intval(substr($passedString, $pos+1));
    echo $supplierId;
}

