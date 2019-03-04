<?php

$k = 0;
while ($k < 10) {  
    get_results($week_1_teams[$k], "results/2019_daytona_results.xml");
    get_results($week_2_teams[$k], "results/2019_atlanta_results.xml");
    get_results($week_3_teams[$k], "results/2019_las_vegas_results.xml");
    $k++;
}

get_season_points($season_drivers, "results/2019_daytona_results.xml");
get_season_points($season_drivers, "results/2019_atlanta_results.xml");
get_season_points($season_drivers, "results/2019_las_vegas_results.xml");


?>