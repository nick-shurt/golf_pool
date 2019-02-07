<?php

$k = 0;
while ($k < 10) {  
    get_results($week_1_teams[$k], "results/2018_daytona_results.xml");
    get_results($week_2_teams[$k], "results/2018_atlanta_results.xml");
    get_results($week_3_teams[$k], "results/2018_las_vegas_results.xml");
    get_results($week_4_teams[$k], "results/2018_phoenix_results.xml");
    get_results($week_5_teams[$k], "results/2018_fontana_results.xml");
    get_results($week_6_teams[$k], "results/2018_martinsville_results.xml");
    get_results($week_7_teams[$k], "results/2018_texas_results.xml");
    get_results($week_8_teams[$k], "results/2018_bristol_results.xml");
    get_results($week_9_teams[$k], "results/2018_richmond_results.xml");
    get_results($week_10_teams[$k], "results/2018_talladega_results.xml");
    get_results($week_11_teams[$k], "results/2018_dover_results.xml");
    get_results($week_12_teams[$k], "results/2018_kansas_results.xml");
    get_results($week_13_teams[$k], "results/2018_charlotte_results.xml");
    get_results($week_14_teams[$k], "results/2018_pocono_results.xml");
    get_results($week_15_teams[$k], "results/2018_michigan_results.xml");
    get_results($week_16_teams[$k], "results/2018_sonoma_results.xml");
    get_results($week_17_teams[$k], "results/2018_chicago_results.xml");
    get_results($week_18_teams[$k], "results/2018_daytona2_results.xml");
    get_results($week_19_teams[$k], "results/2018_kentucky_results.xml");
    get_results($week_20_teams[$k], "results/2018_new_hampshire_results.xml");
    get_results($week_21_teams[$k], "results/2018_pocono2_results.xml");
    get_results($week_22_teams[$k], "results/2018_watkins_glen_results.xml");
    get_results($week_23_teams[$k], "results/2018_michigan2_results.xml");
    get_results($week_24_teams[$k], "results/2018_bristol2_results.xml");
    get_results($week_25_teams[$k], "results/2018_darlington_results.xml");
    get_results($week_26_teams[$k], "results/2018_indianapolis_results.xml");
    get_results($week_27_teams[$k], "results/2018_las_vegas2_results.xml");
    $k++;
}

get_season_points($season_drivers, "results/2018_daytona_results.xml");
get_season_points($season_drivers, "results/2018_atlanta_results.xml");
get_season_points($season_drivers, "results/2018_las_vegas_results.xml");
get_season_points($season_drivers, "results/2018_phoenix_results.xml");
get_season_points($season_drivers, "results/2018_fontana_results.xml");
get_season_points($season_drivers, "results/2018_martinsville_results.xml");
get_season_points($season_drivers, "results/2018_texas_results.xml");
get_season_points($season_drivers, "results/2018_bristol_results.xml");
get_season_points($season_drivers, "results/2018_richmond_results.xml");
get_season_points($season_drivers, "results/2018_talladega_results.xml");
get_season_points($season_drivers, "results/2018_dover_results.xml");
get_season_points($season_drivers, "results/2018_kansas_results.xml");
get_season_points($season_drivers, "results/2018_charlotte_results.xml");
get_season_points($season_drivers, "results/2018_pocono_results.xml");
get_season_points($season_drivers, "results/2018_michigan_results.xml");
get_season_points($season_drivers, "results/2018_sonoma_results.xml");
get_season_points($season_drivers, "results/2018_chicago_results.xml");
get_season_points($season_drivers, "results/2018_daytona2_results.xml");
get_season_points($season_drivers, "results/2018_kentucky_results.xml");
get_season_points($season_drivers, "results/2018_new_hampshire_results.xml");
get_season_points($season_drivers, "results/2018_pocono2_results.xml");
get_season_points($season_drivers, "results/2018_watkins_glen_results.xml");
get_season_points($season_drivers, "results/2018_michigan2_results.xml");
get_season_points($season_drivers, "results/2018_bristol2_results.xml");
get_season_points($season_drivers, "results/2018_darlington_results.xml");
get_season_points($season_drivers, "results/2018_indianapolis_results.xml");
get_season_points($season_drivers, "results/2018_las_vegas2_results.xml");


/* ::::::: PLAYOFFS :::::::: */

// WILD CARD ROUND //
get_results($wildcard_teams[0], "results/2018_richmond2_results.xml");
get_results($wildcard_teams[1], "results/2018_richmond2_results.xml");

// SEMIFINAL ROUND //
get_playoff_results($semifinal_teams[0], "results/2018_charlotte2_results.xml");
get_playoff_results($semifinal_teams[1], "results/2018_charlotte2_results.xml");
get_playoff_results($semifinal_teams[2], "results/2018_charlotte2_results.xml");
get_playoff_results($semifinal_teams[3], "results/2018_charlotte2_results.xml");

get_playoff_results($semifinal_teams[0], "results/2018_dover2_results.xml");
get_playoff_results($semifinal_teams[1], "results/2018_dover2_results.xml");
get_playoff_results($semifinal_teams[2], "results/2018_dover2_results.xml");
get_playoff_results($semifinal_teams[3], "results/2018_dover2_results.xml");

get_playoff_results($semifinal_teams[0], "results/2018_talladega2_results.xml");
get_playoff_results($semifinal_teams[1], "results/2018_talladega2_results.xml");
get_playoff_results($semifinal_teams[2], "results/2018_talladega2_results.xml");
get_playoff_results($semifinal_teams[3], "results/2018_talladega2_results.xml");

get_playoff_results($semifinal_teams[0], "results/2018_kansas2_results.xml");
get_playoff_results($semifinal_teams[1], "results/2018_kansas2_results.xml");
get_playoff_results($semifinal_teams[2], "results/2018_kansas2_results.xml");
get_playoff_results($semifinal_teams[3], "results/2018_kansas2_results.xml");

?>