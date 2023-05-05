
<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

$params = array();
$where = array();
$query = "SELECT id, name, unit_price from Products";

// search by stock
if(isset($_POST["out_of_stock"])) {
  $params[':stock'] = 1;
  $where[] = 'stock < :stock';
}

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
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
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
      <option value="created" <?php if ($sort == 'created') {echo 'selected';} ?>>Created</option>
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
<form class="row" method="POST">
  <div class="col-auto">
    <button type="submit" class="btn custom-button" name="out_of_stock">Out of Stock</button>
  </div>
</form>
<br>
<br>
<div class="row products">
  <?php if (empty($products)) : ?>
    <p>No products found!</p>
  <?php else : ?>
      <?php foreach ($products as $product) : ?>
        <div class="card product">
          <img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title product-name"><?php se($product, "name"); ?></h5>
            <h6 class="card-subtitle mb-2 product-price">$<?php se($product, "unit_price"); ?></h6>
            <p class="card-text">
              <a class="btn custom-button" href="<?php echo get_url('admin/edit_product.php?id='.$product['id']); ?>">Edit</a>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
  <?php endif; ?>
</div>
</div>
