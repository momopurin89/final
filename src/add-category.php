<?php
session_start();
require 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    try {
        $stmt = $pdo->prepare('INSERT INTO Categories (Name) VALUES (?)');
        $stmt->execute([$name]);
        echo "カテゴリが追加されました。<br>";
        echo '<a href="add-category-form.php">戻る</a>';
    } catch (PDOException $e) {
        echo "カテゴリ追加エラー: " . $e->getMessage();
    }
}

$pdo = null;
?>
