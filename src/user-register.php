<!DOCTYPE html>
<html>
<head>
    <title>新規会員登録</title>
</head>
<body>
    <h2>新規会員登録フォーム</h2>
    <form action="register.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="username">ユーザー名:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="profile">プロフィール:</label>
            <textarea id="profile" name="profile"></textarea>
        </div>
        <div>
            <label for="icon">アイコン（画像）:</label>
            <input type="file" id="icon" name="icon">
        </div>
        <div>
            <button type="submit">登録</button>
        </div>
    </form>
</body>
</html>
