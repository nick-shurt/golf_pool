<?php

$servername = "localhost";
$username = "root";
$password = "";

$con = new mysqli($servername, $username, $password);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
if (!mysqli_select_db($con, "golf_pool"))  {  
    echo "Unable to locate the database";   
    exit();  
}

$getTier1Golfers = "SELECT name FROM golfers WHERE tier = 1";
$res = mysqli_query($con, $getTier1Golfers);
$tier1_golfers = array();

while($row = mysqli_fetch_array($res)) {
    $tier1_golfers[] = $row["name"];
}

$getTier2Golfers = "SELECT name FROM golfers WHERE tier = 2";
$res = mysqli_query($con, $getTier2Golfers);
$tier2_golfers = array();

while($row = mysqli_fetch_array($res)) {
    $tier2_golfers[] = $row["name"];
}

$getTier3Golfers = "SELECT name FROM golfers WHERE tier = 3";
$res = mysqli_query($con, $getTier3Golfers);
$tier3_golfers = array();

while($row = mysqli_fetch_array($res)) {
    $tier3_golfers[] = $row["name"];
}

$getTier4Golfers = "SELECT name FROM golfers WHERE tier = 4";
$res = mysqli_query($con, $getTier4Golfers);
$tier4_golfers = array();

while($row = mysqli_fetch_array($res)) {
    $tier4_golfers[] = $row["name"];
}

?>