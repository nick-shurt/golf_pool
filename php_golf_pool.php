<?php
include 'db_credentials.php';

class Golfer {
    var $name;
    var $score;
    var $today;
    var $thru;
    var $status;
    var $place;
    var $isWorst = false;

    function __construct($name, $score, $today, $thru, $status, $place) {
        $this->name = $name;
        $this->score = $score;
        $this->today = $today;
        $this->thru = $thru;
        $this->status = $status;
        $this->place = $place;
    }

    function get_golfer_name() {
        return $this->name;
    }

    function get_golfer_score() {
        $score = $this->score;
        if ($this->status == "wd") {
            $score = 50;
        }
        if ($this->status == "cut") {
            $score += 20;
        }
        return $score;
    }

    function get_golfer_place() {
        $place = $this->place;
        $tied = false;
        if ($place[0] == "T") {
            $place = substr($place, 1);
            $tied = true;
        }
        $temp = $place;
        if ((int)$place > 9) {           
            $place = substr($place, 1);
        }
        if ($place[0] == "1" && $temp != "11") {
            $temp .= "st";
        } else if ($place[0] == "2" && $temp != "12") {
            $temp .= "nd";
        } else if ($place[0] == "3" && $temp != "13") {
            $temp .= "rd";
        } else {
            $temp .= "th";
        }

        if ($tied) {
            $temp = "T-" . $temp;
        }

        return $temp;
    }

    function get_golfer_thru() {
        $thru = "";
        if ($this->status == "cut") {
            $thru = "c";
        } else if ($this->status == "wd") {
            $thru = "wd";
        } else {
            $thru = ($this->thru != null) ? (($this->thru != '18') ? $this->thru : "F") : "--";
        }
        return $thru;
    }

    function get_golfer_today() {
        return $this->today;
    }

    function set_isWorst($value) {
        $this->isWorst = $value;
    }

    function get_isWorst() {
        return $this->isWorst;
    }
}

class Entry {
    var $name;
    var $tiebreak_score;
    var $tiebreak_diff;
    var $golfers;
    var $total = 0;

    function __construct($name, $tier1, $tier2, $tier3, $tier4, $tiebreaker, $leader) {
        $this->name = $name;
        $this->tiebreak_score = $tiebreaker;
        $this->tiebreak_diff = abs($tiebreaker - $leader);
        $this->golfers = array($tier1, $tier2, $tier3, $tier4);
    }

    function get_name() {
        return $this->name;
    }

    function get_tiebreaker() {
        return $this->tiebreak_score;
    }

    function get_tiebreak_diff() {
        return $this->tiebreak_diff;
    }

    function get_golfer_name($tier) {
        return $this->golfers[$tier - 1]->get_golfer_name();
    }

    function get_golfer_score($tier) {
        return $this->golfers[$tier - 1]->get_golfer_score();
    }

    function get_golfer_thru($tier) {
        return $this->golfers[$tier - 1]->get_golfer_thru();
    }

    function get_golfer_isWorst($tier) {
        return $this->golfers[$tier - 1]->get_isWorst();
    }

    function get_golfer_place($tier) {
        return $this->golfers[$tier - 1]->get_golfer_place();
    }

    function get_golfer_today($tier) {
        return $this->golfers[$tier - 1]->get_golfer_today();
    }

    function get_total() {
        $this->total = 0;
        $unused_golfer;
        if ($this->golfers[0]->get_golfer_score() > $this->golfers[1]->get_golfer_score()) {
            $unused_golfer = $this->golfers[0];
        } else {
            $unused_golfer = $this->golfers[1];
        }
        if ($unused_golfer->get_golfer_score() <= $this->golfers[2]->get_golfer_score()) {
            $unused_golfer = $this->golfers[2];
        }
        if ($unused_golfer->get_golfer_score() <= $this->golfers[3]->get_golfer_score()) {
            $unused_golfer = $this->golfers[3];
        }
        $unused_golfer->set_isWorst(true);
        for ($i = 0; $i < 4; $i++) {
            $this->total += ($this->golfers[$i]->get_isWorst()) ? 0 : $this->golfers[$i]->get_golfer_score();
        }
        return $this->total;

    }
}

class Player {
    var $name;
    var $image;
    var $flag;
    var $country;

    function __construct($name, $image, $flag, $country) {
        $this->name = $name;
        $this->image = $image;
        $this->flag = $flag;
        $this->country = $country;
    }

    function getName() {
        return $this->name;
    }

    function getImage() {
        return $this->image;
    }

    function getflag() {
        return $this->flag;
    }

    function getCountry() {
        return $this->country;
    }
}

$matthew_fitzpatrick = new Player("Matthew Fitzpatrick", 
                                  "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_40098.png",
                                  "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/ENG.png",
                                  "England");
$xander_schauffele = new Player("Xander Schauffele",
                                "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_48081.png",
                                "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/USA.png",
                                "United States");
$rory_mcilroy = new Player("Rory McIlroy",
                           "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_28237.png",
                           "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/NIR.png",
                           "Northern Ireland");
