<?php
session_start();
$json_file = file_get_contents('../data/transactions.json');
$transactions = json_decode($json_file, true);
date_default_timezone_get("Asia/Kuala_Lumpur");

$transaction = [
    "id" => uniqid(),
    "username" => $_SESSION['user_info']['username'],
    "items" => $_SESSION['cart'],
    "total" => $_POST['total'],
    "status" => "pending",
    "datePurchased" => date("Y/m/d h:i:sa"),
    "payment" => ""
];

$transactions[] = $transaction;
file_put_contents('../data/transactions.json', json_encode($transactions, JSON_PRETTY_PRINT));
unset($_SESSION['cart']);

header('Location: /');
?>