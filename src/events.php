<?php 
require 'header.php';
require 'menu.php';
require 'db-connect.php';

$stmt = $pdo->prepare('SELECT * FROM Categories');
$stmt->execute();
$categories = $stmt->fetchAll();

echo '<h1>イベント一覧</h1>';
echo '<h3>プルダウンで探したいカテゴリを選択してから「探す」ボタンを押してください</h3>';

echo '<form method="get">';
echo '<select name="category">';
echo '<option value="">全てのイベント</option>'; 
foreach ($categories as $category) {
    echo '<option value="', $category['CategoryID'], '">', htmlspecialchars($category['Name']), '</option>';
}
echo '</select>';
echo '<button type="submit">探す</button>';
echo '</form>';

try {
    if (isset($_GET['category']) && $_GET['category'] !== '') {
        $selectedCategory = $_GET['category'];
        $sql = 'SELECT Events.*, Users.Username, Users.Icon FROM Events 
                JOIN Users ON Events.CreatorID = Users.UserID 
                WHERE CategoryID = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$selectedCategory]);
    } else {
        $sql = 'SELECT Events.*, Users.Username, Users.Icon FROM Events 
                JOIN Users ON Events.CreatorID = Users.UserID';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    echo '<ul>';
    foreach ($stmt as $row) {
        echo '<li>';
        $iconPath = '../img/' . $row['Icon'];
        echo '<img src="' . htmlspecialchars($iconPath) . '" alt="アイコン" style="width: 50px; height: 50px;"> ';
        echo htmlspecialchars($row['Username']) . ': ';
        echo htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8');
        echo ' - ';
        echo htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8');
        echo ' (';
        echo htmlspecialchars($row['StartDateTime'], ENT_QUOTES, 'UTF-8');
        echo ' - ';
        echo htmlspecialchars($row['EndDateTime'], ENT_QUOTES, 'UTF-8');
        echo ')';

        echo ' <a href="edit-event.php?eventid=', $row['EventID'], '">編集</a>';
        echo ' <a href="delete-event.php?eventid=', $row['EventID'], '">削除</a>';

        
        echo ' <a href="participate.php?eventid=', $row['EventID'], '">参加登録</a>';

        echo
        '<form action="post-comment.php" method="post">';
        echo '<input type="hidden" name="eventid" value="', $row['EventID'], '">';
        echo '<input type="text" name="comment" placeholder="コメントを入力">';
        echo '<button type="submit">コメント投稿</button>';
        echo '</form>';
          
    $commentStmt = $pdo->prepare('SELECT Comments.*, Users.Username, Users.Icon FROM Comments 
    JOIN Users ON Comments.UserID = Users.UserID 
    WHERE EventID = ?');
$commentStmt->execute([$row['EventID']]);
$comments = $commentStmt->fetchAll();

echo '<div class="comments">';
foreach ($comments as $comment) {
$commentIconPath = '../img/' . $comment['Icon'];
echo '<p><img src="' . htmlspecialchars($commentIconPath) . '" alt="アイコン" style="width: 25px; height: 25px;"> ';
echo htmlspecialchars($comment['Username']) . ': ';
echo htmlspecialchars($comment['Content']) . ' - ' . htmlspecialchars($comment['PostDateTime']) . '</p>';
}
echo '</div>';

echo '<p>参加者登録者一覧</p>';

$participantStmt = $pdo->prepare('SELECT Users.Username, Users.Icon FROM Participation 
        JOIN Users ON Participation.UserID = Users.UserID 
        WHERE EventID = ?');
$participantStmt->execute([$row['EventID']]);
$participants = $participantStmt->fetchAll();

echo '<div class="participants">';
foreach ($participants as $participant) {
$participantIconPath = '../img/' . $participant['Icon'];
echo '<p><img src="' . htmlspecialchars($participantIconPath) . '" alt="アイコン" style="width: 25px; height: 25px;"> ';
echo htmlspecialchars($participant['Username']) . '</p>';
}
echo '</div>';

echo '</li>';
}
echo '</ul>';
} catch (PDOException $e) {
    echo 'データベースエラー: ' . $e->getMessage();
    }
    
    $pdo = null;
    
    require 'footer.php';
    ?>