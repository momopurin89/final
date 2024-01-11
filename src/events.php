<?php
require 'header.php';
require 'menu.php';
require 'db-connect.php';


try {
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

  
    if (isset($_GET['category']) && $_GET['category'] !== '') {
        $selectedCategory = $_GET['category'];
        $sql = 'SELECT * FROM Events WHERE CategoryID = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$selectedCategory]);
    } else {
        $sql = 'SELECT * FROM Events';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    echo '<ul>';
    foreach ($stmt as $row) {
        echo '<li>';
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
        echo '</li>';
    }
    echo '</ul>';
} catch (PDOException $e) {
    echo 'データベースエラー: ' . $e->getMessage();
}

$pdo = null;
?>

<?php require 'footer.php'; ?>
