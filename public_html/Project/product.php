
<?php
require(__DIR__ . "/../../partials/nav.php");

if (isset($_POST["cart_add"])) {
    is_logged_in(true);
    $product_id = se($_POST, "product_id", "", false);
    $desired_quantity = se($_POST, "desired_quantity", 0, false);
    $unit_price = se($_POST, "unit_price", 0, false);
    if (empty($product_id)) {
        flash("Product is required", "warning");
    } else {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Cart (user_id, product_id, desired_quantity, unit_price) VALUES(:user_id, :product_id, :desired_quantity, :unit_price)");
        try {
            $stmt->execute([":user_id" => get_user_id(), "product_id" => $product_id, ":desired_quantity" => $desired_quantity, ":unit_price" => $unit_price]);
            flash("Successfully added product to cart!", "success");
        } catch (PDOException $e) {
          if ($e->errorInfo[1] === 1062) {
            flash("Product already in cart!", "warning");
          } else {
              flash(var_export($e->errorInfo, true), "danger");
          }
        }
    }
  }
  

if (isset($_GET["id"])) {
    $id = se($_GET, "id", "", false);
  
    $query = "SELECT id, name, description, category, stock, unit_price, visibility from Products";
    $params = [];
    $query .= " WHERE id=:id";
    $params =  [":id" => $id];
      
    $db = getDB();
    $stmt = $db->prepare($query);
    $product = null;
    try {
        $stmt->execute($params);
        $result = $stmt->fetch();
        if ($result) {
            $product = $result;
        } else {
            flash("No match found", "warning");
        }
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    }
      
}
  

?>
<div class="page container-fluid">
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<h4>Product</h4>
<div class="card">
    <img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" class="card-img-top" alt="..." height="300">
    <div class="card-body">
        <h5 class="card-title"><?php se($product, "name"); ?></h5>
        <h6 class="card-subtitle mb-2 product-price">$<?php se($product, "unit_price"); ?></h6>

        <p><strong>Description: </strong><?php se($product, "description"); ?></p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Remaining: <?php se($product, "stock"); ?></li>
            <li class="list-group-item">Category: <?php se($product, "category"); ?></li>
        </ul>
        <?php if (has_role("Admin") || has_role("Shop Owner")) : ?>
        <p class="card-text">
            <a class="btn custom-button" href="<?php echo get_url('admin/edit_product.php?id='.$product['id']); ?>">Edit</a>
        </p>
        <?php endif; ?>
        <?php if (is_logged_in()) : ?>
            <form method="POST">
                <input type="text" name="product_id" hidden value="<?php echo $product['id']; ?>">
                <input type="text" name="unit_price" hidden value="<?php se($product, "unit_price"); ?>">
                <input type="number" min="1" name="desired_quantity" class="form-control" placeholder="Desired Quantity" required value="<?php se($product, "desired_quantity"); ?>">
                <br>
                <input type="submit" class="btn custom-button-inv" name="cart_add" value="Add to cart">
            </form>
        <?php endif; ?>
    </div>
</div>
</div>
