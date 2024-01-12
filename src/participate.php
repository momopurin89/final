<?php
session_start();
require 'db-connect.php';
require 'header.php';
require 'menu.php';

// ユーザーがログインしているか確認
if (!isset($_SESSION['Users']['UserID'])) {
    header('Location: login-input.php');
    exit;
}

$eventID = $_GET['eventid'];
$userID = $_SESSION['Users']['UserID'];

// 参加登録処理
try {
    $stmt = $pdo->prepare('INSERT INTO Participation (UserID, EventID, Status) VALUES (?, ?, "参加")');
    $stmt->execute([$userID, $eventID]);
    echo '参加登録が完了しました。';
} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}

$pdo = null;
?>
