<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

require_once 'inc/db-connection.php';

$query = "INSERT INTO directors (name) VALUES (?)";
$prep = $db_conn->prepare($query);
$params = [$_POST['name']];
if ($prep->execute($params)) {
  $dir_id = $db_conn->lastInsertId();
  echo json_encode([
    'inserted_id'=> $dir_id,
  ]);
} else {
  http_response_code(500);
  echo json_encode(['error' => 'Database error']);
}
