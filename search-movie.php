<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}
require_once('./inc/db-connection.php');

if (!empty($_POST)) {
  $query = "SELECT m.id
    FROM movies m
    LEFT JOIN directors d
    ON d.id = m.director_id
    LEFT JOIN movies_actors ma
    ON m.id = ma.movie_id
    LEFT JOIN actors a
    ON a.id = ma.actor_id
    WHERE m.title LIKE CONCAT ('%',?,'%') OR
          d.name LIKE CONCAT ('%',?,'%') OR
          a.name LIKE CONCAT ('%',?,'%')
    GROUP BY m.id
    ";
  $prep = $db_conn->prepare($query);
  $params = [$_POST['search'], $_POST['search'], $_POST['search']];
  $prep->execute($params);
  $s_movies = '';
  while ($res = $prep->fetchObject()) {
    $s_movies .= $res->id. ',';
  }
  $s_movies = trim($s_movies, ',');
}

$title = 'Search Result';
$page = 'searchMovie.php';
require_once('./templates/layout.php');