$adam_scott = new Player("Adam Scott",
                         "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_24502.png",
                         "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/AUS.png",
                         "Australia");
$louis_oosthuizen = new Player("Louis Oosthuizen",
                               "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_26329.png",
                               "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/RSA.png",
                               "South Africa");
$abraham_ancer = new Player("Abraham Ancer",
                            "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_45526.png",
                            "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/MEX.png",
                            "Mexico");
$patrick_reed = new Player("Patrick Reed",
                           "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_34360.png",
                           "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/USA.png",
                           "United States");
$tyrrell_hatton = new Player("Tyrrell Hatton",
                             "https://pga-tour-res.cloudinary.com/image/upload/b_rgb:cecece,c_fill,d_headshots_default.png,dpr_2.0,f_jpg,g_face:center,h_65,q_auto,w_65/headshots_34363.png",
                             "https://www.pgatour.com/etc/designs/pgatour-libs/img/flags/24x24/ENG.png",
                             "England");
$player_array = array($matthew_fitzpatrick, $xander_schauffele, $rory_mcilroy, $adam_scott, $louis_oosthuizen, $abraham_ancer, $patrick_reed, $tyrrell_hatton);

$servername = "localhost";
$username = $U_NAME;
$password = $P_WORD;

$con = new mysqli($servername, $username, $password);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
if (!mysqli_select_db($con, $DATABASE))  {
    echo "Unable to locate the database";   
    exit();  
}

$req = "https://statdata.pgatour.com/r/current/message.json";

$cSession = curl_init();
curl_setopt($cSession,CURLOPT_URL,$req);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
$rez=curl_exec($cSession);
curl_close($cSession);

$rez_obj = json_decode($rez);
//$current_id = $rez_obj->tid;
$current_id = '489';

$entrants = array();
$tier1_golfers = array();
$tier2_golfers = array();
$tier3_golfers = array();
$tier4_golfers = array();
$totals = array();

$getEntries = "SELECT * FROM entries WHERE event_id = '".$current_id."'";
$res = mysqli_query($con, $getEntries);
$rowCount = mysqli_num_rows($res);

while($row = mysqli_fetch_array($res)) {
    $entrants[] = $row["name"];
    $tier1_golfers[] = $row["tier1_golfer"];
    $tier2_golfers[] = $row["tier2_golfer"];
    $tier3_golfers[] = $row["tier3_golfer"];
    $tier4_golfers[] = $row["tier4_golfer"];
    $totals[] = $row["score"];
}

$all_golfers = array($tier1_golfers, $tier2_golfers, $tier3_golfers, $tier4_golfers);

$request = "https://statdata.pgatour.com/r/" . $current_id . "/leaderboard-v2mini.json";

$cSession = curl_init();
curl_setopt($cSession,CURLOPT_URL,$request);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
$result=curl_exec($cSession);
curl_close($cSession);

$obj = json_decode($result);
$current_tourney = $obj->leaderboard->tournament_name;
$current_tourney = ucwords(strtolower($current_tourney));
$is_started = true;

$request2 = "https://statdata.pgatour.com/r/" . $current_id . "/leaderboard-v2.json";

$cSession = curl_init();
curl_setopt($cSession,CURLOPT_URL,$request2);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
$result2=curl_exec($cSession);
curl_close($cSession);

$obj2 = json_decode($result2);
$player_name = $obj2->leaderboard->players[0]->player_bio->last_name . ", " . $obj2->leaderboard->players[0]->player_bio->first_name;

$tot = $obj->leaderboard->players[0]->total;
$leader_score = ($tot >= 0) ? (($tot > 0) ? "+" . $tot : "E") : $tot;

$entries = array();
for ($i = 0; $i < $rowCount; $i++) {
    $golfers_scores = array();
    for ($k = 0; $k < 4; $k++) {
        $found = false;
        foreach ($obj->leaderboard->players as $player) {
            if ($all_golfers[$k][$i] == "Alex Bjork") {
                $all_golfers[$k][$i] = "Alex Björk";
            }
            $golfer = $player->player_bio->first_name . " " . $player->player_bio->last_name;
            if (strcasecmp($all_golfers[$k][$i], $golfer) == 0) {
                $golfer_score = new Golfer($all_golfers[$k][$i], $player->total, $player->today, $player->thru, $player->status, $player->current_position);
                array_push($golfers_scores, $golfer_score);
                $found = true;
            }
        }
        if (!$found) {
            $golfer_score = new Golfer($all_golfers[$k][$i], 0, 0, null, "active", "N/A");
            array_push($golfers_scores, $golfer_score);
        }
    }
    $entry = new Entry($entrants[$i], $golfers_scores[0], $golfers_scores[1], $golfers_scores[2], $golfers_scores[3], $totals[$i], $tot);
    array_push($entries, $entry);
}

function sort_entries($a,$b) {
    return ($a->get_total() <= $b->get_total()) ? (($a->get_total() == $b->get_total()) ? (($a->get_tiebreak_diff() < $b->get_tiebreak_diff()) ? -1 : 1) : -1) : 1;
}

usort($entries, "sort_entries");
    
?>