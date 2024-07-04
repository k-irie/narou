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
