<?php

$json_file = file_get_contents('../data/products.json');
$products = json_decode($json_file, true);

$id = $_GET['id'];

foreach($products as $i => $product) {
    if ($product['id'] == $id) {
        if(!($products[$i]['isActive'])) {
            $products[$i]['isActive'] = true;
        } else {
            $products[$i]['isActive'] = false;
        }
    }
}
file_put_contents('../data/products.json', json_encode($products, JSON_PRETTY_PRINT));
header('Location: /');
