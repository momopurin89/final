<?php
session_start();
require 'db-connect.php';
require 'header.php'; 
require 'menu.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $startDateTime = $_POST['startDateTime'];
    $endDateTime = $_POST['endDateTime'];
    $categoryID = $_POST['category']; 

    $creatorID = isset($_SESSION['Users']['UserID']) ? $_SESSION['Users']['UserID'] : 1;

    $sql = 'INSERT INTO Events (Title, Description, StartDateTime, EndDateTime, CreatorID, CategoryID) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$title, $description, $startDateTime, $endDateTime, $creatorID, $categoryID]);
        echo "イベントが作成されました。";
    } catch (PDOException $e) {
        echo "イベント作成エラー: " . $e->getMessage();
    }
}

$pdo = null;
?>

