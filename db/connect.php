<?php
// connect.php
// http://localhost/php/db/connect.php
// header('Content-Type:text/plain;charset=UTF-8');

// データベース系エラーメッセージ
$db_error = [];

// 同一コンピュータ内のMySQLサービスへ接続する
//  XAMPPの初期設定
//  ホスト名:localhost
//  データベース名:mydb
//  文字コード表:utf8(MySQLでは「-」を付けない)
//  接続ユーザ:root
//  接続パスワード:なし(mampではroot)

// データベースへ接続する方法は幾つかあるがPDOを使用する
// PDOを使用する理由
// 1．SQLインジェクションに対応している
// 2．他のデータベースへの移行も比較的簡単

// データベースへの接続オブジェクト
$db = null;
// 接続情報ファイルを読み込む
require_once 'dbconfig.php';

// // 接続情報
// $host = 'localhost';
// $dbname = 'mydb';
// $user = 'root';
// $pass = '';
try {
    $db = new PDO(
        "mysql:dbname={$dbname};host={$host};charset=utf8",
        $user,$pass);
}catch(PDOException $e) {
    $db_error[] = $e->getMessage();
}
