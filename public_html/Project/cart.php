
<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

if (isset($_POST["quantity_update"])) {
    $product_id = se($_POST, "product_id", "", false);
    $desired_quantity = se($_POST, "desired_quantity", 0, false);
    if (empty($product_id)) {
        flash("Product is required", "warning");
    } elseif ($desired_quantity == 0) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM Cart WHERE (product_id=:product_id AND user_id=:user_id)");
        try {
            $stmt->execute([":product_id" => $product_id, ":user_id" => get_user_id()]);
            flash("Successfully deleted cart product!", "success");
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    } else {
        $db = getDB();
        $stmt = $db->prepare("UPDATE Cart SET desired_quantity=:desired_quantity WHERE (product_id=:product_id AND user_id=:user_id)");
        try {
            $stmt->execute([":desired_quantity" => $desired_quantity, "product_id" => $product_id, ":user_id" => get_user_id()]);
            flash("Successfully updated cart product!", "success");
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    }
}

if (isset($_POST["remove_product"])) {
    $product_id = se($_POST, "product_id", "", false);
    if (empty($product_id)) {
        flash("Product is required", "warning");
    } else {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM Cart WHERE (product_id=:product_id AND user_id=:user_id)");
        try {
            $stmt->execute([":product_id" => $product_id, ":user_id" => get_user_id()]);
            flash("Successfully deleted product from cart!", "success");
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    }
}

if (isset($_POST["clear_cart"])) {
    $db = getDB();
    $stmt = $db->prepare("DELETE FROM Cart WHERE user_id=:user_id");
    try {
        $stmt->execute([":user_id" => get_user_id()]);
        flash("Successfully deleted products from cart!", "success");
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    }
}

$db = getDB();
//select fresh data from table
$stmt = $db->prepare("SELECT * from Cart INNER JOIN Products ON Cart.product_id = Products.id where user_id = :id");
$products = [];
$total = 0;
try {
    $stmt->execute([":id" => get_user_id()]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $products = $results;
        foreach ($products as $product) {
            $total += $product["unit_price"]*$product["desired_quantity"];
        }
    } else {
        flash("No products in cart!", "warning");
    }
} catch (Exception $e) {
    flash("An unexpected error occurred, please try again", "danger");
    //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
}
?>
<div class="page container-fluid">
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<h4>Cart</h4>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Sub Total</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($products)) : ?>
        <?php foreach ($products as $product) : ?>
            <tr>
            <td><a href="<?php echo get_url('product.php?id='.$product['id']); ?>"><?php se($product, "name"); ?></a></td>
            <td><?php echo '$'.$product["unit_price"]; ?></td>
            <td>
                <form method="Post" class="update-product-quantity-form">
                    <input type="text" name="product_id" hidden value="<?php se($product, "product_id"); ?>">
                    <input type="number" name="desired_quantity" min="0" class="cart-item-quantity" required value="<?php se($product, "desired_quantity"); ?>">
                    <input type="submit" name="quantity_update" value="Update">
                </form>
            </td>
            <td><?php echo '$'.$product["unit_price"]*$product["desired_quantity"]; ?></td>
            <td>
                <form method="Post" class="update-product-quantity-form">
                    <input type="text" name="product_id" hidden value="<?php se($product, "product_id"); ?>">
                    <input class="btn btn-danger" type="submit" value="Remove" name="remove_product">
                </form>
            </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
<h3 class="cart-total">Total: <?php echo '$'.$total; ?></h3>
<form method="Post" class="update-product-quantity-form">
    <input class="btn btn-info" type="submit" value="Clear cart" name="clear_cart">
</form>
</div>
