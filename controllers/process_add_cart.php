<?php 
    $json_file = file_get_contents('../data/carts.json');
    $carts = json_decode($json_file, true);

    $products_json = file_get_contents('../data/products.json');
    $products = json_decode($products_json, true);

    session_start();
    $userId = $_SESSION['user_info']['id'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $subtotal = $quantity * $price;

    $item = [
        "product_id" => $id,
        "name" => $name,
        "price" => $price,
        "quantity" => $quantity,
        "subtotal" => $subtotal,
    ];

    if ($quantity > 0) {
        foreach($carts as $i => $cart) {
            if ($userId == $cart['user_id']) {
                array_push($carts[$i]['items'], $item);
                echo $carts[$i]['items'];
            
            }
        }
    }

        
    



    file_put_contents('../data/carts.json', json_encode($carts, JSON_PRETTY_PRINT));
    file_put_contents('../data/products.json', json_encode($products, JSON_PRETTY_PRINT));

    header('Location: /');
    ?>