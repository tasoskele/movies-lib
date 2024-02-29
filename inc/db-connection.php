<?php 

$dbstr = "mysql:host=localhost;dbname=moviesdb;";
$dbuser = "";
$pass = "";

try {
  $db_conn = new PDO($dbstr, $dbuser, $pass);
} catch (PDOException $e) {
  http_response_code(500);
  echo 'DB connection failed.';
}
