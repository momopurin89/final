<?php session_start();?>
<?php require 'header.php';?>
<?php require 'menu.php';?>
<?php require 'db-connect.php';?>
<?php
$pdo = new PDO($connect,USER,PASS);
if(isset($_SESSION['Users'])){
    $UserID=$_SESSION['Users']['UserID'];
    $sql=$pdo->prepare('select * from Users where UserID!=? and Username=?');
    $sql->execute([$UserID,$_POST['Username']]);
}else{
    $sql=$pdo->prepare('select * from Users where Username=?');
    $sql->execute([$_POST['Username']]);
}
if(empty($sql->fetchAll())){  
    if(isset($_SESSION['Users'])){
        $sql=$pdo->prepare('update Users set Username=?, Password=?, Email=?, Icon=?, Profile=? where UserID=?');
        $sql->execute([
            $_POST['Username'], password_hash($_POST['Password'], PASSWORD_DEFAULT),
            $_POST['Email'], $_POST['Icon'], $_POST['Profile'], $UserID]);
        

        $_SESSION['Users']=[
            'UserID'=>$UserID,'Username'=>$_POST['Username'],
            'Password'=>$_POST['Password'],'Email'=>$_POST['Email'],
            'Icon'=>$_POST['Icon'],'Profile'=>$_POST['Profile']];
        echo 'お客様情報を更新しました。';
    }else{
        $sql=$pdo->prepare('insert into Users values(null,?,?,?,?,?)');
$sql->execute([
    $_POST['Username'], password_hash($_POST['Password'], PASSWORD_DEFAULT),
    $_POST['Email'], $_POST['Icon'], $_POST['Profile']]);

        echo 'お客様情報を登録しました。';
    }
}else{
    echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>
<?php require 'footer.php';?>