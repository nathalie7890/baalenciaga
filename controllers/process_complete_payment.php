<?php

$json_file = file_get_contents('../data/transactions.json');
$transactions = json_decode($json_file, true);

$product_json = file_get_contents('../data/products.json');
$products = json_decode($product_json, true);

$id = $_GET['id'];

foreach($transactions as $i => $transaction) {
    if($transaction['id'] == $id) {
        echo $transaction['id'];
        echo $transaction['status'];
        $transactions[$i]['status'] = "completed";
        echo $transactions[$i]['status'];
    }
    foreach($transaction['items'] as $key => $item) {
        foreach($products as $j => $product) {
            if($product['id'] == $key){
                var_dump($products[$j]['quantity']);
                $products[$i]['quantity'] -= $item;
                echo $products[$j]['quantity'];
           }
           break;
    }}
}

file_put_contents('../data/transactions.json', json_encode($transactions, JSON_PRETTY_PRINT));
file_put_contents('../data/products.json', json_encode($products, JSON_PRETTY_PRINT));
header("Location: " . $_SERVER["HTTP_REFERER"]);