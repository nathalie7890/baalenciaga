<?php 
$title = "My Transactions";
function get_content() {
    $products_json_file = file_get_contents('../data/products.json');
    $products = json_decode($products_json_file, true);

    $transactions_json_file = file_get_contents('../data/transactions.json');
    $transactions = json_decode($transactions_json_file, true);

    $transactions = array_filter($transactions, function($transaction) {
        return $transaction['username'] === $_SESSION['user_info']['username'];
    })

?>

<div class="container py-5">
    <?php if(count($transactions) > 0): ?>
        <span class="badge bg-secondary">Pending</span>
        <span class="badge bg-success">Completed</span>
        <span class="badge bg-danger">Canceled</span>

        <div class="accordion py-3">
            <?php foreach($transactions as $transaction): ?>
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

                            <div class="d-flex justify-content-start mt-4">
                            <?php foreach($transaction['items'] as $i => $item): 
                                foreach($products as $product):
                                    if($i == $product['id']):
                                        $subtotal = intval($product['price']) * intval($item);         
                            ?>
                                    <div class="me-2 text-uppercase">
                                        <h6 class="fw-bolder"><?php echo $product['name']; ?></h6>
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
                                <?php if ($transaction['status'] == 'pending' && strlen($transaction['payment']) == 0): ?>
                                    <h6>Upload proof of payment here</h6>
                                    <form method="POST" action="/controllers/process_upload_payment.php" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $transaction['id']; ?>">
                                        <input type="file" name="image" class="form-control  border-dark rounded-0">
                                        <button class="btn btn-sm btn-outline-dark rounded-0 mt-2">Confirm</button>
                                     </form>
                                <?php elseif($transaction['status'] == 'pending' && strlen($transaction['payment']) > 0): ?>
                                    <h6>Payment is pending</h6>
                                    <img src=<?php echo $transaction['payment']?> style="height: 250px; width: 250px" class="img-fluid">

                                <?php elseif($transaction['status'] == 'completed'): ?>
                                    <h6>Order is approved. You will be notified onced your order has been shipped! </h6>
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

