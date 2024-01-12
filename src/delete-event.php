<?php
require 'db-connect.php';
require 'header.php';
require 'menu.php';
$eventID = $_GET['eventid']; 

try {
    // トランザクション開始
    $pdo->beginTransaction();

    // 関連する参加登録データを削除
    $stmt = $pdo->prepare('DELETE FROM Participation WHERE EventID = ?');
    $stmt->execute([$eventID]);

    // 関連するコメントを削除
    $stmt = $pdo->prepare('DELETE FROM Comments WHERE EventID = ?');
    $stmt->execute([$eventID]);

    // イベントを削除
    $stmt = $pdo->prepare('DELETE FROM Events WHERE EventID = ?');
    $stmt->execute([$eventID]);

    // トランザクション確定
    $pdo->commit();
    echo "イベントが削除されました。";
} catch (PDOException $e) {
    // トランザクションをロールバック
    $pdo->rollBack();
    echo "エラー: " . $e->getMessage();
}

$pdo = null;
?>
