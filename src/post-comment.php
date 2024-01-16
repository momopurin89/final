<?php
session_start();
require 'db-connect.php';


if (!isset($_SESSION['Users']['UserID'])) {
    header('Location: login-input.php');
    exit;
}

$eventID = $_POST['eventid'];
$userID = $_SESSION['Users']['UserID'];
$comment = $_POST['comment'];


if (empty($comment)) {
   
    require 'header.php';
    require 'menu.php';
    echo 'コメントを入力してください。';
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO Comments (Content, PostDateTime, UserID, EventID) VALUES (?, NOW(), ?, ?)');
    $stmt->execute([$comment, $userID, $eventID]);
    header('Location: events.php');
    exit;
} catch (PDOException $e) {
    require 'header.php';
    require 'menu.php';
    echo 'エラー: ' . $e->getMessage();
    exit;
}

$pdo = null;
?>
