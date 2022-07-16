<?php
session_start();
$json_file = file_get_contents('../data/transactions.json');
$transactions = json_decode($json_file, true);

$cart_json = file_get_contents('../data/carts.json');
$carts = json_decode($cart_json, true);
date_default_timezone_get("Asia/Kuala_Lumpur");

$transaction = [
    "id" => uniqid(),
    "username" => "",
    "items" => [],
    "total" => $_POST['total'],
    "status" => "pending",
    "datePurchased" => date("Y/m/d h:i:sa"),
    "payment" => ""
];


foreach ($carts as $i => $cart) {
    if($_SESSION['user_info']['id'] == $cart['user_id']) {
    
    foreach($cart['items'] as $item) {
        $username = $cart['username'];
        $transaction['username'] = $username;
        $transaction['items'][$item['product_id']] = $item['quantity'];
        echo $cartItem;   
    }

    }
}


$transactions[] = $transaction;

$id = $_GET['id'];

foreach($carts as $index => $cart) {
    if($_SESSION['user_info']['id'] == $cart['user_id']) {
        $carts[$index]['items'] = array_slice($carts[$index]['items'], -1, -1);
        
    }
}

file_put_contents('../data/carts.json', json_encode($carts, JSON_PRETTY_PRINT));
file_put_contents('../data/transactions.json', json_encode($transactions, JSON_PRETTY_PRINT));
header('Location: ../views/my_transaction.php');
?>