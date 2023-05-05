<?php
require_once(__DIR__ . "/../lib/functions.php");
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = true; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "$BASE_PATH",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();


?>
<!-- include css and js files -->
<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<link rel="stylesheet" href="<?php echo get_url('assets/css/bootstrap.min.css'); ?>">
<script src="<?php echo get_url('helpers.js'); ?>"></script>
<script src="<?php echo get_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

<nav class="navbar navbar-expand-md fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo get_url('shop.php'); ?>">Pink Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo get_url('shop.php'); ?>">Shop</a>
        </li>
        <?php if (is_logged_in()) : ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo get_url('home.php'); ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo get_url('profile.php'); ?>">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo get_url('cart.php'); ?>">Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo get_url('orders.php'); ?>">My Orders</a>
        </li>
        <?php endif; ?>
        <?php if (!is_logged_in()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo get_url('login.php'); ?>">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo get_url('register.php'); ?>">Register</a>
        </li>
        <?php endif; ?>
        <?php if (has_role("Shop Owner")) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo get_url('admin/all_orders.php'); ?>">All Orders</a>
        </li>
        <?php endif; ?>
        <?php if (has_role("Admin")) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Roles</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo get_url('admin/create_role.php'); ?>">Create Role</a></li>
              <li><a class="dropdown-item" href="<?php echo get_url('admin/list_roles.php'); ?>">List Roles</a></li>
              <li><a class="dropdown-item" href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a></li>
            </ul>
        </li>
        <?php endif; ?>

        <?php if (has_role("Shop Owner") || has_role("Admin")) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo get_url('admin/create_product.php'); ?>">Create Product</a></li>
              <li><a class="dropdown-item" href="<?php echo get_url('admin/list_products.php'); ?>">List Products</a></li>
            </ul>
        </li>
        <?php endif; ?>
      </ul>
      <div class="d-flex">
        <?php if (is_logged_in()) : ?>
            <a class="logout-link" href="<?php echo get_url('logout.php'); ?>">Logout</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
