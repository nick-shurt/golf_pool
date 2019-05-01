<?php

$name = (!empty($_POST['name'])) ? $_POST['name'] : "";
$email = (!empty($_POST['email'])) ? $_POST['email'] : "";
$tier1 = (!empty($_POST['tier1'])) ? $_POST['tier1'] : "-- Choose One --";
$tier2 = (!empty($_POST['tier2'])) ? $_POST['tier2'] : "-- Choose One --";
$tier3 = (!empty($_POST['tier3'])) ? $_POST['tier3'] : "-- Choose One --";
$tier4 = (!empty($_POST['tier4'])) ? $_POST['tier4'] : "-- Choose One --";
$score = (!empty($_POST['score'])) ? $_POST['score'] : "";

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

$req = "https://statdata.pgatour.com/r/current/message.json";

$cSession = curl_init();
curl_setopt($cSession,CURLOPT_URL,$req);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
$rez=curl_exec($cSession);
curl_close($cSession);

$rez_obj = json_decode($rez);
$current_id = $rez_obj->tid;

$entrants = array();
$emails = array();

$getEntries = "SELECT * FROM entries WHERE event_id = '".$current_id."'";
$res = mysqli_query($con, $getEntries);
$rowCount = mysqli_num_rows($res);

while($row = mysqli_fetch_array($res)) {
    $entrants[] = $row["name"];
    $emails[] = $row["email"];
}

?>