<?php
$user = "root";
$pass = "";

try {
    $db = new pdo("mysql:host=localhost;dbname=biblio", $user, $pass);
} catch(Exception $e) {
    echo "Error: Check the config.php file.";
}
?>