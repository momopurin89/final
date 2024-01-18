<?php session_start();?>
<?php require 'db-connect.php';?>
<?php require 'header.php';?>
<?php require 'menu.php';?>
<?php
unset($_SESSION['Users']);
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from Users where Username=?');
$sql->execute([$_POST['Username']]);
foreach ($sql as $row){
    if(password_verify($_POST['Password'],$row['Password'])){
    $_SESSION['Users']=[
        'UserID' =>$row['UserID'],'Username'=>$row['Username'],
        'Password'=>$row['Password'],'Email'=>$row['Email'],
        'Icon'=>$row['Icon'],'Profile'=>$row['Profile'],
        'Password'=>$row['Password']];
    }

}
if(isset($_SESSION['Users'])){
    echo 'こんにちは、',$_SESSION['Users']['Username'],'さん。';
    
}else {
    echo 'ログイン名またはパスワードが違います';
}
?>
<?php require 'footer.php';?>
<?php require 'back.php'; ?>