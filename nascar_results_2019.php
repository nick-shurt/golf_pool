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
$request = "http://api.sportradar.us/nascar-ot3/mc/races/" . $raceId . "/results.xml?api_key=" . $key;

$cSession = curl_init();
curl_setopt($cSession,CURLOPT_URL,$request);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
$result=curl_exec($cSession);
curl_close($cSession);

$xml2 = simplexml_load_string($result);
$isRaceOver = ($xml2['status'] == "closed") ? true : false;

$k = 0;
while ($k < 10) {  
    get_results($week_1_teams[$k], "results/2019_daytona_results.xml");
    get_results($week_2_teams[$k], "results/2019_atlanta_results.xml");
    get_results($week_3_teams[$k], "results/2019_las_vegas_results.xml");
    get_results($week_4_teams[$k], "results/2019_phoenix_results.xml");
    get_results($week_5_teams[$k], "results/2019_fontana_results.xml");
    get_results($week_6_teams[$k], "results/2019_martinsville_results.xml");
    if ($isRaceOver) {
        get_results_test($week_7_teams[$k], $result);
    }
    $k++;
}

get_season_points($season_drivers, "results/2019_daytona_results.xml");
get_season_points($season_drivers, "results/2019_atlanta_results.xml");
get_season_points($season_drivers, "results/2019_las_vegas_results.xml");
get_season_points($season_drivers, "results/2019_phoenix_results.xml");
get_season_points($season_drivers, "results/2019_fontana_results.xml");
get_season_points($season_drivers, "results/2019_martinsville_results.xml");

?>