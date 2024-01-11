<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php

require 'db-connect.php';

$eventID = $_GET['eventid']; 

$stmt = $pdo->prepare('SELECT * FROM Events WHERE EventID = ?');
$stmt->execute([$eventID]);
$event = $stmt->fetch();


$categoryStmt = $pdo->prepare('SELECT * FROM Categories');
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll();

?>
<form action="update-event.php" method="post">
    <input type="hidden" name="eventid" value="<?php echo $event['EventID']; ?>">
    <div>
        <label for="title">タイトル:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($event['Title']); ?>" required>
    </div>
    <div>
        <label for="description">説明:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($event['Description']); ?></textarea>
    </div>
    <div>
        <label for="startDateTime">開始日時:</label>
        <input type="datetime-local" id="startDateTime" name="startDateTime" value="<?php echo htmlspecialchars($event['StartDateTime']); ?>" required>
    </div>
    <div>
        <label for="endDateTime">終了日時:</label>
        <input type="datetime-local" id="endDateTime" name="endDateTime" value="<?php echo htmlspecialchars($event['EndDateTime']); ?>" required>
    </div>
    <div>
        <label for="category">カテゴリ:</label>
        <select id="category" name="category">
            <?php
            foreach ($categories as $category) {
                $selected = ($category['CategoryID'] == $event['CategoryID']) ? 'selected' : '';
                echo '<option value="', $category['CategoryID'], '" ', $selected, '>', htmlspecialchars($category['Name']), '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <button type="submit">更新</button>
    </div>
</form>
