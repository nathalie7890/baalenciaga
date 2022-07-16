<?php
    $title;
    function get_content() {

?>
<div class="text-center p-3 nav-shop">SHOP WOMEN | MEN</div>
<section id="login">
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
</section>

        <div class="container-fluid mx-auto p-0">
            <div class="row gy-0 gx-0">

                <?php
                $json_file = file_get_contents('./data/products.json');
                $products = json_decode($json_file, true);
                
                foreach($products as $i => $product):
                ?>

                    <!-- display products -->
                    <div class="col-xxl-3 mx-auto">
                    <div class="card main rounded-0" style="height: 600px" data-id="<?php echo $i ?>" data-product-id="<?php echo $product['id']?>">
                    
                            <img src=<?php echo $product['image']; ?> class="card-img product-img img-fluid" style="height: 600px">
                            

                            <div class="card-img-overlay">
                                <div class="d-flex justify-content-between btnGroup">
                                    <div>
                                        <p class="card-title text-uppercase"><?php echo $product['name']; ?></p>
                                        <p class="card-title fw-bold">$ <?php echo $product['price']; ?></p>
                                        <p class="card-title fw-normal">In stock: <?php echo $product['quantity']; ?></p>
                                    </div>
                                    
                                    <!-- add to cart button for user -->
                                    <div class="d-flex align-items-start btn-group">
                                    <?php if(isset($_SESSION['user_info']) && ($_SESSION['user_info']['isAdmin'])): ?>
                                        
                                        <div class="d-flex justify-content-start flex-column">
        
                                            <!-- edit button -->
                                            <button class="btn btn-transparent btn-sm text-end text-decoration-underline editBtn" data-bs-toggle="modal" data-bs-target="#editProduct-<?php echo $product['id']?>">Edit</button>
                                                <div class="modal fade edit-product" id="editProduct-<?php echo $product['id']?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bold">Edit Product</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="/controllers/process_update_product.php" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                                    <div class="mb-3">
                                                                        <label class="fw-bold fs-6">Name</label>
                                                                        <input type="text" name="name" class="form-control rounded-0 border-dark" value="<?php echo $product['name']; ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="fw-bold fs-6">Price</label>
                                                                        <input type="text" name="price" class="form-control rounded-0 border-dark" value="<?php echo $product['price']; ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="fw-bold fs-6">In stock quantity</label>
                                                                        <input type="text" name="quantity" class="form-control rounded-0 border-dark" value="<?php echo $product['quantity']; ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="fw-bold fs-6">Description</label>
                                                                        <input type="text" name="description" class="form-control  ounded-0 border-dark" value="<?php echo $product['description']; ?>">
                                                                    </div>
                                                                    <div class="mb-5">
                                                                        <label class="fw-bold fs-6">Product Image</label>
                                                                        <input type="file" name="image" class="form-control">
                                                                    </div>
                                                                    <button type="button" class="btn btn-outline-dark btn-sm rounded-0 " data-bs-dismiss="modal">Cancel</button>
                                                                    <button class="btn btn-dark btn-sm rounded-0">Confirm</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            <!-- take down button -->
                                            <?php if(!($product['isActive'])): ?>
                                                <a href="/controllers/process_deactivate_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm text-end fst-italic text-decoration-underline">Activate</a>
                                            <?php else: ?>
                                            <button class="btn btn-transparent btn-sm text-end text-decoration-underline" data-bs-toggle="modal" data-bs-target="#takeDownProduct-<?php echo $product['id']; ?>">Deactivate</button>
                                                <div class="modal fade" id="takeDownProduct-<?php echo $product['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h5><?php echo $product['name'] ?></h5>
                                                                <h6>Are you sure you want to take down this product?</h6>
                                                                <img src=<?php echo $product['image']; ?> class="img-thumbnail">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-outline-dark btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                                                                <a href="/controllers/process_deactivate_product.php?id=<?php echo $product['id']; ?>" class="btn btn-dark btn-sm rounded-0">Confirm</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <!-- delete button -->
                                            <button class="btn btbtn-transparent btn-sm text-end text-decoration-underline" data-bs-toggle="modal" data-bs-target="#delProduct-<?php echo $product['id']; ?>">Delete</button>
                                                <div class="modal fade" id="delProduct-<?php echo $product['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <img src=<?php echo $product['image']; ?> class="img-thumbnail p-0">
                                                            </div>
                                                            <div class="p-3">
                                                                <h5><?php echo $product['name'] ?></h5>
                                                                <h6>Are you sure you want to delete this product?</h6>
                                                                <div class="mt-4">
                                                                    <button class="btn btn-outline-dark btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                                                                    <a href="/controllers/process_delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-dark btn-sm rounded-0">Confirm</a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                    <?php elseif(isset($_SESSION['user_info']) && (!($_SESSION['user_info']['isAdmin']))): 
                                        if(!($product['isActive'])):
                                        ?>
                                        <button class="btn bg-transparent fw-normal btn-sm fw-bold" disabled>Out of Stock</button>
                                        <?php else: ?>
                                            
                                        <button class="btn bg-transparent fs-4" data-bs-toggle="modal" data-bs-target="#addCartProduct-<?php echo $product['id']; ?>"><i class="fa-solid fa-bag-shopping"></i></button>
                                        <?php endif; ?>
                                        <!-- add to cart modal -->
                                            <div class="modal fade" id="addCartProduct-<?php echo $product['id']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <img src=<?php echo $product['image']; ?> class="img-thumbnail p-0">
                                                            <div class="d-flex justify-content-between p-3 text-uppercase fw-bolder">
                                                                <p><?php echo $product['name'] ?></p>
                                                                <p>$ <?php echo $product['price'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="pb-3 px-3 add-product">
                                                        <!-- <form method="POST" action="/controllers/emerson_process_add_cart.php" class="addToCart"> -->
                                                        <form method="POST" action="/controllers/process_add_cart.php" class="addToCart" data-id="<?php echo $i; ?>">
                                                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
                                                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                                            <div class="d-flex justify-content-between">
                                                                    <input type="number" name="quantity" class="form-control quantity border-dark rounded-0" data-id="<?php echo $i; ?>" placeholder="Quantity">
                                                                    <button class="btn btn-outline-dark btn-sm rounded-0 mx-1">Add</button>
                                                                    <button type="button" class="btn btn-outline-dark btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                    </div>
                                        </div>
                                <a href="./views/view_product.php?id=<?php echo $product['id']; ?>" id="view-more" data-id="<?php echo $i ?>" class="card-title view-more p-2 fw-normal" >View More</a>
                                        </div>
                        </div>
                    </div>
                
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
    require_once 'views/layout.php';
?>
