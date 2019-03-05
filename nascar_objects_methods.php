<?php

/* CLASSES */
class Team_Standing {

    var $name;
    var $streak;
    var $wins = 0;
    var $losses = 0;
    var $total_pts = 0;
    var $total_pts_against = 0;
    var $is_win = true;
    var $streak_num = 0;

    function __construct($name) {
        $this->name = $name;
    }

    function get_team_name() {
        return $this->name;
    }

    function get_wins() {
        return $this->wins;
    }

    function get_losses() {
        return $this->losses;
    }

    function get_total_pts() {
        return $this->total_pts;
    }

    function get_total_pts_against() {
        return $this->total_pts_against;
    }

    function get_streak() {
        return $this->streak;
    }

    function add_win() {
        $this->wins++;
        $this->streak = $this->calculate_streak("win");
        $this->is_win=true;
    }

    function add_loss() {
        $this->losses++;
        $this->streak = $this->calculate_streak("loss");
        $this->is_win = false;
    }

    function add_pts($points) {
        $this->total_pts += $points;
    }

    function add_pts_against($points) {
        $this->total_pts_against += $points;
    }

    function calculate_streak($outcome) {
        if ($this->is_win == true && $outcome == "win") {
            $this->streak_num++;
            return "W".$this->streak_num;
        } else if ($this->is_win == true && $outcome == "loss") {
            $this->streak_num = 1;
            return "L".$this->streak_num;
        } else if ($this->is_win == false && $outcome == "loss") {
            $this->streak_num++;
            return "L".$this->streak_num;
        } else if ($this->is_win == false && $outcome == "win") {
            $this->streak_num = 1;
            return "W".$this->streak_num;
        }
    }
}



class Season_Driver {

    var $name;
    var $season_pts = 0;
    var $starts = 0;

    function __construct($name) {
        $this->name = $name;
    }

    function add_season_pts($points) {
        $this->season_pts += $points;
    }

    function add_start() {
        $this->starts++;
    }
    function get_season_pts() {
        return $this->season_pts;
    }

    function get_starts() {
        return $this->starts;
    }

    function get_avg_pts() {
        return ($this->starts > 0) ? number_format((float)($this->season_pts / $this->starts), 1, '.', '') : number_format((float)0, 1, '.', '');
    }

    function get_name() {
        return $this->name;
    }
}



class Driver {

    var $name;
    var $pts = 0;
    var $wk_pts = 0;

    function __construct($name) {
        $this->name = $name;
    }

    function get_driver() {
        return $this->name;
    }

    function set_driver_points($points) {
        $this->pts = $points;
    }

    function get_driver_points() {
        return $this->pts;
    }

    // FOR PLAYOFF MATCHUPS // 
    function add_driver_points($points) {
        $this->pts += $points;
    }

    function set_weekly_result($points) {
        $this->wk_pts = $points;
    }

    function get_weekly_result() {
        return $this->wk_pts;
    }
}



class Team {

    var $drivers;
    var $points = 0;
    var $standing;
    var $fourth_driver;

    function __construct($team_name, $driver1, $driver2, $driver3, $driver4) {
        $drive1 = new Driver($driver1);
        $drive2 = new Driver($driver2);
        $drive3 = new Driver($driver3);
        $this->drivers = array($drive1, $drive2, $drive3);
        $this->standing = new Team_Standing($team_name);
        $this->fourth_driver = $driver4;
    }

    function get_driver($num) {
        $num--;
        return $this->drivers[$num]->get_driver();
    }

    function get_driver_points($num) {
        $num--;
        return $this->drivers[$num]->get_driver_points();
    }

    function get_drivers() {
        return $this->drivers;
    }

    function get_fourth_driver() {
        return $this->fourth_driver;
    }

    function set_points($pts) {
        $this->points = $pts;
    }

    function get_points() {
        return $this->points;
    }

    function get_team_standing() {
        return $this->standing;
    }

    // FOR PLAYOFF MATCHUPS //
    function add_points($pts) {
        $this->points += $pts;
    }

