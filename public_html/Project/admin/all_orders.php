
<?php
require(__DIR__ . "/../../../partials/nav.php");
is_logged_in(true);

$params = array();
$where = array();

$query = "SELECT * from Orders";

// filter by start date
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
if(!empty($start_date)){
  $params[':start_date'] = $start_date;
  $where[] = 'created > :start_date';
}

// filter by end date
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
if(!empty($end_date)){
  $params[':end_date'] = $end_date;
  $where[] = 'created < :end_date';
}

$query .= (sizeof($where) > 0 ? ' WHERE '.implode(' AND ', $where) : '');

$sort = isset($_POST['sort']) ? $_POST['sort'] : 'created';
$direction = isset($_POST['direction']) ? $_POST['direction'] : 'ASC';
$query .= " ORDER BY $sort $direction LIMIT 10";

$total = 0;
$orders = [];
$db = getDB();
$stmt = $db->prepare($query);
foreach($params as $k=>$v) $stmt->bindValue($k, $v);

try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $orders = $results;
        foreach ($orders as $order) {
            $total += $order["total_price"];
        }
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
require_once(__DIR__ . "/../../../partials/flash.php");
?>
<h4>All Orders</h4>
<form class="row" method="POST">
  <div class="col">
    <input type="datetime-local" class="form-control" name="start_date" placeholder="Start date" aria-label="Name">
  </div>
  <div class="col">
    <input type="datetime-local" class="form-control" name="end_date" placeholder="End date" aria-label="Name">
  </div>
  <div class="col">
    <input type="text" class="form-control" name="category" placeholder="Category" aria-label="Category">
  </div>
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Sort</label>
    <select class="form-select" name="sort" id="autoSizingSelect">
      <option disabled selected>Sort by...</option>
      <option value="total_price" <?php if ($sort == 'total_price') {echo 'selected';} ?>>Total</option>
      <option value="created" <?php if ($sort == 'created') {echo 'selected';} ?>>Date Purchased</option>
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
<div class="row">
    <div class="col-md-12">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Order Number</th>
            <th scope="col">Total</th>
            <th scope="col">Money received</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
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
                    <td><?php echo $order["first_name"]; ?></td>
                    <td><?php echo $order["last_name"]; ?></td>
                    <td><?php echo $order["created"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        </table>
        <h3 class="cart-total">Total: <?php echo '$'.$total; ?></h3>
    </div>
</div>
</div>
