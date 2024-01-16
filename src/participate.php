<?php
session_start();
require 'db-connect.php';


if (!isset($_SESSION['Users']['UserID'])) {
    header('Location: login-input.php');
    exit;
}

$eventID = $_GET['eventid'] ?? null;
$userID = $_SESSION['Users']['UserID'];

if ($eventID) {
   
    try {
        $stmt = $pdo->prepare('INSERT INTO Participation (UserID, EventID, Status) VALUES (?, ?, ?)');
        $stmt->execute([$userID, $eventID, '参加登録済み']);
        
       
        header('Location: events.php');
        exit;
    } catch (PDOException $e) {
        
        header('Location: error-page.php'); 
        exit;
    }
}


require 'header.php';
require 'menu.php';


echo '参加登録が完了しました。';
?>
