<?php
include_once "bootstrap.php";
session_start();

$appPathArray = explode('\\', getcwd());
$appName = strtolower(end($appPathArray));

// Edit page
if (isset($_POST['edit_page'])) {
    $user = $entityManager->find('Model\Page', $_POST['edit_page']);
    $user->setPageName($_POST['edit_name']);
    $user->setPageContent($_POST['edit_content']);
    $entityManager->flush();
    $_SESSION['message'] = 'Updated Successfuly';
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
  <title>Edit page</title>
</head>
<body style="font-family:'Trebuchet MS', 'sans-serif';">


    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" >
                <h1 style="color: white ;"><b>Mini CMS</b></h1>
                <a style="font-size: 30px; color: #6cb4df; font-weight:700; ">Admin panel</a>
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
                $page = $entityManager->find('Model\Page', $_GET['edit']);

                echo '<h2 style="text-align:center; ">Edit page: ' . $page->getPageName() . '</h2>
                            <div class="edit-page-form-placeholder d-flex justify-content-center">
                              <form class="edit-page" action="" method="POST">
                                <label for="edit-name">Page name:</label><br>
                                <input type="text" id="edit-name" name="edit_name" placeholder="edit name" required autofocus value="' . $page->getPageName() . '" ' . ($page->getPageName()==  "Home" ? "readonly" : "") . '>
                                <br><br>
                                <label for="edit-content">Page content:</label><br>
                                <textarea cols="80" rows="15" id="edit-content" name="edit_content" placeholder="Edit page content">' . $page->getPageContent() . '</textarea><br>
                                <button type="submit" class="btn btn-success" name="edit_page" value="' . $page->getId() . '">Submit edit</button>
                                <a class="btn btn-warning" href="./admin">Back</a>
                              </form>
                            </div>';
            ?>
        </div>
      </div>
    </div>
</body>
</html>