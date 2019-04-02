<?php

$xml = simplexml_load_file("2019_cup_schedule.xml");
$raceId = "";
foreach ($xml->season[0]->event as $event) {
    foreach ($event->race as $race) {
        if ($race['number'] == "7") {
            $raceId = $race['id'];
        }
    }
}

$key = "mn4cqn7md4rn2dysmjkpgnks";
//$request = "http://api.sportradar.us/nascar-ot3/mc/races/" . $raceId . "/results.xml?api_key=" . $key;
$request = "";

$cSession = curl_init();
curl_setopt($cSession,CURLOPT_URL,$request);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
$result=curl_exec($cSession);
curl_close($cSession);

$xml2 = simplexml_load_string($result);
$isRaceOver = ($xml2['status'] == "closed") ? true : false;

$servername = "localhost";
$username = "root";
$password = "";

$con = new mysqli($servername, $username, $password);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
if (!mysqli_select_db($con, "2019_nascar_races"))  {  
    echo "Unable to locate the database";   
    exit();  
}

$race_ids = array();
$race_tracks = array();
$race_names = array();
$race_numbers = array();

$getRaces = "SELECT * FROM races";
$res = mysqli_query($con, $getRaces);

while($row = mysqli_fetch_array($res)) {
    $race_ids[] = $row["race_id"];
    $race_tracks[] = $row["track"];
    $race_names[] = $row["race_name"];
    $race_numbers[] = $row["race_number"];
}

$k = 0;
while ($k < 10) {  
    get_results_new($week_1_teams[$k], $race_ids[0], $con);
    get_results_new($week_2_teams[$k], $race_ids[1], $con);
    get_results_new($week_3_teams[$k], $race_ids[2], $con);
    get_results_new($week_4_teams[$k], $race_ids[3], $con);
    get_results_new($week_5_teams[$k], $race_ids[4], $con);
    get_results_new($week_6_teams[$k], $race_ids[5], $con);
    get_results_new($week_7_teams[$k], $race_ids[6], $con);
    /*if ($isRaceOver) {
        get_results_test($week_7_teams[$k], $result);
    }*/
    $k++;
}

get_season_points($season_drivers, "results/2019_daytona_results.xml");
get_season_points($season_drivers, "results/2019_atlanta_results.xml");
get_season_points($season_drivers, "results/2019_las_vegas_results.xml");
get_season_points($season_drivers, "results/2019_phoenix_results.xml");
get_season_points($season_drivers, "results/2019_fontana_results.xml");
get_season_points($season_drivers, "results/2019_martinsville_results.xml");
get_season_points($season_drivers, "results/2019_texas_results.xml");

?>