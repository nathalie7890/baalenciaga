<?php
$title = "My Cart";
function get_content() {
    $json_file = file_get_contents('../data/products.json');
    $products = json_decode($json_file, true);

    $cart_json = file_get_contents('../data/carts.json');
    $carts = json_decode($cart_json, true);


    ?>


<div class="container-fluid w-75">
    <?php
        foreach($carts as $i => $cart):
            if(count($cart['items']) > 0):
            if(($_SESSION['user_info']['id']) == $cart['user_id']):
    ?>
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
                    foreach($cart['items'] as  $item):
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;

                ?>
                <tr>
                    <td>
                        <?php echo $item['name']; ?>
                        <?php foreach($products as $key => $product):
                            if($product['id'] == $item['product_id']):
                        ?>
                            <br>
                            <img src="<?php echo $product['image']; ?>" style="height: 200px; width: 200px" class="img-fluid">
                                <?php break; ?>
                            <?php
                            endif;
                            endforeach;
                            ?>
                    </td>
                    <td>$ <?php echo $item['price']?></td>
                    <td>
                        <form method="POST" action="/controllers/process_update_cart.php">
                            <input type="hidden" name="id" value="<?php echo $item['product_id']?>">
                            <input type="hidden" name="user_id" value="<?php echo $cart['user_id']?>">
                            <input min="1" type="number" value="<?php echo $item['quantity']; ?>" name="quantity" class="form-control quantity-input">
                        </form>
                    </td>
                    <td>$ <?php echo $subtotal; ?></td>
                    <td>

                    <!-- delete item from cart -->
                    <button class="btn btn-sm rounded-0 text-danger fs-5" data-bs-toggle="modal" data-bs-target="#delProduct-<?php echo $item['product_id']; ?>"><i class="fa-solid fa-trash-can"></i></button>
                    <div class="modal fade" id="delProduct-<?php echo $item['product_id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <img src=<?php echo $product['image']; ?> class="img-thumbnail p-0">
                                <div class="p-3 text-uppercase">
                                    <h5><?php echo $item['name'] ?></h5>
                                    <p>Are you sure you want to remove this from your cart?</p>
                                </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 p-3">
                                    <button class="btn btn-outline-dark btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                                    <a href="/controllers/process_delete_cart2.php?id=<?php echo $item['product_id']; ?>" class="btn btn-outline-dark btn-sm rounded-0">Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                    <tr>
                        <td colspan="2"></td>
                        <td class="text-end fs-5 fw-bold">
                            Total: $ <?php echo $total; ?>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-dark btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
                            <!-- checkout modal -->
                            <div class="modal fade" id="checkoutModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Checkout</h3>
                                            <input type="hidden" name=total id="total" value="<?php echo $total; ?>">
                                            <h3 class="ms-2">Total $ <?php echo $total; ?></h3>
                                        </div>
                                        <div class="modal-body">
                                            <div id="paypalBtn"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="/controllers/my_process_checkout.php">
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
                            <button class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#emptyCart">Empty Cart</button>
                            <div class="modal fade" id="emptyCart">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h5>Are you sure you want empty your cart?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-dark btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                                            <a href="/controllers/process_empty_cart.php?id=<?php echo $cart['user_id']; ?>" class="btn btn-outline-dark btn-sm rounded-0">Confirm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
            </tbody>
        </table>
    <?php endif;
    else: ?>
    <div class="text-center pb-5">
        <img src="../public/empty_cart.jpg" alt="">
        <br>
        <a href="/" class="text-dark fs-3">GO BACK TO SHOPPING</a>
    </div>
<?php endif; 
endforeach; ?>
</div>




<?php
}
require_once 'layout.php';
?>

<script>
    let quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach( input => {
        input.onkeyup = () => input.parentElement.submit()
        input.onchange = () => input.parentElement.submit()
    });
</script>