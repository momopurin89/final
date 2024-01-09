<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516912-final';
const USER = 'LAA1516912';
const PASS = 'Pass0421';

$connect= 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('データベース接続失敗: ' . $e->getMessage());
}
?>
