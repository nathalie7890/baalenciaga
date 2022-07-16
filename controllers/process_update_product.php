<?php
session_start();
$json_file = file_get_contents('../data/products.json');
$products = json_decode($json_file, true);

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];

$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];
$img_type = pathinfo($img_name, PATHINFO_EXTENSION); // jpg, svg, png, gif, jpeg
$is_img = false;
$has_details = false;

$extensions = ['jpg', 'jpeg', 'svg', 'png', 'gif'];

echo $id;
echo $img_name;

if(in_array($img_type, $extensions)) {
    $is_img = true;
} else {
    echo "Please upload an image";
}

if(strlen($name) > 0 && strlen($description) > 0 && intval($price) > 0 && intval($quantity) > 0) {
    $has_details = true;
} else {
    echo "Please fill up all input fields!";
}


foreach($products as $i => $product) {
    if ($product['id'] === $id) {
        $products[$i]['name'] = $name;
        $products[$i]['price'] = $price;
        $products[$i]['quantity'] = $quantity;
        $products[$i]['description'] = $description;
        
        if($has_details && $is_img && $img_size > 0) {
            $products[$i]['image'] = '/public/'.time().'-'.$img_name;
            move_uploaded_file($img_tmpname, '../public/'.time().'-'.$img_name);
        };

    }
}

file_put_contents('../data/products.json', json_encode($products, JSON_PRETTY_PRINT));

header('Location: /');
