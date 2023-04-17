<?php
require_once(__DIR__ . "/db.php");
$BASE_PATH = '/Project/';
//require safer_echo.php
require(__DIR__ . "/safer_echo.php");
//TODO 2: filter helpers
require(__DIR__ . "/sanitizers.php");

//TODO 3: User helpers
require(__DIR__ . "/user_helpers.php");
//TODO 4: Flash Message Helpers
if (!$hasError){
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO Users(email, password) VALUES (:email, :password)");
    try{
        $r = $stmt->execute([":email" => $email, ":password" => $hash]);
        echo "Successfully register!";
    }   catch (Exception $e){
            echo "There was an error registering<br>";
            echo "<pre>" . var_export($e, true) . "</pre>";
    }
    
}







?>