<?php 

$json_file = file_get_contents('../data/carts.json');
$carts = json_decode($json_file, true);

session_start();

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$quantity = intval($_POST['quantity']);

    foreach($carts as $index => $cart) {
        foreach($cart['items'] as $i => $item) {
            if($item['product_id'] == $id) {
                $carts[$index]['items'][$i]['quantity'] = $quantity;
            }
        }
        echo "<pre>";
        var_dump($cart);
        echo "</pre>";
    }

echo "<pre>";
var_dump($carts);
echo "</pre>";

file_put_contents('../data/carts.json', json_encode($carts, JSON_PRETTY_PRINT));
header('Location: ' . $_SERVER['HTTP_REFERER']);