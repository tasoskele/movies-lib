<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}
require_once('./inc/db-connection.php');

$query = "SELECT m.id, m.title, m.image, AVG(mr.rating) as rate
  FROM movies m 
  LEFT JOIN movies_ratings mr
  ON mr.movie_id = m.id
  GROUP BY m.id
  ORDER BY rate desc";
$prep = $db_conn->prepare($query);
$prep->execute();
$movies = [];
while ($res = $prep->fetchObject()) {
  $movies[] = $res;
}

$title = 'Top Ratings';
$page = 'topRatings.php';
require_once('./templates/layout.php');
