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

$eventID = $_POST['eventid'];
$userID = $_SESSION['Users']['UserID'];
$comment = $_POST['comment'];

// コメントが空ではないかチェック
if (empty($comment)) {
    echo 'コメントを入力してください。';
    exit;
}

// コメント投稿処理
try {
    $stmt = $pdo->prepare('INSERT INTO Comments (Content, PostDateTime, UserID, EventID) VALUES (?, NOW(), ?, ?)');
    $stmt->execute([$comment, $userID, $eventID]);
    echo 'コメントが投稿されました。';
} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}

$pdo = null;
?>
