<?php 
session_start();

// User already registered. Send him in.
if (isset($_SESSION['user']['id'])) {
  header("Location: index.php");
  exit;
}

$title = 'User Login';
$page = 'userLogin.php';
require_once('./templates/authLayout.php');
require_once('./inc/db-connection.php');

if (!empty($_POST)) {
  // tasos@host.com-1234
  // tas1@host.com-1234,
  // nic@host.com-123
  $query = "SELECT id, nickname, email, password, admin FROM users WHERE email LIKE(?)";
  $prep = $db_conn->prepare($query);
  $params = [$_POST['email']];
  $prep->execute($params);
  $res = $prep->fetchObject();
  if (!isset($res->id) ||
      !password_verify($_POST['password'], $res->password)
  ) {
    $_SESSION['err'] = 'Wrong email or password.';
    header("Location: login.php");
    exit;
  }
  // Log user in
  $_SESSION['user']['id'] = $res->id;
  $_SESSION['user']['email'] = $res->email;
  $_SESSION['user']['admin'] = $res->admin;
  $_SESSION['user']['nickname'] = $res->nickname;
  header("Location: index.php");
}