<?php
require_once "bootstrap.php";

$request = $_SERVER['REQUEST_URI'];

$appPathArray = explode('\\', getcwd());
$appName = strtolower(end($appPathArray));

if(isset($_GET['id'])){
  $isset = $_GET['id'];
}else{
  $isset = NULL;
}
if(isset($_GET['edit'])){
  $setedit = $_GET['edit'];
}else{
  $setedit = NULL;
}
if(isset($_GET['delete'])){
  $setdelete = $_GET['delete'];
}else{
  $setdelete = NULL;
}

switch ($request) {
  case '/' . $appName . '/':
    require __DIR__ . '/src/views/home.php';
    break;
  case '/' . $appName . '':
    require __DIR__ . '/src/views/home.php';
    break;
  case '/' . $appName . '/home':
    require __DIR__ . '/src/views/home.php';
    break;
  case '/' . $appName . '/home?id=' . $isset:
    require __DIR__ . '/src/views/home.php';
    break;
  case '/' . $appName . '/?id=' . $isset:
    require __DIR__ . '/src/views/home.php';
    break;
  case '/' . $appName . '/admin?action=logout':
    require __DIR__ . '/src/views/admin.php';
    break;
  case '/' . $appName . '/admin':
    require __DIR__ . '/src/views/admin.php';
    break;
  case '/' . $appName . '/admin?edit=' . $setedit:
    require __DIR__ . '/src/views/edit-page.php';
    break;
  case '/' . $appName . '/admin?add':
    require __DIR__ . '/src/views/add-page.php';
    break;
  case '/' . $appName . '/admin?delete=' . $setdelete:
    require __DIR__ . '/src/views/admin.php';
    break;
  default:
    http_response_code(404);
    require __DIR__ . '/src/views/404.php';
    break;
}
