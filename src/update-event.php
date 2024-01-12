<?php
session_start();
require 'db-connect.php';
require 'header.php';
require 'menu.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventID = $_POST['eventid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $startDateTime = $_POST['startDateTime'];
    $endDateTime = $_POST['endDateTime'];
    $categoryID = $_POST['category']; 

    $stmt = $pdo->prepare('UPDATE Events SET Title = ?, Description = ?, StartDateTime = ?, EndDateTime = ?, CategoryID = ? WHERE EventID = ?');
    $stmt->execute([$title, $description, $startDateTime, $endDateTime, $categoryID, $eventID]);
    echo "イベントが更新されました。";
}

$pdo = null;
?>
