<?php session_start(); ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

   
}
?>
<?php require 'db-connect.php'; ?>
<?php

// 接続エラーの確認
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// ログインフォームからのデータを取得
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // ユーザー認証のクエリ
    $sql = "SELECT UserID FROM Users WHERE Username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // 認証成功
        $_SESSION['username'] = $username;
        header("Location: welcome.php"); // リダイレクト先を設定
        exit();
    } else {
        // 認証失敗
        echo "ユーザー名またはパスワードが間違っています。";
    }
}

$conn->close();
?>