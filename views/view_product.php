<?php
function get_content() {
$json_file = file_get_contents('../data/products.json');
$products = json_decode($json_file, true);

$id = $_GET['id'];
foreach($products as $i => $product):
    if($product['id'] == $id):
?>

<div class="card mb-3">
  <div class="row">
    <div class="col-md-5">
      <img src=<?php echo $products[$i]['image']?> class="view-product-image card-img" style="height:650px; width: 660px">
    </div>
    <div class="col-md-7">
      <div class="card-body p-5">
        <h5 class="card-title fs-3 fw-bold mb-5"><?php echo $product['name']?></h5>
        <h6>Description:</h6>
        <p class="card-text"><?php echo $product['description']; ?></p>
        <?php if(!($product['isActive'])): ?>
                                        <button class="btn bg-transparent fw-normal btn-sm fw-bold" disabled>Out of Stock</button>
                                        <?php else: ?>
                                            
                                        <button class="btn btn-sm btn-outline-dark rounded-0 mt-2" data-bs-toggle="modal" data-bs-target="#addCartProduct-<?php echo $product['id']; ?>">Add To Cart</button>
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
      </div>
    </div>
  </div>
</div>
<?php
endif;
endforeach;
}
require_once 'layout.php';

?>