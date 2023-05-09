<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin") || !has_role("Shop Owner")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

if (isset($_POST["name"]) && isset($_POST["category"]) && isset($_POST["stock"])) {
  $target_dir = "../uploads/";
  $id = se($_GET, "id", "", false);
  $name = se($_POST, "name", "", false);
  $description = se($_POST, "description", "", false);
  $category = se($_POST, "category", "", false);
  $stock = se($_POST, "stock", 0, false);
  $unit_price = se($_POST, "unit_price", 0.00, false);
  $visibilty = isset($_POST['visibilty']) ? 1 : 0;
  $image = $target_dir . basename($_FILES["image"]["name"]);

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
    $image = basename($_FILES["image"]["name"]);
  } else {
    $image = null;
  }

  if (empty($name)) {
      flash("Name is required", "warning");
  } elseif (empty($category)) {
      flash("Category is required", "warning");
  } elseif (empty($stock)) {
      flash("Stock is required", "warning");
  } elseif (empty($unit_price)) {
      flash("Unit price is required", "warning");
  }else {
    if (!empty($image)) {
      $db = getDB();
      $stmt = $db->prepare("UPDATE Products SET image=:image WHERE id=:pid");
      try {
        $stmt->execute([":image" => $image, ":pid" => $id]);
      } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
      }
    }

      $db = getDB();
      $stmt = $db->prepare("UPDATE Products SET name=:name, description=:description, category=:category, stock=:stock, unit_price=:unit_price, visibility=:visibilty WHERE id=:pid");
      try {
          $stmt->execute([":name" => $name, ":description" => $description, ":category" => $category, ":stock" => $stock, ":unit_price" => $unit_price, ":visibilty" => $visibilty, ":pid" => $id]);
          flash("Successfully updated product $name!", "success");
      } catch (PDOException $e) {
          if ($e->errorInfo[1] === 1062) {
              flash("A product with this name already exists, please try another", "warning");
          } else {
              flash(var_export($e->errorInfo, true), "danger");
          }
      }
  }
}

if (isset($_GET["id"])) {
  $id = se($_GET, "id", "", false);

  $query = "SELECT id, name, image, description, category, stock, unit_price, visibility from Products";
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
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>
<h4>Edit Product</h4>
<form  method="POST"  enctype="multipart/form-data">
  <div class="mb-3">
    <label for="name" class="form-lnamenameabel">Name</label>
    <input type="text" value="<?php se($product, "name"); ?>" class="form-control" name="name" id="productName" aria-describedby="ProductNameHelp" required>
    <div id="ProductNameHelp" class="form-text">Product name should be unique.</div>
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image - 
      <span><?php se($product, "image"); ?></span>
      <?php if (empty($product['image'])) : ?>
        <span>No image uploaded</span>
      <?php endif; ?>
    </label>
    <input type="file" name="image" class="form-control" required>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="5" cols="80"><?php echo se($product, "description"); ?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Category</label>
    <input type="text" name="category" value="<?php se($product, "category"); ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" value="<?php se($product, "stock"); ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Unit Price</label>
    <input type="number" name="unit_price" value="<?php se($product, "unit_price"); ?>" class="form-control" min="0.00" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="visibilty" <?php if ($product["visibility"]) {echo 'checked="checked"';} ?> class="form-check-input">
    <label class="form-check-label">Visibility</label>
  </div>
  <button type="submit" class="btn custom-button">Update</button>
</form>
</div>
