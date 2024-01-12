<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php'; ?>

<?php
$pdo = new PDO($connect, USER, PASS);

// 選択されたアイコンのファイル名を取得
$iconPath = isset($_POST['Icon']) ? $_POST['Icon'] : '';

// ユーザー情報の登録または更新
if (isset($_SESSION['Users'])) {
    $UserID = $_SESSION['Users']['UserID'];
    $sql = $pdo->prepare('update Users set Username=?, Password=?, Email=?, Icon=?, Profile=? where UserID=?');
    $sql->execute([
        $_POST['Username'], password_hash($_POST['Password'], PASSWORD_DEFAULT),
        $_POST['Email'], $iconPath, $_POST['Profile'], $UserID
    ]);
    echo 'お客様情報を更新しました。';
} else {
    $sql = $pdo->prepare('insert into Users values(null, ?, ?, ?, ?, ?)');
    $sql->execute([
        $_POST['Username'], password_hash($_POST['Password'], PASSWORD_DEFAULT),
        $_POST['Email'], $iconPath, $_POST['Profile']
    ]);
    echo 'お客様情報を登録しました。';
}

require 'footer.php';
?>
