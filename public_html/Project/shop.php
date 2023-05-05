
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

$params = array();
$where = array();
$query = "SELECT id, name, unit_price from Products";

// search by category
$category = isset($_POST['category']) ? $_POST['category'] : null;
if(!empty($category)){
  $params[':category'] = $category;
  $where[] = 'category = :category';
}

// search by name
$name = isset($_POST['name']) ? $_POST['name'] : null;
if(!empty($name)){
  $params[':name'] = "%$name%";
  $where[] = 'name LIKE :name';
}

// sort products
$query .= (sizeof($where) > 0 ? ' WHERE '.implode(' AND ', $where) : '');

$sort = isset($_POST['sort']) ? $_POST['sort'] : 'created';
$direction = isset($_POST['direction']) ? $_POST['direction'] : 'ASC';
$query .= " ORDER BY $sort $direction LIMIT 10";

$products = [];
$db = getDB();
$stmt = $db->prepare($query);
foreach($params as $k=>$v) $stmt->bindValue($k, $v);

try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $products = $results;
    } else {
        flash("No matches found", "warning");
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}

?>
<div class="page container-fluid">
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<h4>Products</h4>
<form class="row" method="POST">
  <div class="col">
    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Product name" aria-label="Name">
  </div>
  <div class="col">
    <input type="text" class="form-control" name="category" value="<?php echo $category; ?>" placeholder="Category" aria-label="Category">
  </div>
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Sort</label>
    <select class="form-select" name="sort" id="autoSizingSelect">
      <option disabled selected>Sort by...</option>
      <option value="unit_price" <?php if ($sort == 'unit_price') {echo 'selected';} ?>>Price</option>
    </select>
  </div>
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Direction</label>
    <select class="form-select" name="direction" id="autoSizingSelect">
      <option disabled selected>Sort...</option>
      <option value="ASC" <?php if ($direction == 'ASC') {echo 'selected';} ?>>Asc</option>
      <option value="DESC" <?php if ($direction == 'DESC') {echo 'selected';} ?>>Desc</option>
    </select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn custom-button-inv">Search</button>
  </div>
</form>
<br>
<div class="row products">
  <?php if (empty($products)) : ?>
    <p>No products found!</p>
  <?php else : ?>
      <?php foreach ($products as $product) : ?>
        <div class="card product">
          <img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title product-name"><a href="<?php echo get_url('product.php?id='.$product['id']); ?>"><?php se($product, "name"); ?></a></h5>
            <h6 class="card-subtitle mb-2 product-price">$<?php se($product, "unit_price"); ?></h6>
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
      <?php endforeach; ?>
  <?php endif; ?>
</div>
</div>
