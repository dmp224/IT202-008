
<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$products = [];
$order_total = 0;
$db = getDB();

function submitOrder($order_total) {
    $last_order = null;
    $first_name = se($_POST, "first_name", "", false);
    $last_name = se($_POST, "last_name", "", false);
    $payment_method = se($_POST, "payment_method", "", false);
    $money_received = se($_POST, "money_received", 0.00, false);
    $address = se($_POST, "address", "", false);
    $apartment = se($_POST, "apartment", "", false);
    $city = se($_POST, "city", "", false);
    $state = se($_POST, "state", "", false);
    $country = se($_POST, "country", "", false);
    $zip = se($_POST, "zip", "", false);
    $address = $address . ", ". $apartment . ", ". $city . ", ". $state . ", ". $country . ", ". $zip;
    
    // Make an entry into the Orders table
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO Orders (user_id, total_price, address, payment_method, money_received, first_name, last_name) VALUES(:user_id, :total_price, :address, :payment_method, :money_received, :first_name, :last_name)");
    try {
        $stmt->execute([":user_id" => get_user_id(), ":total_price" => $order_total, ":address" => $address, ":payment_method" => $payment_method, ":money_received" => $money_received, ":first_name" => $first_name, ":last_name" => $last_name]);
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
        return false;
    }

    // Get last Order ID from Orders table
    $db = getDB();
    $stmt = $db->prepare("SELECT id FROM Orders where user_id = :id ORDER BY id DESC LIMIT 1");
    try {
        $stmt->execute([":id" => get_user_id()]);
        $last_order = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
        return false;
    }

    if ($last_order == null) {
        return false;
    }
    

    //Copy the cart details into the OrderItems tables with the Order ID from the previous step
    $db = getDB();
    $stmt = $db->prepare("SELECT Products.name AS name, Products.id AS id, Cart.unit_price AS unit_price, Cart.desired_quantity AS desired_quantity, Products.stock AS stock  from Cart INNER JOIN Products ON Cart.product_id = Products.id where user_id = :id");
    $stmt->execute([":id" => get_user_id()]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $products = $results;
    foreach ($products as $product) {
        // Make an entry into the Orders table
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO OrderItems (order_id, product_id, quantity, unit_price) VALUES(:order_id, :product_id, :quantity, :unit_price)");
        try {
            $stmt->execute([":order_id" => $last_order['id'], ":product_id" => $product['id'], ":quantity" => $product['desired_quantity'], ":unit_price" => $product['unit_price']]);
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }

        // Update the Products table Stock for each item to deduct the Ordered Quantity
        $db = getDB();
        $stmt = $db->prepare("UPDATE Products SET stock=:stock WHERE id=:pid");
        $new_stock = $product['stock'] - $product['desired_quantity'];
        try {
            $stmt->execute([":stock" => $new_stock, ":pid" => $product['id']]);
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    }

    // Clear out the user’s cart after successful order
    $db = getDB();
    $stmt = $db->prepare("DELETE FROM Cart WHERE user_id=:user_id");
    try {
        $stmt->execute([":user_id" => get_user_id()]);
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    }

    return $last_order['id'];
}

//select fresh data from table
$stmt = $db->prepare("SELECT Products.name AS name, Products.id AS id, Cart.unit_price AS unit_price, Cart.desired_quantity AS desired_quantity from Cart INNER JOIN Products ON Cart.product_id = Products.id where user_id = :id");
$total = 0;
try {
    $stmt->execute([":id" => get_user_id()]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $products = $results;
        // Calculate Cart Items
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

if (isset($_POST["order"])) {   
    $error = false;

    foreach ($products as $product) {
        $stmt = $db->prepare("SELECT * from Products where id = :id LIMIT 1");
        $stmt->execute([":id" => $product["id"]]);
        $org_product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($org_product) {
            // Verify the current product’s unit_price against the Products table’s unit_price
            if ($org_product["unit_price"] != $product["unit_price"]) {
                $update_stmt = $db->prepare("UPDATE Cart SET unit_price=:unit_price WHERE (product_id=:product_id AND user_id=:user_id)");
                $update_stmt->execute([":unit_price" => $org_product["unit_price"], "product_id" => $product["id"], ":user_id" => get_user_id()]);
                flash($product['name']." price has changed!", "warning");
            }
            // Verify desired product and desired quantity are still available in the Products table
            if($org_product["stock"] < $product["desired_quantity"]) {                
                flash($product['name']." order quantity exceeds current stock which is ". $org_product["stock"]."!", "danger");
                $error = true;
            }

            $order_total += $org_product["unit_price"]*$product["desired_quantity"];
        } else {
            flash($product['name']." not found!", "danger");
            return;
        }
    }

    if ($error == false) {
        $last_order = submitOrder($order_total);
        flash("Order submitted successfully!", "success");
        die(header("Location: order_confirmation.php?id=".$last_order));
    }

}
?>
<div class="page container-fluid">
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<h4>Checkout</h4>
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
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <tr>
                    <td><a href="<?php echo get_url('product.php?id='.$product['id']); ?>"><?php se($product, "name"); ?></a></td>
                    <td><?php echo '$'.$product["unit_price"]; ?></td>
                    <td>
                        <?php echo $product["desired_quantity"]; ?>
                    </td>
                    <td><?php echo '$'.$product["unit_price"]*$product["desired_quantity"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        </table>
        <h3 class="cart-total">Total: <?php echo '$'.$total; ?></h3>
        <a class="btn custom-button-inv" aria-current="page" href="<?php echo get_url('cart.php'); ?>">Cart</a>
    </div>
    <div class="col-md-6 checkout-form">
        <h5>Checkout Form</h5>
        <form method="POST">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="np" class="form-label">First name</label>
                        <input type="text" class="form-control" aria-label="First name" name="first_name">
                    </div>                    
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="np" class="form-label">Last name</label>
                        <input type="text" class="form-control" aria-label="Last name" name="last_name">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">Payment Method</label>
                <select class="form-select" aria-label="Default select example" name="payment_method">
                    <option value="Cash">Cash</option>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="Amex">Amex</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">Amount</label>
                <input type="number" class="form-control" name="money_received"/>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">Address</label>
                <input type="text" class="form-control" name="address"/>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">Apartment, Suite, etc.</label>
                <input type="text" class="form-control" name="apartment"/>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">City</label>
                <input type="text" class="form-control" name="city"/>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">State/Province</label>
                <input type="text" class="form-control" name="state"/>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">Country</label>
                <input type="text" class="form-control" name="country"/>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">Zip/Poastal Code</label>
                <input type="text" class="form-control" name="zip"/>
            </div>
            <input class="btn custom-button" type="submit" value="Order" name="order">
        </form>
    </div>
</div>
</div>
