<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}
require_once('./inc/db-connection.php');
  
$query = "SELECT m.id, m.title, m.image, (
    SELECT mr.rating FROM movies_ratings mr
    WHERE mr.movie_id = m.id AND mr.user_id = ?
  ) as rate
  FROM movies m 
  ORDER BY rate desc
";
$prep = $db_conn->prepare($query);
$params = [$_SESSION['user']['id']];
$prep->execute($params);
$movies = [];
while ($res = $prep->fetchObject()) {
  $movies[] = $res;
}
 
$title = 'My Ratings';
$page = 'myRatings.php';
require_once('./templates/layout.php');
