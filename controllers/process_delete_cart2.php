<?php
$json_file = file_get_contents('../data/carts.json');
$carts = json_decode($json_file, true);
session_start();
$id = $_GET['id'];

foreach($carts as $index=>$cart) {
    if($_SESSION['user_info']['id'] == $cart['user_id']) {
    foreach($cart['items'] as $i => $item) {
        if ($id == $item['product_id']) {
            array_splice($carts[$index]['items'], $i, 1);
        }
        
    }}
}

file_put_contents('../data/carts.json', json_encode($carts, JSON_PRETTY_PRINT));
header('Location: ../views/my_cart.php');
?>