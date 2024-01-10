<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<h1>ログインフォーム</h1>
<form action="login-output.php" method="post">
ユーザー名<input type="text" name="Username"><br>
パスワード<input type="Password" name="Password"><br>
<input type="submit" value="ログイン">
<div>
    <a href="user-register.php">新規作成はこちらから</a>
</div>
</form>
<?php require 'footer.php'; ?>