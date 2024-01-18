<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu2.php'; ?>
<?php require 'db-connect.php'; ?>
<link rel="stylesheet" href="../css/user-register.css" />

<div class="center-container">
    <img src="../img2/main_name.png" alt="" width="200px">
    <form action="user-register-completed.php" method="post" enctype="multipart/form-data">
        <table>
            <tr><td>お名前</td><td>
                <input type="text" name="Username" required>
            </td></tr>
            <tr><td>パスワード</td><td>
                <input type="password" name="Password" required>
            </td></tr>
            <tr><td>メールアドレス</td><td>
                <input type="text" name="Email" required>
            </td></tr>
            <tr><td>アイコン画像</td><td>
                <select name="Icon" onchange="showIcon(this.value)">
                    <option value="" disabled selected>.....</option>
                    <?php
                        $icons = scandir('../img');
                        foreach ($icons as $icon) {
                            if ($icon !== '.' && $icon !== '..' && !is_dir('../img/' . $icon)) {
                                if (preg_match('/\.(jpeg|jpg|png|gif)$/i', $icon)) {
                                    echo '<option value="' . htmlspecialchars($icon) . '">' . htmlspecialchars($icon) . '</option>';
                                }
                            }
                        }
                    ?>
                </select>
            </td></tr>
            <tr><td colspan="2"><div id="iconPreview"></div></td></tr>
            <tr><td>プロフィール</td><td>
                <textarea name="Profile"></textarea>
            </td></tr>
        </table>
        <input type="submit" value="登録" class="btn-style">
        <div>
            <a href="login-input.php">ログインはこちらから</a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>

<script>
function showIcon(iconName) {
    var iconPath = '../img/' + iconName; 
    document.getElementById('iconPreview').innerHTML = '<img src="' + iconPath + '" alt="アイコン" style="width: 50px; height: 50px;">';
}
</script>

<?php require 'back.php'; ?>
