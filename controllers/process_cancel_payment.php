<?php

$json_file = file_get_contents('../data/transactions.json');
$transactions = json_decode($json_file, true);

$id = $_GET['id'];

foreach($transactions as $i => $transaction) {
    if($transaction['id'] == $id) {
        $transactions[$i]['status'] = "cancelled";

    }
}

file_put_contents('../data/transactions.json', json_encode($transactions, JSON_PRETTY_PRINT));
header("Location: " . $_SERVER["HTTP_REFERER"]);