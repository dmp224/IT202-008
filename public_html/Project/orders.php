
<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$query = "SELECT * from Orders";
$params = null;
$query .= " WHERE (id>:id";
$params =  [":id" => 1];

// search by start_date
if (isset($_POST["start_date"])) {
  $start_date = se($_POST, "start_date", "", false);
  $query .= " AND created >= :start_date";
  $params += [":start_date" => $start_date];
}

// search by end_date
if (isset($_POST["end_date"])) {
    $end_date = se($_POST, "end_date", "", false);
    $query .= " AND created <= :end_date";
    $params += [":end_date" => $end_date];
  }

// sort products
$sort = 'created';
if (isset($_POST["sort"])) {
  $sort = se($_POST, "sort", "created", false);
}
$query .= ") ORDER BY :sort desc";
$params += [":sort" => $sort];
$query .= " LIMIT 10";

$orders = [];
$db = getDB();
$stmt = $db->prepare($query);
try {
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $orders = $results;
    } else {
        flash("No orders found!", "warning");
    }
} catch (Exception $e) {
    flash("An unexpected error occurred, please try again".$e, "danger");
    //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
}


?>
<div class="page container-fluid">
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<h4>My Orders</h4>
<form class="row" method="POST">
  <div class="col">
    <input type="datetime-local" class="form-control" name="start_date" placeholder="Start date" aria-label="Name">
  </div>
  <div class="col">
    <input type="date" class="form-control" name="end_date" placeholder="End date" aria-label="Name">
  </div>
  <!-- <div class="col">
    <input type="text" class="form-control" name="category" placeholder="Category" aria-label="Category">
  </div> -->
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Sort</label>
    <select class="form-select" name="sort" id="autoSizingSelect">
      <option selected>Sort by...</option>
      <option value="total_price">Total</option>
      <option value="created">Date Purchased</option>
    </select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn custom-button-inv">Search</button>
  </div>
</form>
<br>
<div class="row">
    <div class="col-md-12">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Order Number</th>
            <th scope="col">Total</th>
            <th scope="col">Money recived</th>
            <th scope="col">Created</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                    <td><a href="<?php echo get_url('order.php?id='.$order['id']); ?>">#00<?php se($order, "id"); ?></a></td>
                    <td><?php echo '$'.$order["total_price"]; ?></td>
                    <td>
                        <?php echo '$'.$order["money_received"]; ?>
                    </td>
                    <td><?php echo $order["created"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        </table>
    </div>
</div>
</div>
