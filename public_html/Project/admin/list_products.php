
<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

$query = "SELECT id, name, unit_price from Products";
$params = [];
$query .= " WHERE (visibility!=:visibility";
$params =  [":visibility" => ''];

// search by category
if (isset($_POST["category"])) {
  $category = se($_POST, "category", "", false);
  $query .= "category LIKE :category";
  $params += [":category" => "%$category%"];
}

// search by name
if (isset($_POST["name"])) {
  $name = se($_POST, "name", "", false);
  $query .= " AND name LIKE :name";
  $params += [":name" => "%$name%"];
}

// sort products
$sort = 'created';
if (isset($_POST["sort"])) {
  $sort = se($_POST, "sort", "created", false);
}
$query .= ") ORDER BY :sort desc";
$params += [":sort" => "%$sort%"];
$query .= " LIMIT 10";

$db = getDB();
$stmt = $db->prepare($query);
$products = [];
try {
    $stmt->execute($params);
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
    <input type="text" class="form-control" name="name" placeholder="Product name" aria-label="Name">
  </div>
  <div class="col">
    <input type="text" class="form-control" name="category" placeholder="Category" aria-label="Category">
  </div>
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Sort</label>
    <select class="form-select" name="sort" id="autoSizingSelect">
      <option selected>Sort by...</option>
      <option value="unit_price">Unit Price</option>
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
            <h5 class="card-title"><?php se($product, "name"); ?></h5>
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
