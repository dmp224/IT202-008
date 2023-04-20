<<<<<<< HEAD
=======
<?php
session_start();
require(__DIR__ . "/../../lib/functions.php");
reset_session();

flash("Successfully logged out", "success");
header("Location: login.php");
>>>>>>> 5cbcd433cf04da1b6730dc2d803ff78bd4fe0a30
