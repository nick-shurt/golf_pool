<?php

$k = 0;
while ($k < 10) {
    
    get_results($week_1_teams[$k], "daytona500_results.xml");
    get_results($week_2_teams[$k], "atlanta_results.xml");
    get_results($week_3_teams[$k], "las_vegas_results.xml");
    get_results($week_4_teams[$k], "phoenix_results.xml");
    get_results($week_5_teams[$k], "fontana_results.xml");
    get_results($week_6_teams[$k], "martinsville_results.xml");
    get_results($week_7_teams[$k], "texas_results.xml");
    get_results($week_8_teams[$k], "bristol_results.xml");
    get_results($week_9_teams[$k], "richmond_results.xml");
    get_results($week_10_teams[$k], "talladega_results.xml");
    get_results($week_11_teams[$k], "kansas_results.xml");
    get_results($week_12_teams[$k], "charlotte_results.xml");
    get_results($week_13_teams[$k], "dover_results.xml");
    get_results($week_14_teams[$k], "pocono_results.xml");
    get_results($week_15_teams[$k], "michigan_results.xml");
    get_results($week_16_teams[$k], "sonoma_results.xml");
    get_results($week_17_teams[$k], "daytona2_results.xml");
    get_results($week_18_teams[$k], "kentucky_results.xml");
    get_results($week_19_teams[$k], "new_hampshire_results.xml");
    get_results($week_20_teams[$k], "indianapolis_results.xml");
    get_results($week_21_teams[$k], "pocono2_results.xml");
    get_results($week_22_teams[$k], "watkins_glen_results.xml");
    get_results($week_23_teams[$k], "michigan2_results.xml");
    get_results($week_24_teams[$k], "bristol2_results.xml");
    get_results($week_25_teams[$k], "darlington_results.xml");
    get_results($week_26_teams[$k], "richmond2_results.xml");
    $k++;
}

get_season_points($season_drivers, "daytona500_results.xml");
get_season_points($season_drivers, "atlanta_results.xml");
get_season_points($season_drivers, "las_vegas_results.xml");
get_season_points($season_drivers, "phoenix_results.xml");
get_season_points($season_drivers, "fontana_results.xml");
get_season_points($season_drivers, "martinsville_results.xml");
get_season_points($season_drivers, "texas_results.xml");
get_season_points($season_drivers, "bristol_results.xml");
get_season_points($season_drivers, "richmond_results.xml");
get_season_points($season_drivers, "talladega_results.xml");
get_season_points($season_drivers, "kansas_results.xml");
get_season_points($season_drivers, "charlotte_results.xml");
get_season_points($season_drivers, "dover_results.xml");
get_season_points($season_drivers, "pocono_results.xml");
get_season_points($season_drivers, "michigan_results.xml");
get_season_points($season_drivers, "sonoma_results.xml");
get_season_points($season_drivers, "daytona2_results.xml");
get_season_points($season_drivers, "kentucky_results.xml");
get_season_points($season_drivers, "new_hampshire_results.xml");
get_season_points($season_drivers, "indianapolis_results.xml");
get_season_points($season_drivers, "pocono2_results.xml");
get_season_points($season_drivers, "watkins_glen_results.xml");
get_season_points($season_drivers, "michigan2_results.xml");
get_season_points($season_drivers, "bristol2_results.xml");
get_season_points($season_drivers, "darlington_results.xml");
get_season_points($season_drivers, "richmond2_results.xml");


/* ::::::: PLAYOFFS :::::::: */

// WILD CARD ROUND //
get_results($wildcard_teams[0], "chicago_results.xml");
get_results($wildcard_teams[1], "chicago_results.xml");

// SEMIFINAL ROUND //
get_playoff_results($semifinal_teams[0], "new_hampshire2_results.xml");
get_playoff_results($semifinal_teams[1], "new_hampshire2_results.xml");
get_playoff_results($semifinal_teams[2], "new_hampshire2_results.xml");
get_playoff_results($semifinal_teams[3], "new_hampshire2_results.xml");

get_playoff_results($semifinal_teams[0], "dover2_results.xml");
get_playoff_results($semifinal_teams[1], "dover2_results.xml");
get_playoff_results($semifinal_teams[2], "dover2_results.xml");
get_playoff_results($semifinal_teams[3], "dover2_results.xml");

get_playoff_results($semifinal_teams[0], "charlotte2_results.xml");
get_playoff_results($semifinal_teams[1], "charlotte2_results.xml");
get_playoff_results($semifinal_teams[2], "charlotte2_results.xml");
get_playoff_results($semifinal_teams[3], "charlotte2_results.xml");

get_playoff_results($semifinal_teams[0], "talladega2_results.xml");
get_playoff_results($semifinal_teams[1], "talladega2_results.xml");
get_playoff_results($semifinal_teams[2], "talladega2_results.xml");
get_playoff_results($semifinal_teams[3], "talladega2_results.xml");

// CHAMPIONSHIP //
get_playoff_results($championship_teams[0], "kansas2_results.xml");
get_playoff_results($championship_teams[1], "kansas2_results.xml");

get_playoff_results($championship_teams[0], "martinsville2_results.xml");
get_playoff_results($championship_teams[1], "martinsville2_results.xml");

get_playoff_results($championship_teams[0], "texas2_results.xml");
get_playoff_results($championship_teams[1], "texas2_results.xml");

get_playoff_results($championship_teams[0], "phoenix2_results.xml");
get_playoff_results($championship_teams[1], "phoenix2_results.xml");

get_playoff_results($championship_teams[0], "miami_results.xml");
get_playoff_results($championship_teams[1], "miami_results.xml");

?>