<?php
include_once "bootstrap.php";

use Model\Page;
session_start();

$appPathArray = explode('\\', getcwd());
$appName = strtolower(end($appPathArray));
$errorMsg = '';

// Cancel edit page
if (isset($_POST['cancel'])) {
  unset($_GET['add']);
  header('Location: /' . $appName . '/admin');
}

// Add page
if (isset($_POST['add_page'])) {  
    $page = new Page();
    $page->setPageName($_POST['page_name']);
    $page->setPageContent($_POST['page_content']);
    $entityManager->persist($page);
    $entityManager->flush();
    $_SESSION['message'] = 'Page created';
    $_SESSION['message_type'] = 'success';
    header('Location: /' . $appName . '/admin');
    exit();
  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">    

  <title>Add page</title>
</head>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
            <a class="navbar-brand" >
                <h1 style="color: white ;"><b>Mini CMS</b></h1>
                <a style="font-size: 30px; color: #6cb4df; font-weight:700; margin-right: 50px;">Admin panel</a>
            </a>
            <div class="top-nav-placeholder">
                <a class="btn btn-primary" href="./admin">Admin</a>
                <a class="btn btn-primary" href="./home" target="_blank">View website</a>
                <a class="btn btn-danger" href="?action=logout">Logout</a>
            </div>
      </div>
    </nav>
    <div class="container p-4" style="min-height:80.7vh;">
        <div class="row "  style="margin-left: auto; margin-right: auto;">
            <?php
                echo '<h2 style="text-align:center; ">Add new page</h2>
                    <div class="add-page-form-placeholder d-flex justify-content-center">
                        <form action="" method="POST">
                        <label for="add-name">Page name:</label><br>
                        <input type="text" id="add-name" name="page_name" placeholder="page name" required autofocus><br>
                        <label for="add-content">Page content:</label><br>
                        <textarea cols="80" rows="15" id="add-content" name="page_content" placeholder="page content"></textarea><br>
                        <button type="submit" class="btn btn-success" name="add_page">Add page</button>
                        <a class="btn btn-warning" href="./admin">Back</a>
                    </form>
                    </div>';
            ?>
        </div>
    </div>
</body>
</html>