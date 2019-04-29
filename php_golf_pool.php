<?php

class Golfer {
    var $name;
    var $score;
    var $thru;
    var $status;
    var $isWorst = false;

    function __construct($name, $score, $thru, $status) {
        $this->name = $name;
        $this->score = $score;
        $this->thru = $thru;
        $this->status = $status;
    }

    function get_golfer_name() {
        return $this->name;
    }

    function get_golfer_score() {
        return $this->score;
    }

    function get_golfer_thru() {
        $thru = "";
        if ($this->status == "cut") {
            $thru = "c";
        } else {
            $thru = ($this->thru != null) ? (($this->thru != '18') ? $this->thru : "F") : "--";
        }
        return $thru;
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
    var $golfers;
    var $total = 0;

    function __construct($name, $tier1, $tier2, $tier3, $tier4) {
        $this->name = $name;
        $this->golfers = array($tier1, $tier2, $tier3, $tier4);
    }

    function get_name() {
        return $this->name;
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

$tot = $obj->leaderboard->players[0]->total;
$leader_score = ($tot >= 0) ? (($tot > 0) ? "+" . $tot : "E") : $tot;

$entries = array();
for ($i = 0; $i < $rowCount; $i++) {
    $golfers_scores = array();
    for ($k = 0; $k < 4; $k++) {
        foreach ($obj->leaderboard->players as $player) {
            if ($all_golfers[$k][$i] == ($player->player_bio->first_name . " " . $player->player_bio->last_name)) {
                $golfer_score = new Golfer($all_golfers[$k][$i], $player->total, $player->thru, $player->status);
                array_push($golfers_scores, $golfer_score);
            }
        }
    }
    $entry = new Entry($entrants[$i], $golfers_scores[0], $golfers_scores[1], $golfers_scores[2], $golfers_scores[3]);
    array_push($entries, $entry);
}

function sort_entries($a,$b) {
    return ($a->get_total() <= $b->get_total()) ? -1 : 1;
}

usort($entries, "sort_entries");
    
?>