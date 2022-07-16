<?php
session_start();

unset($_SESSION['cart'][$_GET['id']]);

if(count($_SESSION['cart']) < 1) {
    unset($_SESSION['cart']);
}

header('Location: /');
?>