    function get_weekly_driver_result($num) {
        $num--;
        return $this->drivers[$num]->get_weekly_result();
    }
}



/* FUNCTIONS */
function getPoints($data) {
    $pts = 0;
    if ($data["position"] == 1) {
        $pts = 52;
    } else {
        $pts = 41 - $data["position"];
    }

    if ($data["start_position"] == 1) {
        $pts += 2;
    }

    if ($data["stage_1_win"] == true) {
        $pts += 2;
    }

    if ($data["stage_2_win"] == true) {
        $pts += 2;
    }

    if ($data["stage_3_win"] == true) {
        $pts += 2;
    }

    return $pts;
}

function check_for_bonus($name, $file) {
    // Bonus logic for when Kyle Busch punched Joey Logano's stupid face at Las Vegas //
    if ($name->get_driver() == "Kyle Busch" && $file == "las_vegas_results.xml") {
        return 1;
    } else {
        return 0;
    }
}

function season_check_for_bonus($name, $file) {
    // SEASON LONG Bonus logic for when Kyle Busch punched Joey Logano's stupid face at Las Vegas //
    if ($name->get_name() == "Kyle Busch" && $file == "las_vegas_results.xml") {
        return 1;
    } else {
        return 0;
    }
}

function get_playoff_results($team, $file) {
    $xml2 = simplexml_load_file($file);
    $points = 0;
    
    foreach ($team->get_drivers() as $driver) {
        $driver_pts = 0;
        foreach ($xml2->results->result as $result) {
            if ($driver->get_driver() == $result->driver["full_name"]) {
                $driver_pts = getPoints($result);                    
            }             
        }
        $driver_pts += check_for_bonus($driver, $file);
        $driver->add_driver_points($driver_pts);
        $driver->set_weekly_result($driver_pts);
        $points += $driver_pts;
    }
    $team->add_points($points);
}

function get_results($team, $file) {
    $xml2 = simplexml_load_file($file);
    $points = 0;
    
    foreach ($team->get_drivers() as $driver) {
        $driver_pts = 0;
        foreach ($xml2->results->result as $result) {
            if ($driver->get_driver() == $result->driver["full_name"]) {
                $driver_pts = getPoints($result);                    
            }             
        }
        $driver_pts += check_for_bonus($driver, $file);
        $driver->set_driver_points($driver_pts);
        $points += $driver_pts;
    }
    $team->set_points($points);
}

function get_season_points($drivers, $file) {
    $xml2 = simplexml_load_file($file);
    $points = 0;
    foreach ($drivers as $driver) {
        foreach ($xml2->results->result as $result) {
            if ($driver->get_name() == $result->driver["full_name"]) {
                $points = getPoints($result);
                $points += season_check_for_bonus($driver, $file);
                $driver->add_season_pts($points);
                $driver->add_start();
            }
        }
    }
}

