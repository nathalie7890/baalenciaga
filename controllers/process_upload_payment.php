<?php

$json_file = file_get_contents('../data/transactions.json');
$transactions = json_decode($json_file, true);

$id = $_POST['id'];


$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];
$img_type = pathinfo($img_name, PATHINFO_EXTENSION); // jpg, svg, png, gif, jpeg
$is_img = false;

$extensions = ['jpg', 'jpeg', 'svg', 'png', 'gif'];

if(in_array($img_type, $extensions)) {
    $is_img = true;
} else {
    echo "Please upload an image";
}

foreach($transactions as $i => $transaction) {
    if($transaction['id'] == $id) {
        echo $transaction['username'];

        if($is_img && $img_size > 0) {
            $transactions[$i]['payment'] = '/public/'.time().'-'.$img_name;
            move_uploaded_file($img_tmpname, '../public/'.time().'-'.$img_name);
        };
    }
}

file_put_contents('../data/transactions.json', json_encode($transactions, JSON_PRETTY_PRINT));

header("Location: " . $_SERVER["HTTP_REFERER"]);