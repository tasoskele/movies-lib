<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

require_once "inc/db-connection.php";

define ("MAX_SIZE","30000000");

$movie_image = upload_picture();
if ( ! $movie_image) {
  header("Location: create-movie.php");
  exit();
}

// Movie
$query = "INSERT INTO movies (
  title, description, image, year, genre_id, director_id)
  VALUES (?,?,?,?,?,?)";
$prep = $db_conn->prepare($query);
$params = [
  $_POST['title'], $_POST['description'], $movie_image, 
  $_POST['year'], $_POST['genre_id'], $_POST['director_id']
];
if ($prep->execute($params)) {
  // Movie_actors
  $movie_id = $db_conn->lastInsertId();
  $qms = '';
  foreach ($_POST['actors'] as $actor) {
    $qms .= '('. $movie_id. ',?),';
  }
  $qms = trim($qms, ',');
  $act_query = "INSERT INTO movies_actors (
    movie_id, actor_id) VALUES ". $qms;
  $act_prep = $db_conn->prepare($act_query);
  $act_params = $_POST['actors'];
  if ($act_prep->execute($act_params)) {
    $_SESSION['msg'] = 'Movie saved.';
    header("Location: create-movie.php");
  }
} else {
  $_SESSION['err'] = 'Database error.';
  header("Location: create-movie.php");
}

// Upload image file
function upload_picture() {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image = $_FILES['image']['name'];
    $uploadedfile = $_FILES['image']['tmp_name'];
    if ($image) {
      // Filename extension
      $filename = stripslashes($_FILES['image']['name']);
      $extension = pathinfo($filename)['extension'];
      $extension = strtolower($extension);
      if (($extension != 'jpg') && 
        ($extension != 'jpeg') && 
        ($extension != 'png') && 
        ($extension != 'gif')
      ) {
        $_SESSION['err'] = 'Unknown Image extension.';
        return false;
      }
      // File size
      $size=filesize($_FILES['image']['tmp_name']);
      if ($size > MAX_SIZE * 1024) {
        $_SESSION['err'] = 'You have exceeded the image size limit!';
        return false;
      }
      // OK
      $uploadedfile = $_FILES['image']['tmp_name'];
      $filename = "uploaded-img/". $_FILES['image']['name'];
      move_uploaded_file($uploadedfile, $filename);
      return $filename;
    }
    $_SESSION['err'] = 'No image selected.';
    return false;
  }
  $_SESSION['err'] = 'Upload error.';
  return false;
}