
<?php
require(__DIR__ . "/../../../partials/nav.php");
is_logged_in(true);

if (!has_role("Admin") || !has_role("Shop Owner")) {
  flash("You don't have permission to view this page", "warning");
  die(header("Location: " . get_url("home.php")));
}

if (!isset ($_GET['page']) ) {  
  $page = 1;  
} else {  
  $page = $_GET['page'];  
}
$results_per_page = 8; 
$page_first_result = ($page-1) * $results_per_page; 
$number_of_page = 1;  

$params = array();
$where = array();

$query = "SELECT * from Orders";

// filter by start date
if (isset($_POST['start_date'])) {
  $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
} elseif (isset($_GET['start_date'])) {
  $start_date = $_GET['start_date'];  
} else {
   $start_date = null;
}
if(!empty($start_date)){
  $params[':start_date'] = $start_date;
  $where[] = 'created > :start_date';
}

// filter by end date
if (isset($_POST['start_date'])) {
  $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
} elseif (isset($_GET['start_date'])) {
  $start_date = $_GET['start_date'];  
} else {
   $start_date = null;
}
if(!empty($end_date)){
  $params[':end_date'] = $end_date;
  $where[] = 'created < :end_date';
}

$query .= (sizeof($where) > 0 ? ' WHERE '.implode(' AND ', $where) : '');

$sort = isset($_POST['sort']) ? $_POST['sort'] : 'created';
$direction = isset($_POST['direction']) ? $_POST['direction'] : 'DESC';
$query .= " ORDER BY $sort $direction";

$total = 0;
$orders = [];
$db = getDB();
$stmt = $db->prepare($query);
foreach($params as $k=>$v) $stmt->bindValue($k, $v);
try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $total_orders = $results;
        $number_of_page = ceil(count($total_orders) / $results_per_page); 
    } else {
        flash("No orders found!", "warning");
    }
} catch (Exception $e) {
    flash("An unexpected error occurred, please try again".$e, "danger");
    //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
}

$query .= " LIMIT " . $page_first_result . ',' . $results_per_page;
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
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Total</th>
            <th scope="col">Money received</th>
            <th scope="col">Created</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                    <td><a href="<?php echo get_url('order.php?id='.$order['id']); ?>">#00<?php se($order, "id"); ?></a></td>
                    <td><?php echo $order["first_name"]; ?></td>
                    <td><?php echo $order["last_name"]; ?></td>
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
        <h3 class="cart-total">Total: <?php echo '$'.$total; ?></h3>
    </div>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if ($page != 1 && $number_of_page > 1) : ?>
    <li class="page-item"><a class="page-link" href="<?php echo get_url('orders.php?page='.($page-1).(!empty($start_date) ? '&start_date='.$start_date : '').(!empty($end_date) ? '&end_date='.$end_date : '')); ?>">Previous</a></li>
    <?php endif; ?>
    <?php for($page_no = 1; $page_no<= $number_of_page; $page_no++) : ?>
    <li class="page-item"><a class="page-link" href="<?php echo get_url('orders.php?page='.$page_no.(!empty($start_date) ? '&start_date='.$start_date : '').(!empty($end_date) ? '&end_date='.$end_date : '')); ?>"><?php echo $page_no; ?></a></li>
    <?php endfor; ?>
    <?php if ($page != $number_of_page && $number_of_page > 1) : ?>
    <li class="page-item"><a class="page-link" href="<?php echo get_url('orders.php?page='.($page+1).(!empty($start_date) ? '&start_date='.$start_date : '').(!empty($end_date) ? '&end_date='.$end_date : '')); ?>">Next</a></li>
    <?php endif; ?>
  </ul>
</nav>
</div>
