<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

require_once 'inc/db-connection.php';

$query = "INSERT INTO actors (name) VALUES (?)";
$prep = $db_conn->prepare($query);
$params = [$_POST['name']];
if ($prep->execute($params)) {
  $acr_id = $db_conn->lastInsertId();
  echo json_encode([
    'inserted_id'=> $acr_id,
  ]);
} else {
  http_response_code(500);
  echo json_encode(['error' => 'Database error']);
}
