<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

require_once "./inc/db-connection.php";

// Actors
$query = "SELECT id, name FROM actors";
$prep = $db_conn->prepare($query);
if ($prep->execute()) {
  while ($result = $prep->fetch(PDO::FETCH_OBJ)) {
    $actors_arr[] = $result; 
  }
} else {
  // die('500: Server error');
  http_response_code(500);
  echo "<h3>Database error</h3>";
}

// Genres
$query = "SELECT id, name FROM genre";
$prep = $db_conn->prepare($query);
if ($prep->execute()) {
  while ($result = $prep->fetch(PDO::FETCH_OBJ)) {
    $genres_arr[] = $result; 
  }
} else {
  http_response_code(500);
  echo "<h3>Database error</h3>";
}

// Directors
$query = "SELECT id, name FROM directors";
$prep = $db_conn->prepare($query);
if ($prep->execute()) {
  while ($result = $prep->fetch(PDO::FETCH_OBJ)) {
    $directors_arr[] = $result; 
  }
} else {
  http_response_code(500);
  echo "<h3>Database error</h3>";
}

$title = 'Create a Movie';
$page = 'createMovie.php';
require_once('./templates/layout.php');
