<?php
$title = "Register";
function get_content() {
?>

<div class="container register">
    <div class="row">
        <div class="col-md-6 mx-auto py-5">
            <form method="POST" action="/controllers/process_register.php">
                <div class="mb-3">
                    <label class="form-label fw-bolder">Fullname</label>
                    <input type="text" name="fullname" class="form-control rounded-0 border-dark" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bolder">Username</label>
                    <input type="text" name="username" class="form-control rounded-0 border-dark" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bolder">Password</label>
                    <input type="password" name="password" class="form-control rounded-0 border-dark">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bolder">Confirm Password</label>
                    <input type="password" name="password2" class="form-control rounded-0 border-dark">
                </div>
                <button class="btn btn-dark rounded-0">Register</button>
            </form>
        </div>
    </div>
</div>
<?php
}

require_once 'layout.php';
?>