function get_semifinal_matchups($teams, $week, $isComplete) {

    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

    // FIRST MATCHUP // 
    $k = 0;
    echo '<div class="my-scoreboard is_';
    echo $f->format($week);
    echo ($k == 0) ? ' col-lg-2 col-lg-offset-4 hidden"><div class="week' : ' col-lg-2 hidden"><div class="week';
    echo $week;
    echo ' table-responsive ';
    echo ($k == 0) ? 'scoreboard_space_first">' : 'scoreboard_space">';
    echo '<table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;"><thead><tr><th width="75%">Lineup</th><th width="25%">Points</th></tr></thead><tbody><tr><td>';
    echo $teams[0]->get_driver(1);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(1);
    echo ' ('.$teams[0]->get_weekly_driver_result(1).') </td></tr><tr><td>';
    echo $teams[0]->get_driver(2);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(2);
    echo ' ('.$teams[0]->get_weekly_driver_result(2).') </td></tr><tr><td>';
    echo $teams[0]->get_driver(3);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(3);
    echo ' ('.$teams[0]->get_weekly_driver_result(3).') </td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[0]->get_points() > $teams[1]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[0]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[0]->get_points();

    echo '</td></tr><tr><td></td><td></br></td></tr><tr><td>';

    echo $teams[1]->get_driver(1);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(1);
    echo ' ('.$teams[1]->get_weekly_driver_result(1).') </td></tr><tr><td>';
    echo $teams[1]->get_driver(2);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(2);
    echo ' ('.$teams[1]->get_weekly_driver_result(2).') </td></tr><tr><td>';
    echo $teams[1]->get_driver(3);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(3);
    echo ' ('.$teams[1]->get_weekly_driver_result(3).') </td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[0]->get_points() < $teams[1]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[1]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[1]->get_points();
    echo '</td></tr></tbody></table></div></div>';



    // SECOND MATCHUP //
    $k = 1;
    echo '<div class="my-scoreboard is_';
    echo $f->format($week);
    echo ($k == 0) ? ' col-lg-2 col-lg-offset-5 hidden"><div class="week' : ' col-lg-2 hidden"><div class="week';
    echo $week;
    echo ' table-responsive ';
    echo ($k == 0) ? 'scoreboard_space_first">' : 'scoreboard_space">';
    echo '<table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;"><thead><tr><th width="75%">Lineup</th><th width="25%">Points</th></tr></thead><tbody><tr><td>';
    echo $teams[2]->get_driver(1);
    echo '</td><td>';
    echo $teams[2]->get_driver_points(1);
    echo ' ('.$teams[2]->get_weekly_driver_result(1).') </td></tr><tr><td>';
    echo $teams[2]->get_driver(2);
    echo '</td><td>';
    echo $teams[2]->get_driver_points(2);
    echo ' ('.$teams[2]->get_weekly_driver_result(2).') </td></tr><tr><td>';
    echo $teams[2]->get_driver(3);
    echo '</td><td>';
    echo $teams[2]->get_driver_points(3);
    echo ' ('.$teams[2]->get_weekly_driver_result(3).') </td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[2]->get_points() > $teams[3]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[2]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[2]->get_points();

    echo '</td></tr><tr><td></td><td></br></td></tr><tr><td>';

    echo $teams[3]->get_driver(1);
    echo '</td><td>';
    echo $teams[3]->get_driver_points(1);
    echo ' ('.$teams[3]->get_weekly_driver_result(1).') </td></tr><tr><td>';
    echo $teams[3]->get_driver(2);
    echo '</td><td>';
    echo $teams[3]->get_driver_points(2);
    echo ' ('.$teams[3]->get_weekly_driver_result(2).') </td></tr><tr><td>';
    echo $teams[3]->get_driver(3);
    echo '</td><td>';
    echo $teams[3]->get_driver_points(3);
    echo ' ('.$teams[3]->get_weekly_driver_result(3).') </td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[2]->get_points() < $teams[3]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[3]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[3]->get_points();
    echo '</td></tr></tbody></table></div></div>';
}

function get_wildcard_matchup($teams, $week, $isComplete) {

    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

    $k = 0;
    
    echo '<div class="my-scoreboard is_';
    echo $f->format($week);
    echo ($k == 0) ? ' col-lg-2 col-lg-offset-5 hidden"><div class="week' : ' col-lg-2 hidden"><div class="week';
    echo $week;
    echo ' table-responsive ';
    echo ($k == 0) ? 'scoreboard_space_first">' : 'scoreboard_space">';
    echo '<table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;"><thead><tr><th width="80%">Lineup</th><th width="20%">Points</th></tr></thead><tbody><tr><td>';
    echo $teams[0]->get_driver(1);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(1);
    echo '</td></tr><tr><td>';
    echo $teams[0]->get_driver(2);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(2);
    echo '</td></tr><tr><td>';
    echo $teams[0]->get_driver(3);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(3);
    echo '</td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[0]->get_points() > $teams[1]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[0]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[0]->get_points();

    echo '</td></tr><tr><td></td><td></br></td></tr><tr><td>';

    echo $teams[1]->get_driver(1);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(1);
    echo '</td></tr><tr><td>';
    echo $teams[1]->get_driver(2);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(2);
    echo '</td></tr><tr><td>';
    echo $teams[1]->get_driver(3);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(3);
    echo '</td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[0]->get_points() < $teams[1]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[1]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[1]->get_points();
    echo '</td></tr></tbody></table></div></div>';   
}

