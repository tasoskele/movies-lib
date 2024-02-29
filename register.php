<?php 
session_start();

// User already registered. Send him in.
if (isset($_SESSION['user']['id'])) {
  header("Location: index.php");
  exit;
}

$title = 'User Registration';
$page = 'userRegister.php';
require_once('./templates/authLayout.php');
require_once('./inc/db-connection.php');

if (!empty($_POST)) {
  $query = "SELECT COUNT(*) as cnt FROM users WHERE email LIKE(?)";
  $prep = $db_conn->prepare($query);
  $params = [$_POST['email']];
  $prep->execute($params);
  $res = $prep->fetchObject();
  if ($res->cnt > 0) {
    $_SESSION['err'] = 'User already exists.';
    header("Location: register.php");
    exit;
  } else {
    $ins_query = "INSERT INTO users (nickname, email, password) VALUES (?,?,?)";
    $ins_prep = $db_conn->prepare($ins_query);
    $ins_params = [
      $_POST['nickname'], $_POST['email'], 
      password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];
    if ($ins_prep->execute($ins_params)) {
      $_SESSION['msg'] = 'User registered.';
      header("Location: login.php");
    } else {
      $_SESSION['err'] = 'Database error.';
      header("Location: register.php");
    }
  }
}