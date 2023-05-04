<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin") || !has_role("Shop Owner")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

if (isset($_POST["name"]) && isset($_POST["category"]) && isset($_POST["stock"])) {
    $name = se($_POST, "name", "", false);
    $description = se($_POST, "description", "", false);
    $category = se($_POST, "category", "", false);
    $stock = se($_POST, "stock", 0, false);
    $unit_price = se($_POST, "unit_price", 0.00, false);
    $visibility = isset($_POST['visibility']) ? 1 : 0;

    if (empty($name)) {
        flash("Name is required", "warning");
    } elseif (empty($category)) {
        flash("Category is required", "warning");
    } elseif (empty($stock)) {
        flash("Stock is required", "warning");
    } elseif (empty($unit_price)) {
        flash("Unit price is required", "warning");
    }else {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Products (name, description, category, stock, unit_price, visibility) VALUES(:name, :description, :category, :stock, :unit_price, :visibility)");
        try {
            $stmt->execute([":name" => $name, ":description" => $description, ":category" => $category, ":stock" => $stock, ":unit_price" => $unit_price, ":visibility" => $visibility]);
            flash("Successfully created product $name!", "success");
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                flash("A product with this name already exists, please try another", "warning");
            } else {
                flash(var_export($e->errorInfo, true), "danger");
            }
        }
    }
}
?>

<div class="page container-fluid">
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>
<h4>Create Product</h4>
<form  method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="productName" aria-describedby="ProductNameHelp" required>
    <div id="ProductNameHelp" class="form-text">Product name should be unique.</div>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="5" cols="80"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Category</label>
    <input type="text" name="category" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Unit Price</label>
    <input type="number" name="unit_price" class="form-control" min="0.00" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="visibility" class="form-check-input">
    <label class="form-check-label">Visibility</label>
  </div>
  <button type="submit" class="btn custom-button">Submit</button>
</form>
</div>
