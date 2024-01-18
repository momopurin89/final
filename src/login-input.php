<?php require 'header.php'; ?>
<?php require 'menu2.php'; ?>
<link rel="stylesheet" href="../css/login-input.css" />

<div class="center-container">
    <img src="../img2/main_name.png" alt="" width="200px">
    <h2>ログインして！</h2>
    <form action="login-output.php" method="post">
        ユーザー名<input type="text" name="Username"><br>
        パスワード<input type="Password" name="Password"><br>
        <input type="submit" value="ログイン" class="btn-style"> 
        <div>
            <a href="user-register.php">新規作成はこちらから</a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
<?php require 'back.php'; ?>
