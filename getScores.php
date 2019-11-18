<?php
$name = $_REQUEST["name"];

$request2 = "https://statdata.pgatour.com/r/489/leaderboard-v2.json";

$cSession = curl_init();
curl_setopt($cSession,CURLOPT_URL,$request2);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
$result2=curl_exec($cSession);
curl_close($cSession);

$obj2 = json_decode($result2);

$golfer = $obj2->leaderboard->players[0];

foreach ($obj2->leaderboard->players as $player) {
    if (strcasecmp($name, $player->player_bio->first_name . " " . $player->player_bio->last_name) == 0) {
        $golfer = $player;
    }
}

$both_scores = array();

for ($x = 0; $x < 2; $x++) {
    $total_par = 0;
    $total_score = 0;
    $num = ($x == 0) ? 0 : 9;

    $html = "<tr style='background-color: #1c1c1c;color: #e4e4e4;'>";
    $html .= "<td colspan='2' style='text-align:left; padding-left: 5px; width: 23.5%; font-weight: bold;'>HOLE</td>";
    if ($x == 0) {   
        $html .= "<td>1</td>";
        $html .= "<td>2</td>";
        $html .= "<td>3</td>";
        $html .= "<td>4</td>";
        $html .= "<td>5</td>";
        $html .= "<td>6</td>";
        $html .= "<td>7</td>";
        $html .= "<td>8</td>";
        $html .= "<td>9</td>";
        $html .= "<td>OUT</td>";
    } else {
        $html .= "<td>10</td>";
        $html .= "<td>11</td>";
        $html .= "<td>12</td>";
        $html .= "<td>13</td>";
        $html .= "<td>14</td>";
        $html .= "<td>15</td>";
        $html .= "<td>16</td>";
        $html .= "<td>17</td>";
        $html .= "<td>18</td>";
        $html .= "<td>IN</td>";
    }
    $html .= "</tr>";

    // PAR
    $html .= "<tr style='background-color: #323232;color: #e4e4e4;'>";
    $html .= "<td colspan='2' style='text-align:left; padding-left: 5px; width: 23.5%; font-weight: bold;'>PAR</td>";
    for ($k = $num; $k < $num + 9; $k++) {
        $html .= "<td>";
        $html .= $golfer->holes[$k]->par;
        $html .= "</td>";
        $total_par += $golfer->holes[$k]->par;
    }
    $html .= "<td>";
    $html .= $total_par;
    $html .= "</td>";
    $html .= "</tr>";

    // SCORES
    $html .= "<tr style='background-color: #1c1c1c;color: #e4e4e4;'>";
    $html .= "<td colspan='2' style='text-align:left; padding-left: 5px; width: 23.5%; font-weight: bold;'>SCORE</td>";
    for ($k = $num; $k < $num + 9; $k++) {
        if ($golfer->holes[$k]->par - $golfer->holes[$k]->strokes == 1) {
            $html .= "<td style='background-color: #a1e09f; color: #000;'>";
        } else if ($golfer->holes[$k]->par - $golfer->holes[$k]->strokes > 1) {
            $html .= "<td style='background-color: #aed4f6; color: #000;'>";
        } else if ($golfer->holes[$k]->par - $golfer->holes[$k]->strokes == -1) {
            $html .= "<td style='background-color: #d16969; color: #000;'>";
        } else if ($golfer->holes[$k]->par - $golfer->holes[$k]->strokes < -1) {
            $html .= "<td style='background-color: #edb445; color: #000;'>";
        } else {
            $html .= "<td>";
        }
        $html .= $golfer->holes[$k]->strokes;
        $html .= "</td>";
        $total_score += $golfer->holes[$k]->strokes;
    }
    $html .= "<td>";
    $html .= $total_score;
    $html .= "</td>";
    $html .= "</tr>";

    array_push($both_scores, $html);
}

echo json_encode($both_scores);
?>