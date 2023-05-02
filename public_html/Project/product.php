
<?php
require(__DIR__ . "/../../partials/nav.php");

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
    </div>
</div>
</div>
