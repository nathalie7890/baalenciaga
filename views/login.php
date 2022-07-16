<?php
$title = "Login";
function get_content() {
?>

<div class="container login">
    <div class="row">
        <div class="col-md-6 mx-auto py-5">
            <form method="POST" action="/controllers/process_login.php">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control rounded-0 border-dark ">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control rounded-0 border-dark">
                </div>
                <button class="btn bg-transparent border-1 border-dark rounded-0">Login</button>
            </form>
        </div>
    </div>
</div>
<?php
}

require_once 'layout.php';
?>