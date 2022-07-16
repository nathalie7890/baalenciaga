<?php 
$title = "My Transactions";
function get_content() {

    $products_json_file = file_get_contents('../data/products.json');
    $products = json_decode($products_json_file, true);

    $transactions_json_file = file_get_contents('../data/transactions.json');
    $transactions = json_decode($transactions_json_file, true);
?>

<div class="container py-5">
<?php if(count($transactions) > 0): ?>
    <span class="badge bg-secondary">Pending</span>
    <span class="badge bg-success">Completed</span>
    <span class="badge bg-danger">Canceled</span>

    <div class="accordion py-3">
            <?php foreach($transactions as $key => $transaction): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <?php $status;
                            if ($transaction['status'] == 'pending') $status = "#abafb8";
                            else if ($transaction['status'] =='completed') $status = "#bcf5d8";
                            else $status = "#edb4d0";
                        ?> 
                        <button class="accordion-button" style="background-color:<?php echo $status ?>" data-bs-toggle="collapse" data-bs-target="#tc-<?php echo $transaction['id']; ?>">
                            <h5 class="text-dark">ID: <?php echo $transaction['id']; ?></h5>
                            <h5 class="text-dark">Date: <?php echo $transaction['datePurchased']; ?></h5>
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse show" id="tc-<?php echo $transaction['id']; ?>">
                        <div class="accordion-body">

                        <h5 class="fw-bolder">TOTAL $ <?php echo $transaction['total']; ?></h5>

                            <div class="d-flex justify-content-start">
                            <?php foreach($transaction['items'] as $i => $item): 
                                foreach($products as $product):
                                    if($i == $product['id']):
                                        $subtotal = intval($product['price']) * intval($item);         
                            ?>
                                    <div class="me-2 text-uppercase">
                                        <h6><?php echo $product['name']; ?></h6>
                                        <p>Product Id: <?php echo $product['id']; ?></p>
                                        <p>Quantity: <?php echo $item; ?></p>
                                        <p>Subtotal: <?php echo $subtotal ?></p>
                                        <img src=<?php echo $product['image']; ?> class="img-fluid" style="height: 300px; width: 300px">
                                    </div>
                            <?php 
                            endif;
                            endforeach; 
                            endforeach;
                            ?>

                            </div>
                                <div class="my-5 w-25 payment">
                                    <?php if($transaction['status'] == 'pending' && strlen($transaction['payment']) > 0): ?>
                                        <h6>Prove of payment: </h6>
                                        <img src=<?php echo $transactions[$key]['payment']; ?> style="height: 300px; width: 300px" class="mb-4">
                                        <a href="/controllers/process_complete_payment.php?id=<?php echo $transaction['id']; ?>" class="btn btn-outline-dark btn-sm rounded-0">Complete</a>
                                        <a href="/controllers/process_cancel_payment.php?id=<?php echo $transaction['id']; ?>" class="btn btn-outline-dark btn-sm rounded-0">Cancel</a>
                                    <?php elseif($transaction['status'] == 'pending' && strlen($transaction['payment']) == 0): ?>
                                        <a href="/controllers/process_complete_payment.php?id=<?php echo $transaction['id']; ?>" class="btn btn-outline-dark btn-sm rounded-0">Complete</a>
                                        <a href="/controllers/process_cancel_payment.php?id=<?php echo $transaction['id']; ?>" class="btn btn-outline-dark btn-sm rounded-0">Cancel</a>
                                    <?php endif; ?>
                                </div>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <h2>No Transactions Found</h2>
        <a href="/">Go back to Homepage</a>
    <?php endif; ?>

</div>

<?php 
}
require_once 'layout.php';
?>