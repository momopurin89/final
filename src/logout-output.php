<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php';?>
<?php
if (isset($_SESSION['Users'])) {
unset($_SESSION['Users']);
echo 'ログアウトしました。';
}else {
echo'すでにログアウトしています。';
}
?>
<?php require 'footer.php'; ?>