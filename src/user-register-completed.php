<?php
require 'db-connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // パスワードのハッシュ化
    $profile = $conn->real_escape_string($_POST['profile']);

   
    $icon = $_FILES['icon'];
    if ($icon['error'] == 0) {
        $iconPath = 'upload/' . basename($icon['name']);
        if (move_uploaded_file($icon['tmp_name'], $iconPath)) {
           
        } else {
            
            echo "アイコンのアップロードに失敗しました。";
        }
    }

    $sql = "INSERT INTO Users (Username, Email, Password, Profile, Icon) VALUES ('$username', '$email', '$password', '$profile', '$iconPath')";

    if ($conn->query($sql) === TRUE) {
        echo "新規登録が完了しました。";
    } else {
        echo "エラー: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
