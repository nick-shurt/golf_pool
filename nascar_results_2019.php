<?php

$k = 0;
while ($k < 10) {  
    get_results($week_1_teams[$k], "results/2019_daytona_results.xml");
    $k++;
}

get_season_points($season_drivers, "results/2019_daytona_results.xml");

?>