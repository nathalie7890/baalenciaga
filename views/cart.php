<?php
$title = "My Cart";
function get_content() {
    $json_file = file_get_contents('../data/products.json');
    $products = json_decode($json_file, true);
?>

<div class="container-fluid">
    <?php if(isset($_SESSION['cart'])): ?>
        <h2 class="text-center fst-italic fw-bolder">My Cart</h2>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    foreach($products as $i => $product):
                        if(isset($_SESSION['cart'][$product['id']])):
                            $subtotal = $product['price'] * $_SESSION['cart'][$product['id']];
                            $total += $subtotal;
                            ?>
                <tr>
                    <td><?php echo $product['name']?></td>
                    <td>$ <?php echo $product['price']?></td>
                    <td>
                        <form method="POST" action="/controllers/process_update_cart.php">
                            <input type="hidden" name="id" value="<?php echo $product['id']?>">
                            <input min="1" type="number" value="<?php echo $_SESSION['cart'][$product['id']]; ?>" name="quantity" class="form-control quantity-input">
                        </form>
                    </td>
                    <td>$ <?php echo $subtotal; ?></td>
                    <td>
                    <button class="btn btn-dark btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#delProduct-<?php echo $product['id']; ?>">Delete</button>
                    <div class="modal fade" id="delProduct-<?php echo $product['id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5><?php echo $product['name'] ?></h5>
                                    <h6>Are you sure you want to remove this from your cart?</h6>
                                    <img src=<?php echo $product['image']; ?> class="img-thumbnail">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-dark btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                                    <a href="/controllers/process_delete_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-dark btn-sm rounded-0">Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </td>
                </tr>
                <?php 
                    endif;
                    endforeach; ?>
                    <tr>
                        <td colspan="2"></td>
                        <td>
                            <button class="btn btn-sm btn-dark rounded-0" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
                            <!-- checkout modal -->
                            <div class="modal fade" id="checkoutModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Checkout</h5>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Total $ <?php echo $total; ?></h3>
                                            <p>Are you sure you want to checkout?</p>

                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="/controllers/process_checkout.php">
                                                <input type="hidden" name=total value="<?php echo $total; ?>">
                                                <button class="btn btn-sm btn-dark rounded-0">Confirm</button>
                                                <button class="btn btn-sm btn-dark rounded-0" type="button" data-bs-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            Total: <strong>$ <?php echo $total; ?></strong>
                        </td>
                        <td>
                            <a>Empty Cart</a>
                        </td>
                    </tr>
            </tbody>
        </table>
    <?php else: ?>
        <h2 class="fw-bolder text-center">YOUR CART IS EMPTY!</h2>
        <a href="/" class="text-center">GO BACK TO SHOPPING!</a>
    <?php endif; ?>
</div>



<?php
}
require_once 'layout.php';
?>

