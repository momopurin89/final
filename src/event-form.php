<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>イベント作成</title>
</head>
<body>
    <h2>イベント作成フォーム</h2>
    <form action="create-event.php" method="post">
        <div>
            <label for="title">タイトル:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="description">説明:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="startDateTime">開始日時:</label>
            <input type="datetime-local" id="startDateTime" name="startDateTime" required>
        </div>
        <div>
            <label for="endDateTime">終了日時:</label>
            <input type="datetime-local" id="endDateTime" name="endDateTime" required>
        </div>
        <div>
            <label for="category">カテゴリ:</label>
            <select id="category" name="category">
                <?php
                $stmt = $pdo->prepare('SELECT * FROM Categories');
                $stmt->execute();
                foreach ($stmt as $row) {
                    echo '<option value="', $row['CategoryID'], '">', htmlspecialchars($row['Name']), '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <button type="submit">イベント作成</button>
        </div>
    </form>
</body>
</html>
