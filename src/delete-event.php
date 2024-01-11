<?php

require 'db-connect.php';
require 'header.php';
require 'menu.php';
$eventID = $_GET['eventid']; 


$stmt = $pdo->prepare('DELETE FROM Events WHERE EventID = ?');
$stmt->execute([$eventID]);
echo "イベントが削除されました。";
?>
