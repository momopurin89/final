<?php
session_start();
require 'db-connect.php';


if (!isset($_SESSION['Users'])) {
    header('Location: login-input.php');
    exit;
}

require 'header.php';
require 'menu3.php';

$userID = $_SESSION['Users']['UserID'];
$stmt = $pdo->prepare("SELECT * FROM Users WHERE UserID = ?");
$stmt->execute([$userID]);
$user = $stmt->fetch();

$eventsStmt = $pdo->prepare("SELECT Events.* FROM Events JOIN Participation ON Events.EventID = Participation.EventID WHERE Participation.UserID = ?");
$eventsStmt->execute([$userID]);
$events = $eventsStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="../css/mypage.css">
</head>
<body>
    <section class="wrapper">
        <nav class="menu">
            <ul class="menu__list">
                <li class="menu__item js-modify active" data-target=".card" data-effect="zoom">Zoom out</li>
                <li class="menu__item js-modify" data-target=".card" data-effect="blur">Blur</li>
                <li class="menu__item js-modify" data-target=".card" data-effect="color">Colors</li>
            </ul>
        </nav>

        <div class="card" data-effect="zoom">
            <button class="card__save js-save" type="button">
                <i class="fa fa-bookmark"></i>
            </button>
            <figure class="card__image">
                <img src="https://c1.staticflickr.com/4/3935/32253842574_d3d449ab86_c.jpg" alt="Short description">
            </figure>
            <div class="card__header">
                <figure class="card__profile">
                    <img src="../img/<?php echo htmlspecialchars($user['Icon']); ?>" alt="アイコン">
                </figure>
            </div>
            <div class="card__body">
                <h3 class="card__name"><?php echo htmlspecialchars($user['Username']); ?></h3>
                <p class="card__job"><?php echo htmlspecialchars($user['Profile']); ?></p>
                <p class="card__bio">
                    <p class="card__date">参加イベント一覧</p>
                    <ul>
                        <?php foreach ($events as $event): ?>
                            <li><?php echo htmlspecialchars($event['Title']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </p>
            </div>
            <div class="card__footer">
                <p class="card__date">THANK YOU</p>
                <p class=""></p>
            </div>
        </div>
    </section>
    <script src="../js/mypage.js"></script>
</body>
</html>
