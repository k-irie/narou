<?php

require_once 'connect.php';

// 現在取得済みのランキングを取得する
//  データベースに登録が無い場合、falseを返す
function getRankingByRType($rtype) {
    global $db, $db_error;
    $result = false;
    $sql = "SELECT * FROM ranking WHERE rtype = :rtype;";
    try {
        $smst = $db->prepare($sql);
        $smst->bindValue(':rtype',$rtype,PDO::PARAM_STR);
        if($smst->execute()){
            $result = $smst->fetch(PDO::FETCH_ASSOC);
        }else{
            $db_error[] = "データベース問い合わせに失敗しました{$sql}";
        }
    }catch(PDOException $e) {
        $db_error[] = $e->getMessage();
    }
    return $result;
}

function getNovelByNCode($ncode){
    global $db, $db_error;
    $result = false;
    $sql = "SELECT * FROM novel WHERE ncode = :ncode;";
    try {
        $smst = $db->prepare($sql);
        $smst->bindValue(':ncode',$ncode,PDO::PARAM_STR);
        if($smst->execute()){
            $result = $smst->fetch(PDO::FETCH_ASSOC);
        }else{
            $db_error[] = "データベース問い合わせに失敗しました{$sql}";
        }
    }catch(PDOException $e) {
        $db_error[] = $e->getMessage();
    }
    return $result;
}

function buildCols($cols,$isph = false){
    if($isph){
        return ":" . implode(", :",array_keys($cols));
    }else{
        return implode(",",array_keys($cols));
    }
}


function addTable($table,$cols){
    global $db,$db_error;
    $result = false;

    $sql = "INSERT INTO {$table} (" . buildCols($cols) . ") VALUES (" . buildCols($cols,true) . ");";
    try {
        $db->beginTransaction();
// var_dump($cols);
// echo $sql;
        $smst = $db->prepare($sql);

        foreach($cols as $key => $value){
            $smst->bindValue(":{$key}",$value);
        }

        $smst->execute();
        $db->commit();
    }catch(PDOException $e) {
        $db->rollBack();
        $db_error[] = $e->getMessage();
    }
    return $result;
}

function addRanking($rtype,$json){
    global $db,$db_error;
    $result = false;
    $sql = "INSERT INTO ranking (rtype,json) VALUES(:rtype,:json);";
    try {
        $db->beginTransaction();
        $smst = $db->prepare($sql);
        $smst->bindValue(':rtype',$rtype,PDO::PARAM_STR);
        $smst->bindValue(':json',$json,PDO::PARAM_STR);
        $smst->execute();
        $db->commit();
    }catch(PDOException $e) {
        $db->rollBack();
        $db_error[] = $e->getMessage();
    }
    return $result;
}

function addNovel($novel){
    global $db,$db_error;
    $result = false;

    $sql =<<<INSERT_SQL
INSERT INTO novel (
	title,ncode,userid,writer,story,biggenre,genre,gensaku,keyword,general_firstup,general_lastup,novel_type,end,general_all_no,length,time,isstop,isr15,isbl,isgl,iszankoku,istensei,istenni,global_point,daily_point,weekly_point,monthly_point,quarter_point,yearly_point,fav_novel_cnt,impression_cnt,review_cnt,all_point,all_hyoka_cnt,sasie_cnt,kaiwaritu,novelupdated_at,updated_at
) VALUES (
	:title,:ncode,:userid,:writer,:story,:biggenre,:genre,:gensaku,:keyword,:general_firstup,:general_lastup,:novel_type,:end,:general_all_no,:length,:time,:isstop,:isr15,:isbl,:isgl,:iszankoku,:istensei,:istenni,:global_point,:daily_point,:weekly_point,:monthly_point,:quarter_point,:yearly_point,:fav_novel_cnt,:impression_cnt,:review_cnt,:all_point,:all_hyoka_cnt,:sasie_cnt,:kaiwaritu,:novelupdated_at,:updated_at
);
INSERT_SQL;
    try{
        $db->beginTransaction();
        $smst = $db->prepare($sql);
        foreach($novel as $key => $value){
            $smst->bindValue(':{$key}',$value);
        }
        $smst->execute();
        $db->commit();

    }catch(PDOException $e){
        $db->rollBack();
        $db_error[] = $e->getMessage();
    }
    return $result;
}
