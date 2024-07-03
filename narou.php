<?php
/**
 * なろうAPIを使いランキングを取得するAPI
 */

$result = [];

require_once './narou_api.php';


$result = getRankng('20240703','d');
// $result = getNovelInfo('N4520JF');


header('Content-Type: application/json;UTF-8');
echo json_encode($result);
