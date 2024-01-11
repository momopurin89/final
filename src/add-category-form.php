<?php 
session_start();
require 'db-connect.php';

if (!isset($_SESSION['Users']['UserID'])) {
    header('Location: login-input.php');
    exit;
}


require 'header.php';
require 'menu.php'; 
?>


<!DOCTYPE html>
<html>
<head>
    <title>カテゴリ追加</title>
</head>
<body>
    <h2>カテゴリ追加フォーム</h2>
    <form action="add-category.php" method="post">
        <div>
            <label for="name">カテゴリ名:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <button type="submit">追加</button>
        </div>
    </form>
</body>
</html>
