<?php
define("DB_SERVER", "localhost:3306");
define("DB_USERNAME", "admin");
define("DB_PASSWORD", "12345678");
define("DB_NAME", "drugdb");

$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

?>
