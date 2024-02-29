<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

require_once "inc/db-connection.php";

// Delete Movies ratings
$del_qr = "DELETE FROM movies_ratings WHERE user_id= ? AND movie_id= ?";
$del_prep = $db_conn->prepare($del_qr);
$del_prep->execute([$_SESSION['user']['id'], $_POST['id']]);
// Insert new movie ratings
$ins_query = "INSERT INTO movies_ratings (
  movie_id, user_id, rating, note) 
  VALUES (?,?,?,?)";
$ins_prep = $db_conn->prepare($ins_query);
$ins_params = [$_POST['id'], $_SESSION['user']['id'], $_POST['rating'], $_POST['note']];
if ($ins_prep->execute($ins_params)) {
  $_SESSION['msg'] = 'Movie updated.';
  header("Location: movie-details.php?movie_id=". $_POST['id']);
} else {
  $_SESSION['err'] = 'Database error.';
  header("Location: movie-details.php?movie_id=". $_POST['id']);
}