function get_championship_matchup($teams, $week, $isComplete) {

    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

    $k = 0;
    
    echo '<div class="my-scoreboard is_';
    echo $f->format($week);
    echo ($k == 0) ? ' col-lg-2 col-lg-offset-5 hidden"><div class="week' : ' col-lg-2 hidden"><div class="week';
    echo $week;
    echo ' table-responsive ';
    echo ($k == 0) ? 'scoreboard_space_first">' : 'scoreboard_space">';
    echo '<table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;"><thead><tr><th width="75%">Lineup</th><th width="25%">Points</th></tr></thead><tbody><tr><td>';
    echo $teams[0]->get_driver(1);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(1);
    echo ' ('.$teams[0]->get_weekly_driver_result(1).') </td></tr><tr><td>';
    echo $teams[0]->get_driver(2);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(2);
    echo ' ('.$teams[0]->get_weekly_driver_result(2).') </td></tr><tr><td>';
    echo $teams[0]->get_driver(3);
    echo '</td><td>';
    echo $teams[0]->get_driver_points(3);
    echo ' ('.$teams[0]->get_weekly_driver_result(3).') </td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[0]->get_points() > $teams[1]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[0]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[0]->get_points();

    echo '</td></tr><tr><td></td><td></br></td></tr><tr><td>';

    echo $teams[1]->get_driver(1);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(1);
    echo ' ('.$teams[1]->get_weekly_driver_result(1).') </td></tr><tr><td>';
    echo $teams[1]->get_driver(2);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(2);
    echo ' ('.$teams[1]->get_weekly_driver_result(2).') </td></tr><tr><td>';
    echo $teams[1]->get_driver(3);
    echo '</td><td>';
    echo $teams[1]->get_driver_points(3);
    echo ' ('.$teams[1]->get_weekly_driver_result(3).') </td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

    if ($teams[0]->get_points() < $teams[1]->get_points() && $isComplete) {
        echo '<tr style="border: 4px solid #00b300;"><td>';
    } else {
        echo '<tr style="border: 4px solid white;"><td>';
    }

    echo $teams[1]->get_team_standing()->get_team_name();
    echo '</td><td>';
    echo $teams[1]->get_points();
    echo '</td></tr></tbody></table></div></div>';   
}

