<?php 
$json_file = file_get_contents('../data/carts.json');
$carts = json_decode($json_file, true);

session_start();
$id = $_GET['id'];

foreach($carts as $index => $cart) {
    if($_SESSION['user_info']['id'] == $cart['user_id']) {
        $carts[$index]['items'] = array_slice($carts[$index]['items'], -1, -1);
        
    }
}

file_put_contents('../data/carts.json', json_encode($carts, JSON_PRETTY_PRINT));
header('Location: ../views/my_cart.php');

?>