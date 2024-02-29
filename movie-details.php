<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}
require_once('./inc/db-connection.php');

$mv_query = "SELECT m.*, g.name as g_name, d.name as d_name
  FROM movies m
  LEFT JOIN genre g ON g.id = m.genre_id
  LEFT JOIN directors d ON d.id = m.director_id
  WHERE m.id= ?";
$acr_query = "SELECT a.id, a.name 
  FROM movies_actors ma 
  JOIN actors a
  ON ma.actor_id = a.id
  WHERE ma.movie_id= ?";
$params = [$_GET['movie_id']];
$mv_prep = $db_conn->prepare($mv_query);
$mv_prep->execute($params);
$movie = $mv_prep->fetchObject();
$acr_prep = $db_conn->prepare($acr_query);
$acr_prep->execute($params);
$actors = [];
while ($acr_res = $acr_prep->fetchObject()) {
  $actors[] = $acr_res;
}

$title = 'Movie Details';
$page = $_SESSION['user']['admin'] ? 'movieDetailsAdmin.php': 'movieDetails.php';
require_once('./templates/layout.php');