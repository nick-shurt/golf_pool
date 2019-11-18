<?php
include 'php_golf_pool.php';

$name = $_REQUEST["name"];

$data_array = array();
foreach ($player_array as $player) {
    if ($name == $player->getName()) {
        array_push($data_array, $player->getImage());
        array_push($data_array, $player->getflag());
        array_push($data_array, $player->getCountry());
    }
}

echo json_encode($data_array);
?>