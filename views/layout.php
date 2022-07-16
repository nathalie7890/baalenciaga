<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1546ce94aa.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      .btn:focus {
        outline: none;
        border: none;
        box-shadow: none;
      }

      .navbar {
        border-bottom: 1.5px solid black;
      }

      .navbar-nav {
        font-size: 0.85rem;      
      }

      .left-nav {
        font-size: 0.85em;
      }

      .nav-username {
        text-transform: uppercase;
      }

      .nav-shop {
        font-size: 0.85rem;
      }

      .addProduct input, .login input, .searchBar input, .register input, .add-product input, .payment input,.edit-product input{
        border: none;
        border-bottom: 2px solid black;
      }

      .form-label {
        font-size: 0.85rem;
        text-transform: uppercase;
      }
      .form-control:focus {
        border: none;
        border-bottom: 2px solid black;
        outline: none;
        box-shadow: none;
      }

      .searchBar input:focus {
        border: none;
        box-shadow: none;
        outline: none;
      }

      .searchBar p {
        font-size: 0.8rem;
        line-height: 0.5rem;
      }
      .main {
        border: 1px solid grey;
      }

      .main:hover {
        position: relative;
      }
      
      .main .card-title {
        font-size: 0.85rem;
        font-weight: 750;
        z-index: 1;
      }
      .product-img {
        object-fit: cover;
      }

      .view-more {
        position: absolute;
        top: 90%;
        left: 50%;
        transform: translate( -50%, -50% );
        text-align: center;
        color: black;
        border: 1px solid black;
        display: none;

      }

      .swal-text {
        color: black;
        font-weight: 600;
      }

      .swal-button {
        color: black;
        background-color: white;
        border: 1px solid black;
        border-radius: 0;
      }
    

    </style>
    <title>ECOM <?php echo $title; ?></title>

  </head>
  <body>
    <?php session_start(); ?>
    <?php require_once 'template/nav.php'; ?>

    <main>
        <?php get_content(); ?>
    </main>
    <?php
        include_once 'template/footer.php';
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>

<script>
  //validate add to cart quantity, at least 1
  let add = document.querySelectorAll('.addToCart');
  let quantity = document.querySelectorAll('.quantity');

  for (let i = 0; i < add.length; i++) {
    for (let j = 0; j < quantity.length; j++) {
      if (add[i].getAttribute('data-id')  == quantity[j].getAttribute('data-id')) {
        add[i].addEventListener('submit', e => {
        e.preventDefault();
        if(quantity[j].value <= 0) {
            swal("Quantity must be at least 1", {
                button: false
            });
            return false;
        } else {
            add[i].submit();
        }
    })
      }
    }
  }
    
  //product image on hover
  let main = document.querySelectorAll('.main');
  let viewMore = document.querySelectorAll('.view-more');

  for (let i = 0; i < main.length; i++) {
    for (let j = 0; j < viewMore.length; j++) {
      if (main[i].getAttribute('data-id') == viewMore[i].getAttribute('data-id')) {
        main[i].onmouseover = () => {
          viewMore[i].style.display = "block";
        }
        main[i].onmouseout = () => {
          viewMore[i].style.display = "none";
          main[i].style.opacity = '1';
        }
        // main[i].onclick = () => {
        //   location.href = `./views/view_product.php?id=${main[i].getAttribute('data-product-id')}`;
        // }
      }
    }
  }



  //add product form
  let addProduct = () => {
    let addProduct = document.getElementById('addProduct');
    if (addProduct.style.display == 'none') {
      addProduct.style.display = 'block'
    } else {
      addProduct.style.display = "none";
    }
    return false;
  }

  //search form
  let searchBtn = () => {
    let searchBar = document.querySelector('.searchBar');
    if (searchBar.style.display == 'none') {
      searchBar.style.display = 'block';
      document.querySelector('.login').style.display = 'none';
      document.querySelector('.register').style.display = 'none';
    } else {
      searchBar.style.display = "none";
    }
  }
  
  //display login form
  let login = () => {
    let login = document.querySelector('.login');
    if (login.style.display == 'none') {
      login.style.display = 'block';
      document.querySelector('.register').style.display = 'none';
      searchBar = document.querySelector('.searchBar').style.display = 'none';
    } else {
      login.style.display = "none";
    }

    return false;
  }

  //register form
  let register = () => {
    let register = document.querySelector('.register');
    if (register.style.display == 'none') {
      register.style.display = 'block';
      document.querySelector('.login').style.display = 'none';
      searchBar = document.querySelector('.searchBar').style.display = 'none';
    } else {
      register.style.display = "none";
    }

    return false;
  }
</script>