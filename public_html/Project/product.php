
<?php
require(__DIR__ . "/../../partials/nav.php");

$ordered_item = false;
$product_rating = null;

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

if (isset($_POST["review_product"])) {
    is_logged_in(true);
    $product_id = se($_POST, "product_id", "", false);
    $comment = se($_POST, "comment", "", false);
    $rating = se($_POST, "rating", 0, false);
    if (empty($product_id)) {
        flash("Product id is required", "warning");
    } else {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Ratings (user_id, product_id, rating, comment) VALUES(:user_id, :product_id, :rating, :comment)");
        try {
            $stmt->execute([":user_id" => get_user_id(), "product_id" => $product_id, ":rating" => $rating, ":comment" => $comment]);

            $stmt_rating = $db->prepare("SELECT AVG(rating) as average_rating from Ratings where product_id = :product_id");
            $stmt_rating->execute([":product_id" => $product_id]);
            $result = $stmt_rating->fetch();
            if ($result) {
                $average_rating = $result['average_rating'];

                $stmt_update = $db->prepare("UPDATE Products SET average_rating=:average_rating WHERE id=:product_id");
                $stmt_update->execute([":average_rating" => $average_rating, ":product_id" => $product_id]);
            } 
            flash("Successfully reviewed product!", "success");
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    }
  }
  

if (isset($_GET["id"])) {
    $id = se($_GET, "id", "", false);
  
    $query = "SELECT id, name, description, category, stock, unit_price, visibility, average_rating from Products";
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

    $db = getDB();
    //select fresh data from table
    $stmt = $db->prepare("SELECT Users.email AS email, Users.visibility AS profile_visibility, Products.name AS name, Products.id AS product_id, Ratings.rating AS rating, Ratings.comment AS comment from Ratings INNER JOIN Products ON Ratings.product_id = Products.id INNER JOIN Users ON Ratings.user_id = Users.id where product_id = :product_id");
    $ratings = [];
    try {
        $stmt->execute([":product_id" => $id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            $ratings = $results;
        } 
    } catch (Exception $e) {
        flash("An unexpected error occurred, please try again", "danger");
        //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
    }

    $db = getDB();
    $stmt = $db->prepare("SELECT Orders.id FROM OrderItems INNER JOIN Orders ON OrderItems.order_id = Orders.id where (Orders.user_id = :user_id && product_id = :product_id) ORDER BY id DESC LIMIT 1");
    try {
        $stmt->execute([":user_id" => get_user_id(), "product_id" => $id]);
        $order_item = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($order_item) {
            $ordered_item = true;
        }
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
        return false;
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
            <li class="list-group-item">Rating: <?php se($product, "average_rating"); ?></li>
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
        <h4>Product Reviews</h4>
        <?php if (empty($ratings)) : ?>
            <p></p>
        <?php else : ?>
            <?php foreach ($ratings as $rating) : ?>
                <div class="card col-md-12">
                <div class="card-body">
                    <h5 class="card-title product-name"><a href="<?php echo get_url('product.php?id='.$rating['product_id']); ?>"><?php se($rating, "name"); ?></a></h5>
                    <p class="card-text">
                        <span><strong>Rating:</strong> <?php se($rating, "rating"); ?></span>
                        <br>
                        <span><strong>Comment:</strong> <?php se($rating, "comment"); ?></span>
                        <br>
                        <?php if ($rating['profile_visibility'] == 'Public') : ?>
                            <span><strong>Rating by:</strong> <?php se($rating, "email"); ?></span>
                            <br>
                        <?php endif; ?>
                    </p>
                </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <br>
        <hr>
        <br>
        <?php if (is_logged_in() && $ordered_item == true) : ?>
        <h4>Review Product</h4>
        <form method="POST">
            <input type="text" name="product_id" hidden value="<?php echo $product['id']; ?>">
            <div class="mb-3">
                <label for="np" class="form-label">Rating</label>
                <select class="form-select" aria-label="Default select example" name="rating">
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="np" class="form-label">Comment</label>
                <textarea name="comment" id="" cols="30" rows="6" class="form-control"></textarea>
            </div>
            <br>
            <input type="submit" class="btn btn-info" name="review_product" value="Submit">
        </form>
        <?php endif; ?>
        <?php if (is_logged_in() && $ordered_item == false) : ?>
            <p>Buy in order to preview</p>
        <?php endif; ?>
    </div>
</div>
</div>
