<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

require_once "inc/db-connection.php";

// Movie
$query = "UPDATE movies SET
  title = ?, description = ?, year = ?, 
  genre_id =?, director_id = ?
  WHERE id= ?";
$prep = $db_conn->prepare($query);
$params = [
  $_POST['title'], $_POST['description'], $_POST['year'], 
  $_POST['genre_id'], $_POST['director_id'], $_POST['id']
];
if ($prep->execute($params)) {
  // Delete movie actors
  $del_qr = "DELETE FROM movies_actors WHERE movie_id= ?";
  $del_prep = $db_conn->prepare($del_qr);
  $del_prep->execute([$_POST['id']]);
  // Insert new movie actors
  $qms = '';
  $act_params = [];
  foreach ($_POST['actors'] as $actor) {
    $qms .= '(?,?),';
    array_push($act_params, $_POST['id'], $actor);
  }
  $qms = trim($qms, ',');
  $act_query = "INSERT INTO movies_actors (
    movie_id, actor_id) VALUES ". $qms;
  $act_prep = $db_conn->prepare($act_query);
  if ($act_prep->execute($act_params)) {
    $_SESSION['msg'] = 'Movie updated.';
    header("Location: movie-details.php?movie_id=". $_POST['id']);
  }
} else {
  $_SESSION['err'] = 'Database error.';
  header("Location: movie-details.php?movie_id=". $_POST['id']);
}