function get_matchups($teams, $week, $num_pairs, $team_standings) {

    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

    $k = 0;
    while ($k < 5) {
        $t1 = $num_pairs[$k][0];
        $t2 = $num_pairs[$k][1];
        echo '<div class="my-scoreboard is_';
        echo $f->format($week);
        echo ($k == 0) ? ' col-lg-2 col-lg-offset-1 hidden"><div class="week' : ' col-lg-2 hidden"><div class="week';
        echo $week;
        echo ' table-responsive ';
        echo ($k == 0) ? 'scoreboard_space_first">' : 'scoreboard_space">';
        echo '<table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;"><thead><tr><th width="80%">Lineup</th><th width="20%">Points</th></tr></thead><tbody><tr><td>';
        echo $teams[$week][$t1]->get_driver(1);
        echo '</td><td>';
        echo $teams[$week][$t1]->get_driver_points(1);
        echo '</td></tr><tr><td>';
        echo $teams[$week][$t1]->get_driver(2);
        echo '</td><td>';
        echo $teams[$week][$t1]->get_driver_points(2);
        echo '</td></tr><tr><td>';
        echo $teams[$week][$t1]->get_driver(3);
        echo '</td><td>';
        echo $teams[$week][$t1]->get_driver_points(3);
        echo '</td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

        if ($teams[$week][$t1]->get_points() > $teams[$week][$t2]->get_points()) {
            $team_standings[$t1]->get_team_standing()->add_win();
            echo '<tr style="border: 4px solid #00b300;"><td>';
        } else if ($teams[$week][$t1]->get_points() < $teams[$week][$t2]->get_points()) {
            $team_standings[$t1]->get_team_standing()->add_loss();
            echo '<tr style="border: 4px solid white;"><td>';
        } else if ($teams[$week][$t1]->get_points() != 0 && $teams[$week][$t2]->get_points() != 0) {
            if (get_tiebreaker($teams[$week][$t1], $teams[$week][$t2])) {
                $team_standings[$t1]->get_team_standing()->add_win();
                echo '<tr style="border: 4px solid #00b300;"><td>';
            } else {
                $team_standings[$t1]->get_team_standing()->add_loss();
                echo '<tr style="border: 4px solid white;"><td>';
            }
        } else {
            echo '<tr style="border: 4px solid white;"><td>';
        }

        $team_standings[$t1]->get_team_standing()->add_pts($teams[$week][$t1]->get_points());
        $team_standings[$t1]->get_team_standing()->add_pts_against($teams[$week][$t2]->get_points());

        echo $teams[$week][$t1]->get_team_standing()->get_team_name();
        echo '</td><td>';
        echo $teams[$week][$t1]->get_points();

        echo '</td></tr><tr><td></td><td></br></td></tr><tr><td>';

        echo $teams[$week][$t2]->get_driver(1);
        echo '</td><td>';
        echo $teams[$week][$t2]->get_driver_points(1);
        echo '</td></tr><tr><td>';
        echo $teams[$week][$t2]->get_driver(2);
        echo '</td><td>';
        echo $teams[$week][$t2]->get_driver_points(2);
        echo '</td></tr><tr><td>';
        echo $teams[$week][$t2]->get_driver(3);
        echo '</td><td>';
        echo $teams[$week][$t2]->get_driver_points(3);
        echo '</td></tr><tr><td></td><td style="font-size: 11px">Total</td></tr>';

        if ($teams[$week][$t1]->get_points() < $teams[$week][$t2]->get_points()) {
            $team_standings[$t2]->get_team_standing()->add_win();
            echo '<tr style="border: 4px solid #00b300;"><td>';
        } else if ($teams[$week][$t1]->get_points() > $teams[$week][$t2]->get_points()) {
            $team_standings[$t2]->get_team_standing()->add_loss();
            echo '<tr style="border: 4px solid white;"><td>';
        } else if ($teams[$week][$t1]->get_points() != 0 && $teams[$week][$t2]->get_points() != 0) {
            if (get_tiebreaker($teams[$week][$t2], $teams[$week][$t1])) {
                $team_standings[$t2]->get_team_standing()->add_win();
                echo '<tr style="border: 4px solid #00b300;"><td>';
            } else {
                $team_standings[$t2]->get_team_standing()->add_loss();
                echo '<tr style="border: 4px solid white;"><td>';
            }
        } else {
            echo '<tr style="border: 4px solid white;"><td>';
        }           
        
        $team_standings[$t2]->get_team_standing()->add_pts($teams[$week][$t2]->get_points());
        $team_standings[$t2]->get_team_standing()->add_pts_against($teams[$week][$t1]->get_points());

        echo $teams[$week][$t2]->get_team_standing()->get_team_name();
        echo '</td><td>';
        echo $teams[$week][$t2]->get_points();
        echo '</td></tr></tbody></table></div></div>';

        $k++;
    }
}

function get_tiebreaker($team1, $team2) {
    if (max($team1->get_driver_points(1),$team1->get_driver_points(2),$team1->get_driver_points(3)) > max($team2->get_driver_points(1),$team2->get_driver_points(2),$team2->get_driver_points(3))) {
        return true;
    } else {
        return false;
    }
}

