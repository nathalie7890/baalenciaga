<?php
$json_file = file_get_contents('../data/users.json');
$users = json_decode($json_file, true);

$cart_json = file_get_contents('../data/carts.json');
$carts = json_decode($cart_json, true);


$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$errors = 0;
$existing = false;


$user = [
    "id" => uniqid(),
    "fullname" => $fullname,
    "username" => $username,
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "isAdmin" => false
];


$cart = [
    "cart_id" => uniqid(),
    "user_id" => $user['id'],
    "username" => $user['username'],
    "items" => [],
    "total" => ""
];

if (strlen($username) < 7) {
    $errors++;
    echo "<h4>Username should be at least 8 characters.</h4>";
} 

if (strlen($password) < 8 || strlen($password2) < 8) {
    $errors++;
    echo "<h4>Password should be at least 8 characters.</h4>";
}

if (strlen($fullname) < 2) {
    $errors++;
    echo "<h4>Fullname should be at least 2 characters.</h4>";
}

if ($password != $password2) {
    $errors++;
    echo "<h4>Password and Confirm Password should match.</h4>";
}


foreach($users as $indiv_user) {
    if ($indiv_user['username'] == $username) {
        $existing = true;
    }
}

if ($existing) {
    $errors++;
    echo "<h4>Username already exists.</h4>";
}

if ($errors > 0) {
    echo "<a href='/views/register.php'>Go back to regitster page</a>";
}

if ($errors == 0 && !$existing) {
    $users[] = $user;
    $carts[] = $cart;
    file_put_contents('../data/users.json', json_encode($users, JSON_PRETTY_PRINT));
    file_put_contents('../data/carts.json', json_encode($carts, JSON_PRETTY_PRINT));
    header('Location: /');
}

?>