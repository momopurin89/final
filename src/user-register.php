<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php';?>
<?php
$Username=$Password=$Email=$Icon=$Profile='';
if(isset($_SESSION['Users'])){
    $Username=$_SESSION['Users']['Username'];
    $Email=$_SESSION['Users']['Email'] ;
    $Icon=$_SESSION['Users']['Icon'] ;
    $Profile=$_SESSION['Users']['Profile'] ;
}
    echo '<form action="user-register-completed.php" method="post">';
    echo '<table>';
    echo'<tr><td>お名前</td><td>';
    echo '<input type="text" name="Username" value="', $Username,'">';
    echo '</td></tr>';
    echo'<tr><td>パスワード</td><td>';
    echo '<input type="password" name="Password" value="', $Password, '">';
    echo '</td></tr>';
    echo'<tr><td>メールアドレス</td><td>';
    echo '<input type="text" name="Email" value="', $Email, '">';
    echo '</td></tr>';
    echo'<tr><td>アイコン画像</td><td>';
    echo '<input type="file" name="Icon" value="', $Icon, '">';
    echo '</td></tr>';
    echo'<tr><td>プロフィール</td><td>';
    echo '<input type="textarea" name="Profile" value="', $Profile, '">';
    echo '</td></tr>';
    echo '</table>';
    echo '<input type="submit" value="登録">';
    echo '</form>';
    ?>
    <?php require 'footer.php'; ?>