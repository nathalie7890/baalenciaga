<?php
$json_file = file_get_contents('../data/users.json');
$users = json_decode($json_file, true);
$username = $_POST['username'];
$password = $_POST['password'];

foreach ($users as $user) {
    if($user['username'] == $username && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_info'] = $user;
        $_SESSION['class'] = "secondary-outline";
        header('Location: /');
    }
}

echo "<h1>Wrong Credentials</h1>";
echo "<a href='/views/login.php'>Go back to Login</a>";
?>

