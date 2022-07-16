<nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">BAALENCIAGA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <div class="navbar-nav me-auto mb-2 mb-lg-0">
      <a class="nav-link active" href="\">HOME</a>
  
  <!-- <a class="nav-link" href="/views/my_cart.php">TEST CART</a> -->

  <!-- not an admin -->
  <?php if(isset($_SESSION['user_info']) && (!($_SESSION['user_info']['isAdmin']))): ?>
      <a class="nav-link" href="/views/my_cart.php">CART</a>
      <a class="nav-link" href="/views/my_transaction.php">MY TRANSACTIONS</a>

  <!-- admin -->
  <?php elseif(isset($_SESSION['user_info']) && $_SESSION['user_info']['isAdmin']): ?>
      <a class="nav-link" href="/views/all_transaction.php">ALL TRANSACTIONS</a>
      <a class="nav-link" href="add-product" onclick="return addProduct()">ADD PRODUCT</a>
      
  <?php endif; ?>
    </div>
      <div class="d-flex left-nav">
      <?php if(!(isset($_SESSION['user_info']))): ?>
        <a class="nav-link text-secondary" href="login" onclick="return login()">LOGIN</a>
        <a class="nav-link text-secondary" href="/views/register.php" onclick="return register()">REGISTER</a>
    <?php elseif($_SESSION['user_info']['isAdmin']): ?>
        <a class="nav-link text-dark nav-username" disabled><?php echo $_SESSION['user_info']['username']." (ADMIN)"; ?> |</a>
        <a class="nav-link text-secondary" href="/controllers/process_logout.php">LOGOUT</a>
    <?php else: ?>
        <a class="nav-link text-dark nav-username" disabled><?php echo $_SESSION['user_info']['username']; ?> |</a>
        <a class="nav-link text-secondary" href="/controllers/process_logout.php">LOGOUT</a>
    <?php endif; ?>
          <button class="btn btn-light bg-transparent" onclick="searchBtn()"><i class="fa-solid fa-magnifying-glass"></i></button>

  </div>
    </div>
  </div>
</nav>

<div class="container-fluid w-75 searchBar mb-4 pt-5" style="display: none">
<form method="GET" action="/controllers/process_search_product.php">
    <input type="text" style="width: 100%" placeholder="SEARCH HERE" name="search">
    <button class="btn btn-sm border-dark border-1 rounded-0 my-2">SEARCH</button>
</form>
    <div class="fst-italic mt-5">
        <p class="text-decoration-underline">POPULAR SEARCHES</p>
        <P>MEN'S SHOES</P>
        <P>FW2022 WOMEN</P>
        <P>DEFENDER</P>
        <P>XX SERIES</P>
    </div>
</div>

    <div class="container-fluid login mb-4" style="display: none">
        <div class="row">
            <div class="col-md-6 mx-auto py-5">
                <form method="POST" action="/controllers/process_login.php">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control rounded-0 border-dark">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control rounded-0">
                    </div>
                    <button class="btn bg-transparent border-1 border-dark rounded-0">Login</button>
                </form>
            </div>
        </div>
    </div>


<div class="container-fluid register mb-4" style="display: none">
<div class="row">
        <div class="col-md-6 mx-auto py-5">
            <form method="POST" action="/controllers/process_register.php">
                <div class="mb-3">
                    <label class="form-label">Fullname</label>
                    <input type="text" name="fullname" class="form-control rounded-0 border-dark">
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control rounded-0 border-dark">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control rounded-0 border-dark">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password2" class="form-control  rounded-0 border-dark">
                </div>
                <button class="btn bg-transparent border-1 border-dark  rounded-0">Register</button>
            </form>
        </div>
    </div>
</div>


<div class="container addProduct" id="addProduct" style="display:none">
    <form method="POST" action="/controllers/process_add_product.php" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="form-group">
                    <label  class="form-label">NAME</label>
                    <input type="text" name="name" class="form-control rounded-0" autofocus>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label  class="form-label">PRICE</label>
                    <input type="number" name="price" step="0.01" class="form-control rounded-0">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="form-label">Description</label>
                    <input type="text" name="description" class="form-control rounded-0">
                </div>
            </div>
        </div> 
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label  class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control rounded-0">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control rounded-0">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-3">
                <div class="col-md-6">
                    <button class="btn b btn-sm bg-transparent border-dark border-1 text-dark rounded-0 p-2"">ADD PRODUCT</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>


