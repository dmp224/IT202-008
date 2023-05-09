
<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$order = null;
$order_items = [];
$total = 0;

if (isset($_GET["id"])) {
    $order_id = se($_GET, "id", "", false);

    $db = getDB();
    $stmt = $db->prepare("SELECT * from Orders where id = :id");
    try {
        $stmt->execute([":id" => $order_id]);
        $result = $stmt->fetch();
        if ($result) {
            $order = $result;
            // Get order items
            $stmt = $db->prepare("SELECT Products.name AS name, Products.id AS id, OrderItems.unit_price AS unit_price, OrderItems.quantity AS quantity from OrderItems INNER JOIN Products ON OrderItems.product_id = Products.id where order_id = :id");
            $stmt->execute([":id" => $order_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                $order_items = $results;
                // Calculate total price for Items
                foreach ($order_items as $order_item) {
                    $total += $order_item["unit_price"]*$order_item["quantity"];
                }
            } else {
                flash("No order items found!", "warning");
            }
        } else {
            flash("No match found", "warning");
        }
    } catch (Exception $e) {
        flash("An unexpected error occurred, please try again".$e, "danger");
        //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
    }
}

?>
<div class="page container-fluid">
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<h4>Order details</h4>
<div class="row">
    <div class="col-md-6">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($order_items)) : ?>
                <?php foreach ($order_items as $order_item) : ?>
                    <tr>
                    <td><a href="<?php echo get_url('product.php?id='.$order_item['id']); ?>"><?php se($order_item, "name"); ?></a></td>
                    <td><?php echo '$'.$order_item["unit_price"]; ?></td>
                    <td>
                        <?php echo $order_item["quantity"]; ?>
                    </td>
                    <td><?php echo '$'.$order_item["unit_price"]*$order_item["quantity"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        </table>
        <h3 class="cart-total">Total: <?php echo '$'.$total; ?></h3>
    </div>
    <div class="col-md-6 checkout-form">
        <h5>Personal Info</h5>
        <div class="row">
            <div class="row">
                <div class="col">
                    <p><strong>First name</strong>: <?php se($order, "first_name"); ?></p>                  
                </div>
                <div class="col">
                    <p><strong>Last name</strong>: <?php se($order, "last_name"); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><strong>Payment Method</strong>: <?php se($order, "payment_method"); ?></p>                  
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><strong>Amount</strong>: <?php se($order, "money_received"); ?></p>                  
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><strong>Address</strong>: <?php se($order, "address"); ?></p>                  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
