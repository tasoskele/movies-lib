<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

require_once "inc/db-connection.php";

// Delete movie actors
$del_qr = "DELETE FROM movies_actors WHERE movie_id= ?";
$del_prep = $db_conn->prepare($del_qr);
$del_prep->execute([$_POST['id']]);
// Delete movie ratings
$del_qr = "DELETE FROM movies_ratings WHERE movie_id= ?";
$del_prep = $db_conn->prepare($del_qr);
$del_prep->execute([$_POST['id']]);
// Movie
$query = "DELETE FROM movies WHERE id= ?";
$prep = $db_conn->prepare($query);
$params = [$_POST['id']];
$prep->execute($params);
$_SESSION['msg'] = 'Movie deleted.';
echo json_encode(['msg' => 'ok']);