function get_driver_splits($team_roster, $year) {
    $tracksplit = 'track-split';
    $xml = simplexml_load_file("2019_sprint_cup_drivers.xml");

    $i = 0;
    while ($i < 35) {
        $k = 0;
        $j = 0;
        foreach ($xml->season[0]->driver[$i]->$tracksplit->record as $record) {
            if ((string) $record['name'] == 'ISM Raceway') {
                $j = $k;
            }
            $k++;
        }

        echo "<tr>";
        echo "<td style='width: 175px;'>".$xml->season[0]->driver[$i]['full_name']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['starts']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['wins']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['avg_start_position']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['avg_finish_position']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['top_5']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['top_10']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['poles']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['dnf']."</td>";
        echo "<td>".$xml->season[0]->driver[$i]->$tracksplit->record[$j]['laps_led']."</td>";
        echo "</tr>";

        $i++;
    }
}


function sort_standings($a,$b) {
    if ($a->get_team_standing()->get_wins() == $b->get_team_standing()->get_wins()) {
        return ($a->get_team_standing()->get_total_pts() > $b->get_team_standing()->get_total_pts()) ? -1 : 1;
    } else {
        return ($a->get_team_standing()->get_wins() > $b->get_team_standing()->get_wins()) ? -1 : 1;
    }                           
}

function sort_total_fantasy_pts($a,$b) {
    if ($a->get_season_pts() == $b->get_season_pts()) {
        return 0;
    } else {
        return ($a->get_season_pts() > $b->get_season_pts()) ? -1 : 1;
    }
}


function get_team_standings($team_standings) {
    usort($team_standings, "sort_standings");

    $y = 27;
    if($_GET['year'] == '2017') {
        $y = 26;
    }

    $weeks_remaining = $y - ($team_standings[4]->get_team_standing()->get_wins() + $team_standings[4]->get_team_standing()->get_losses());
    $ppr = 135 * $weeks_remaining;

    $playoff_e_cutoff = $team_standings[4]->get_team_standing()->get_losses();
    $playoff_e_cutoff_pts = $team_standings[4]->get_team_standing()->get_total_pts();

    $playoff_w_cutoff = $team_standings[2]->get_team_standing()->get_losses();
    $playoff_w_cutoff_pts = $team_standings[2]->get_team_standing()->get_total_pts();

    $playoff_x_cutoff = $team_standings[5]->get_team_standing()->get_losses();
    $playoff_x_cutoff_pts = $team_standings[5]->get_team_standing()->get_total_pts();

    $playoff_y_cutoff = $team_standings[3]->get_team_standing()->get_losses();
    $playoff_y_cutoff_pts = $team_standings[3]->get_team_standing()->get_total_pts();
    

    $j = 0;
    while ($j < 10) {

        echo ($j == 5) ? '<tr style="border: 3px solid white"><td colspan="6" style="font-weight:lighter; text-align: center; font-size:14px; margin: 0; padding: 1px;">Playoff Cutoff</td></tr><tr><td style="border-right: 1px solid white">' : '<tr><td style="border-right: 1px solid white">';                                       

        /* PLAYOFF CLINCH / ELIMINATION LOGIC */
        if ($weeks_remaining != 0) {
           echo (($team_standings[$j]->get_team_standing()->get_losses() - $playoff_e_cutoff) > $weeks_remaining) ? "e - " : "";
            echo ($playoff_x_cutoff - $team_standings[$j]->get_team_standing()->get_losses() > $weeks_remaining) || 
                    (($playoff_x_cutoff - $team_standings[$j]->get_team_standing()->get_losses() == $weeks_remaining) && (($team_standings[$j]->get_team_standing()->get_total_pts() - $ppr) > $playoff_x_cutoff_pts )) ? 
                    (($playoff_y_cutoff - $team_standings[$j]->get_team_standing()->get_losses() > $weeks_remaining) ||
                        (($playoff_y_cutoff - $team_standings[$j]->get_team_standing()->get_losses() == $weeks_remaining) && (($team_standings[$j]->get_team_standing()->get_total_pts() - $ppr) > $playoff_y_cutoff_pts )) ? 
                        "y - " : ((($team_standings[$j]->get_team_standing()->get_losses() - $playoff_w_cutoff) > $weeks_remaining) ||
                            ((($team_standings[$j]->get_team_standing()->get_losses() - $playoff_w_cutoff) == $weeks_remaining) && (($team_standings[$j]->get_team_standing()->get_total_pts() + $ppr) < $playoff_w_cutoff_pts )) ? 
                            "w - " : "x - ")) : ""; 
        } else if ($j < 3) {
            echo "y - ";
        } else if ($j < 5) {
            echo "w - ";
        } else {
            echo "e - ";
        }
        
        
        echo $team_standings[$j]->get_team_standing()->get_team_name();
        echo '</td><td style="border-right: 1px solid white">';
        echo $team_standings[$j]->get_team_standing()->get_wins();
        echo '</td><td style="border-right: 1px solid white">';
        echo $team_standings[$j]->get_team_standing()->get_losses();
        echo '</td><td style="border-right: 1px solid white">';
        echo $team_standings[$j]->get_team_standing()->get_total_pts();
        echo '</td><td style="border-right: 1px solid white">';
        echo $team_standings[$j]->get_team_standing()->get_streak();
        echo '</td><td style="border-right: 1px solid white">';
        echo $team_standings[$j]->get_team_standing()->get_total_pts_against();
        echo '</td></tr>';

        $j++;
        
        echo ($j == 10) ? '<tr style="border: 3px solid white"><td colspan="6" style="font-weight:lighter; font-size: 12px"> e -- Mathematically Eliminated From Playoffs</br>w -- Clinched Wild Card Berth</br>x -- Clinched Playoff Berth</br>y -- Clinched Top 3 Seed</td></tr>' : '';
    }
}


