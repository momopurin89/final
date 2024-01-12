<?php

session_start();

require 'header.php';
require 'menu.php';

if (isset($_SESSION['Users'])) {
    session_unset();

    session_destroy();

    echo 'ログアウトしました。';
} else {

    echo 'すでにログアウトしています。';
}

require 'footer.php';

// ログインページにリダイレクto
// header('Location: login-page.php');
// exit;
?>
