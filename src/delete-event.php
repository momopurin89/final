<?php
require 'db-connect.php';
require 'header.php';
require 'menu.php';
$eventID = $_GET['eventid']; 

try {
   
    $pdo->beginTransaction();

   
    $stmt = $pdo->prepare('DELETE FROM Participation WHERE EventID = ?');
    $stmt->execute([$eventID]);

   
    $stmt = $pdo->prepare('DELETE FROM Comments WHERE EventID = ?');
    $stmt->execute([$eventID]);

    
    $stmt = $pdo->prepare('DELETE FROM Events WHERE EventID = ?');
    $stmt->execute([$eventID]);

    $pdo->commit();
    echo "イベントが削除されました。";
} catch (PDOException $e) {
 
    $pdo->rollBack();
    echo "エラー: " . $e->getMessage();
}

$pdo = null;
?>