function get_driver_standings($season_drivers, $year) {
    usort($season_drivers, "sort_total_fantasy_pts");

    $driver_rank;
    $temp_pts = 0;
    $i = 0;
    $break = 0;
    $tied = false;
    $total_drivers = 0;
    if ($year == '2019') {
        $total_drivers = 43;
    } else if ($year == '2018') {
        $total_drivers = 47;
    } else if ($year == '2017') {
        $total_drivers = 48;
    }

    while ($i < $total_drivers) {
        $next = ($i < $total_drivers - 1) ? $i + 1 : $i + 0;
        if ($season_drivers[$i]->get_season_pts() == $season_drivers[$next]->get_season_pts()) {
            $tied = true;
        } else {
            $tied = false;
        }

        $rank = $i + 1;
        if ($season_drivers[$i]->get_season_pts() == $temp_pts) {
            $break++;
            $rank -= $break;
            $tied = true;
        } else {
            $break = 0;
        }

        if ($rank == 46) {
            $tied = false;
        }

        echo '<tr><td style="border-right: 1px solid white">';
        echo ($tied) ? 'T-'.$rank : $rank;
        echo '</td><td style="border-right: 1px solid white">';
        echo $season_drivers[$i]->get_name();
        echo '</td><td style="border-right: 1px solid white">';
        echo $season_drivers[$i]->get_season_pts();
        echo '</td><td style="border-right: 1px solid white">';
        echo $season_drivers[$i]->get_avg_pts();
        echo '</td><td>';
        echo $season_drivers[$i]->get_starts();
        echo '</td></tr>';

        if ($i == 0) {
            $driver_rank = array($season_drivers[$i]->get_name() => $rank);
        } else {
            $driver_rank = array_merge($driver_rank, array($season_drivers[$i]->get_name() => $rank));
        }
        

        $temp_pts = $season_drivers[$i]->get_season_pts();
        $i++;
    }
    return $driver_rank;
}


