<?php

$k = 0;
while ($k < 10) {
    
    get_results($week_1_teams[$k], "results/daytona500_results.xml");
    get_results($week_2_teams[$k], "results/atlanta_results.xml");
    get_results($week_3_teams[$k], "results/las_vegas_results.xml");
    get_results($week_4_teams[$k], "results/phoenix_results.xml");
    get_results($week_5_teams[$k], "results/fontana_results.xml");
    get_results($week_6_teams[$k], "results/martinsville_results.xml");
    get_results($week_7_teams[$k], "results/texas_results.xml");
    get_results($week_8_teams[$k], "results/bristol_results.xml");
    get_results($week_9_teams[$k], "results/richmond_results.xml");
    get_results($week_10_teams[$k], "results/talladega_results.xml");
    get_results($week_11_teams[$k], "results/kansas_results.xml");
    get_results($week_12_teams[$k], "results/charlotte_results.xml");
    get_results($week_13_teams[$k], "results/dover_results.xml");
    get_results($week_14_teams[$k], "results/pocono_results.xml");
    get_results($week_15_teams[$k], "results/michigan_results.xml");
    get_results($week_16_teams[$k], "results/sonoma_results.xml");
    get_results($week_17_teams[$k], "results/daytona2_results.xml");
    get_results($week_18_teams[$k], "results/kentucky_results.xml");
    get_results($week_19_teams[$k], "results/new_hampshire_results.xml");
    get_results($week_20_teams[$k], "results/indianapolis_results.xml");
    get_results($week_21_teams[$k], "results/pocono2_results.xml");
    get_results($week_22_teams[$k], "results/watkins_glen_results.xml");
    get_results($week_23_teams[$k], "results/michigan2_results.xml");
    get_results($week_24_teams[$k], "results/bristol2_results.xml");
    get_results($week_25_teams[$k], "results/darlington_results.xml");
    get_results($week_26_teams[$k], "results/richmond2_results.xml");
    $k++;
}

get_season_points($season_drivers, "results/daytona500_results.xml");
get_season_points($season_drivers, "results/atlanta_results.xml");
get_season_points($season_drivers, "results/las_vegas_results.xml");
get_season_points($season_drivers, "results/phoenix_results.xml");
get_season_points($season_drivers, "results/fontana_results.xml");
get_season_points($season_drivers, "results/martinsville_results.xml");
get_season_points($season_drivers, "results/texas_results.xml");
get_season_points($season_drivers, "results/bristol_results.xml");
get_season_points($season_drivers, "results/richmond_results.xml");
get_season_points($season_drivers, "results/talladega_results.xml");
get_season_points($season_drivers, "results/kansas_results.xml");
get_season_points($season_drivers, "results/charlotte_results.xml");
get_season_points($season_drivers, "results/dover_results.xml");
get_season_points($season_drivers, "results/pocono_results.xml");
get_season_points($season_drivers, "results/michigan_results.xml");
get_season_points($season_drivers, "results/sonoma_results.xml");
get_season_points($season_drivers, "results/daytona2_results.xml");
get_season_points($season_drivers, "results/kentucky_results.xml");
get_season_points($season_drivers, "results/new_hampshire_results.xml");
get_season_points($season_drivers, "results/indianapolis_results.xml");
get_season_points($season_drivers, "results/pocono2_results.xml");
get_season_points($season_drivers, "results/watkins_glen_results.xml");
get_season_points($season_drivers, "results/michigan2_results.xml");
get_season_points($season_drivers, "results/bristol2_results.xml");
get_season_points($season_drivers, "results/darlington_results.xml");
get_season_points($season_drivers, "results/richmond2_results.xml");


/* ::::::: PLAYOFFS :::::::: */

// WILD CARD ROUND //
get_results($wildcard_teams[0], "results/chicago_results.xml");
get_results($wildcard_teams[1], "results/chicago_results.xml");

// SEMIFINAL ROUND //
get_playoff_results($semifinal_teams[0], "results/new_hampshire2_results.xml");
get_playoff_results($semifinal_teams[1], "results/new_hampshire2_results.xml");
get_playoff_results($semifinal_teams[2], "results/new_hampshire2_results.xml");
get_playoff_results($semifinal_teams[3], "results/new_hampshire2_results.xml");

get_playoff_results($semifinal_teams[0], "results/dover2_results.xml");
get_playoff_results($semifinal_teams[1], "results/dover2_results.xml");
get_playoff_results($semifinal_teams[2], "results/dover2_results.xml");
get_playoff_results($semifinal_teams[3], "results/dover2_results.xml");

get_playoff_results($semifinal_teams[0], "results/charlotte2_results.xml");
get_playoff_results($semifinal_teams[1], "results/charlotte2_results.xml");
get_playoff_results($semifinal_teams[2], "results/charlotte2_results.xml");
get_playoff_results($semifinal_teams[3], "results/charlotte2_results.xml");

get_playoff_results($semifinal_teams[0], "results/talladega2_results.xml");
get_playoff_results($semifinal_teams[1], "results/talladega2_results.xml");
get_playoff_results($semifinal_teams[2], "results/talladega2_results.xml");
get_playoff_results($semifinal_teams[3], "results/talladega2_results.xml");

// CHAMPIONSHIP //
get_playoff_results($championship_teams[0], "results/kansas2_results.xml");
get_playoff_results($championship_teams[1], "results/kansas2_results.xml");

get_playoff_results($championship_teams[0], "results/martinsville2_results.xml");
get_playoff_results($championship_teams[1], "results/martinsville2_results.xml");

get_playoff_results($championship_teams[0], "results/texas2_results.xml");
get_playoff_results($championship_teams[1], "results/texas2_results.xml");

get_playoff_results($championship_teams[0], "results/phoenix2_results.xml");
get_playoff_results($championship_teams[1], "results/phoenix2_results.xml");

get_playoff_results($championship_teams[0], "results/miami_results.xml");
get_playoff_results($championship_teams[1], "results/miami_results.xml");

?>