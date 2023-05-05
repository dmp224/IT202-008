
<?php
require(__DIR__ . "/../../../partials/nav.php");
is_logged_in(true);

$orders = [];
$db = getDB();
$stmt = $db->prepare("SELECT * from Orders ORDER BY id DESC LIMIT 10");
try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $orders = $results;
    } else {
        flash("No orders found!", "warning");
    }
} catch (Exception $e) {
    flash("An unexpected error occurred, please try again".$e, "danger");
    //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
}


?>
<div class="page container-fluid">
<?php
require_once(__DIR__ . "/../../../partials/flash.php");
?>
<h4>All Orders</h4>
<div class="row">
    <div class="col-md-12">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Order Number</th>
            <th scope="col">Total</th>
            <th scope="col">Money received</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Created</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                    <td><a href="<?php echo get_url('order.php?id='.$order['id']); ?>">#00<?php se($order, "id"); ?></a></td>
                    <td><?php echo '$'.$order["total_price"]; ?></td>
                    <td>
                        <?php echo '$'.$order["money_received"]; ?>
                    </td>
                    <td><?php echo $order["first_name"]; ?></td>
                    <td><?php echo $order["last_name"]; ?></td>
                    <td><?php echo $order["created"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        </table>
    </div>
</div>
</div>
