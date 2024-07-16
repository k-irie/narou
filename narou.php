<?php
/**
 * なろうAPIを使いランキングを取得するAPI
 */
require_once 'logs.php';

logWrite("proc","narow.php","start");

if (isset($_GET['date'])){
    $date = $_GET['date'];
}else{
    $wd = new DateTime();
    $date = $wd->sub(new DateInterval('P1D'))->format('Ymd');
}
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}else{
    $type = 'd';
}


$result = [];
$result['error']=[];

require_once './narou_api.php';

$ranking = getRankng($date,$type);

// var_dump($ranking);
// logWrite("data","narow.php",serialize($ranking));

// var_dump($ranking['error']);

if (count($ranking['error']) > 0 ){
    $result['error'] = $ranking['error'];
}else{
    if (isset($ranking['data']) && $ranking['data']){
        $top10 = [];
        foreach($ranking['data'] as $novel){
            if ($novel['rank'] <= 10){
                $top10[intval($novel['rank'])] = $novel;
            }
        }

        for($index = 1 ; $index <= 10; $index++){
            $top10[$index]['novelInfo'] = getNovelInfo($top10[$index]['ncode'])['data'];
        }

        $result['data'] = $top10;
    }else{
        $result['error'][] = 'no data';
    }
}

header('Content-Type: application/json;UTF-8');
echo json_encode($result);

logWrite("proc","narow.php","end");
