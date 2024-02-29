<?php 
session_start();
// Authentication
if (!isset($_SESSION['user']['id'])) {
  header("Location: login.php");
  exit;
}

$title = 'My Pop Movie Library';
$page = 'home.php';
require_once('./templates/layout.php');
