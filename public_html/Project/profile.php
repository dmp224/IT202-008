<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>
<?php
if (isset($_POST["save"])) {
    $email = se($_POST, "email", null, false);
    $username = se($_POST, "username", null, false);
    $visibility = se($_POST, "visibility", null, false);

    $params = [":email" => $email, ":username" => $username, "visibility" => $visibility, ":id" => get_user_id()];
    $db = getDB();
    $stmt = $db->prepare("UPDATE Users set email = :email, username = :username, visibility = :visibility where id = :id");
    try {
        $stmt->execute($params);
        flash("Profile saved", "success");
    } catch (PDOException $e) {
        if ($e->errorInfo[1] === 1062) {
            //https://www.php.net/manual/en/function.preg-match.php
            preg_match("/Users.(\w+)/", $e->errorInfo[2], $matches);
            if (isset($matches[1])) {
                flash("The chosen " . $matches[1] . " is not available.", "warning");
            } else {
                //TODO come up with a nice error message
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            //TODO come up with a nice error message
            echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
        }
    }
    //select fresh data from table
    $stmt = $db->prepare("SELECT id, email, username from Users where id = :id LIMIT 1");
    try {
        $stmt->execute([":id" => get_user_id()]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            //$_SESSION["user"] = $user;
            $_SESSION["user"]["email"] = $user["email"];
            $_SESSION["user"]["username"] = $user["username"];
        } else {
            flash("User doesn't exist", "danger");
        }
    } catch (Exception $e) {
        flash("An unexpected error occurred, please try again", "danger");
        //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
    }


    //check/update password
    $current_password = se($_POST, "currentPassword", null, false);
    $new_password = se($_POST, "newPassword", null, false);
    $confirm_password = se($_POST, "confirmPassword", null, false);
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        if ($new_password === $confirm_password) {
            //TODO validate current
            $stmt = $db->prepare("SELECT password from Users where id = :id");
            try {
                $stmt->execute([":id" => get_user_id()]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if (isset($result["password"])) {
                    if (password_verify($current_password, $result["password"])) {
                        $query = "UPDATE Users set password = :password where id = :id";
                        $stmt = $db->prepare($query);
                        $stmt->execute([
                            ":id" => get_user_id(),
                            ":password" => password_hash($new_password, PASSWORD_BCRYPT)
                        ]);

                        flash("Password reset", "success");
                    } else {
                        flash("Current password is invalid", "warning");
                    }
                }
            } catch (PDOException $e) {
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            flash("New passwords don't match", "warning");
        }
    }
}

?>

<?php
$email = get_user_email();
$username = get_username();
$visibility = get_user_profile_visibility();

$db = getDB();
//select fresh data from table
$stmt = $db->prepare("SELECT Products.name AS name, Products.id AS product_id, Ratings.rating AS rating, Ratings.comment AS comment from Ratings INNER JOIN Products ON Ratings.product_id = Products.id where user_id = :id");
$ratings = [];
try {
    $stmt->execute([":id" => get_user_id()]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $ratings = $results;
    } else {
        flash("No product ratings!", "warning");
    }
} catch (Exception $e) {
    flash("An unexpected error occurred, please try again", "danger");
    //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
}
?>
<div class="page container-fluid">
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>
<div class="row">
<form class="col-md-7" method="POST" onsubmit="return validate(this);">
<h4>Profile</h4>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php se($email); ?>" />
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?php se($username); ?>" />
    </div>
    <div class="mb-3">
        <label for="np" class="form-label">Profile visibilty</label>
        <select class="form-select" aria-label="Default select example" name="visibility">
            <option <?php if ($visibility == 'Public') {echo 'selected';} ?> value="Public">Public</option>
            <option <?php if ($visibility == 'Private') {echo 'selected';} ?> value="Private">Private</option>
        </select>
    </div>
    <!-- DO NOT PRELOAD PASSWORD -->
    <h6>Password Reset</h6>
    <div class="mb-3">
        <label for="cp" class="form-label">Current Password</label>
        <input type="password" class="form-control" name="currentPassword" id="cp" />
    </div>
    <div class="mb-3">
        <label for="np" class="form-label">New Password</label>
        <input type="password" class="form-control" name="newPassword" id="np" />
    </div>
    <div class="mb-3">
        <label for="conp" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="confirmPassword" id="conp" />
    </div>
    <input type="submit" class="btn custom-button" value="Update Profile" name="save" />
</form>
<!-- <hr> -->

<div class="col-md-5">
<h4>My Reviews</h4>
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
            </p>
          </div>
        </div>
      <?php endforeach; ?>
  <?php endif; ?>
</div>
</div>
</div>

<script>
    function validate(form) {
        let pw = form.newPassword.value;
        let con = form.confirmPassword.value;
        let isValid = true;
        //TODO add other client side validation....

        //example of using flash via javascript
        //find the flash container, create a new element, appendChild
        if (!isEqual(pw, con)) {
            flash("Password and Confrim password must match", "warning");
            isValid = false;
        }
        return isValid;
    }
</script>
