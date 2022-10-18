<?php
require_once "bootstrap.php";

$request = $_SERVER['REQUEST_URI'];

$appPathArray = explode('\\', getcwd());
$appName = strtolower(end($appPathArray));


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
    case '/' . $appName . '/admin':
      require __DIR__ . '/src/views/admin.php';
      break;
    default:
      http_response_code(404);
      require __DIR__ . '/src/views/404.php';
      break;
    }