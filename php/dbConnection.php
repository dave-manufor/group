<?php
define("DB_SERVER", "drug-dispenser.c5ti90rujcc1.eu-north-1.rds.amazonaws.com:3306");
define("DB_USERNAME", "admin");
define("DB_PASSWORD", "12345678");
define("DB_NAME", "sys");

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// if($mysqli->connect_errno){
//     var_dump("Failed to connect to MySQL: " . $mysqli -> connect_error);
//     exit();
// }else{
//     var_dump("Connected to database");
// }

?>