function get_team_rosters($num, $range, $team_roster, $driver_rank, $is_last) {
    for ($i = $num; $i < $range; $i++) {
        if ($is_last) {
            echo ($i == 8) ? '<div class="col-lg-3 col-lg-offset-3"><h2 style="color: white; text-align: center;">' : '<div class="col-lg-3"><h2 style="color: white; text-align: center;">';
        } else {
            echo '<div class="col-lg-3"><h2 style="color: white; text-align: center;">';
        }
        echo $team_roster[$i]->get_team_standing()->get_team_name();
        echo '</h2><div class="table-responsive"><table class="table" style="color: #fff; border: 3px solid #fff; background-color: #194775;">';
        echo '<thead><tr><th width="70%" style="border-right:1px solid white;background-color:#393e44;">Starting Drivers</th><th width="30%" style="background-color:#393e44;">Pts Rank</th></tr></thead><tbody><tr><td style="border-right:1px solid white;">';
        echo $team_roster[$i]->get_driver(1);
        echo '</td><td>';
        echo (array_key_exists($team_roster[$i]->get_driver(1), $driver_rank)) ? $driver_rank[$team_roster[$i]->get_driver(1)] : 'N/A';
        echo '</td></tr><tr><td style="border-right: 1px solid white;">';
        echo $team_roster[$i]->get_driver(2);
        echo '</td><td>';
        echo (array_key_exists($team_roster[$i]->get_driver(2), $driver_rank)) ? $driver_rank[$team_roster[$i]->get_driver(2)] : 'N/A';
        echo '</td></tr><tr><td style="border-right: 1px solid white;">';
        echo $team_roster[$i]->get_driver(3);
        echo '</td><td>';
        echo (array_key_exists($team_roster[$i]->get_driver(3), $driver_rank)) ? $driver_rank[$team_roster[$i]->get_driver(3)] : 'N/A';
        echo '</td></tr><tr><td style="border:3px solid white; border-right:none;background-color:#393e44;">Bench Driver</td><td style="border:3px solid white; border-left: none;background-color:#393e44;"></td></tr><tr><td style="border-right:1px solid white;">';
        echo $team_roster[$i]->get_fourth_driver();
        echo '</td><td>';
        echo (array_key_exists($team_roster[$i]->get_fourth_driver(), $driver_rank)) ? $driver_rank[$team_roster[$i]->get_fourth_driver()] : 'N/A';
        echo '</td></tr></tbody></table></div></div>';
    }
}




/* SCHEDULE DETERMINATION */
$pair1 = array(0,1);
$pair2 = array(2,3);
$pair3 = array(4,5);
$pair4 = array(6,7);
$pair5 = array(8,9);
$wk1_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(7,3);
$pair2 = array(6,9);
$pair3 = array(4,8);
$pair4 = array(1,5);
$pair5 = array(0,2);
$wk2_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(8,1);
$pair2 = array(0,7);
$pair3 = array(5,2);
$pair4 = array(6,3);
$pair5 = array(9,4);
$wk3_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(7,5);
$pair2 = array(6,0);
$pair3 = array(3,9);
$pair4 = array(2,8);
$pair5 = array(1,4);
$wk4_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(9,1);
$pair2 = array(5,6);
$pair3 = array(0,3);
$pair4 = array(4,2);
$pair5 = array(8,7);
$wk5_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(0,9);
$pair2 = array(6,8);
$pair3 = array(7,4);
$pair4 = array(2,1);
$pair5 = array(3,5);
$wk6_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(1,7);
$pair2 = array(8,3);
$pair3 = array(4,6);
$pair4 = array(9,2);
$pair5 = array(5,0);
$wk7_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(0,8);
$pair2 = array(7,2);
$pair3 = array(3,4);
$pair4 = array(6,1);
$pair5 = array(5,9);
$wk8_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$pair1 = array(2,6);
$pair2 = array(8,5);
$pair3 = array(4,0);
$pair4 = array(9,7);
$pair5 = array(1,3);
$wk9_pairs = array($pair1,$pair2,$pair3,$pair4,$pair5);

$num_pairs = array($wk1_pairs,$wk2_pairs,$wk3_pairs,$wk4_pairs,$wk5_pairs,$wk6_pairs,$wk7_pairs,$wk8_pairs,$wk9_pairs);

?>