<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">BALENCIAGAa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav d-flex justify-content-between">
        <a class="nav-link" href="/">Home</a>
        
        <!-- Customer -->
        <?php if(!isset($_SESSION['user_info'])): ?>
          <a class="nav-link" href="/views/login.php">Login</a>
          <a class="nav-link" href="/views/register.php">Register</a>
  
        <?php else: ?>
            <?php if(!($_SESSION['user_info']['isAdmin'])): ?>
              <a class="nav-link" href="/views/cart.php">Cart
                <span class="badge bg-secondary">
                  <?php if(!isset($_SESSION['cart'])) {
                    echo "0";
                  } else {
                    echo array_sum($_SESSION['cart']);
                  }
                  ?>
                </span>
              </a>
              <a class="nav-link" href="/views/my_transaction.php">My Transactions</a>
          
          <!-- Admin -->
            <?php else: ?>
              <a class="nav-link" href="/views/all_transaction.php">All Transactions</a>
            <?php endif; ?>
            
            <a class="nav-link" href="/controllers/process_logout.php">Logout</a>
            <a class="nav-link" href="/views/my_cart.php">TestCart</a>
            <?php endif; ?>
            
      </div>
    </div>
        <form class="d-flex ms-auto" method="GET" action="controllers/search_post.php">
          <div class="btn-group">
            <button type="button" class="btn btn-dark" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end text-end">
              <div class="d-flex justify-content-center p-2">
                <input type="text" class="form-control me-2 border-2 border-dark w-75 rounded-0" name="search">
                <button class="btn btn-dark btn-sm rounded-0">Search</button>
              </div>
                
            </div>
            </div>
        </form>
  </div>
</nav>

