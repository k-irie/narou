<?php

require_once 'db/dao_narou.php';


function getParamsUrl($url , $params) {
    $p = [];
    
    foreach($params as $key => $value){
        $key = urldecode($key);
        $value = urlencode($value);
        $p[] = "{$key}={$value}";
    }
    return $url . '?' . implode('&',$p);
}


function getNarou($url , $params ){
    $json = '';
    global $db,$db_error;

    try{
        $curl = curl_init();

        // echo  getParamsUrl($url,$params) ;

        curl_setopt($curl, CURLOPT_URL, getParamsUrl($url,$params) );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す

        // ユーザエージェント情報
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['User-Agent: NarouCrawler/000100']);

        $response = curl_exec($curl);
        $json = gzdecode($response);

        curl_close($curl);
        
        $json = json_decode($json ,true);
    }catch(Exception $e){
        $db_error[] = $e->getMessage();
    }
    return $json;
}

function getNovelInfo($ncode){
    global $db_error;

    $url_ncode = "https://api.syosetu.com/novelapi/api/";
    $json = false;
    $result = [];
    $result['mode'] = '';
    $result['error'] = [];
    
    $params = [];
    $params['gzip'] = 5;
    $params['out'] = 'json';
    $params['ncode'] = $ncode;

    $row = getNovelByNCode($ncode);
    if($row){
        $result['mode'] = 'db';
        $result['data'] = $row;
    }else{
        $result['mode'] = 'online';
        $row = getNarou($url_ncode,$params);
        // var_dump($row);
        addTable('novel',$row[1]);
        $result['data'] = $row;
    }
    $result['error'] = $db_error; 
    return $result;
}

function getRankng($date, $mode='d'){
    global $db_error;
    $url_ranking = 'https://api.syosetu.com/rank/rankget/';

    $json = false;
    $result = [];
    $result['mode'] = '';
    $result['error'] = [];
    
    $params = [];
    $params['gzip'] = 5;
    $params['out'] = 'json';
    $params['rtype'] = "{$date}-{$mode}";

    $row = getRankingByRType($params['rtype']);
    if ($row) {
        $result['mode'] = 'db';
        // echo "get db";
        $json = $row['json'];
    }else{
        $result['mode'] = 'online';
        // echo "get online";
        $result = getNarou($url_ranking,$params);
        // addRanking($params['rtype'] ,json_encode( $result));
        addTable('ranking',array('rtype'=>$params['rtype'],'json'=>json_encode($result)));
        // var_dump($db_error);
    }
    
    if ($json){
        $result['data'] = json_decode($json);
    }

    $result['error'] = $db_error; 
    return $result;
}