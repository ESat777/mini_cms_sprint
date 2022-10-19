<?php
include_once "bootstrap.php";


// Getting app name
$appPathArray = explode('\\', getcwd());
$appName = strtolower(end($appPathArray));

$errorMsg = '';

// Logout
session_start();
if (isset($_GET['action']) and $_GET['action'] == 'logout') {
  session_start();
  unset($_SESSION['username']);
  unset($_SESSION['password']);
  unset($_SESSION['logged_in']);
  header('Location: /' . $appName . '/admin');
  exit;
}

// Login
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  if ($_POST['username'] == 'Gurgutis' && $_POST['password'] == '1234') {
    $_SESSION['logged_in'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = 'Gurgutis';
  } else {
    print('<div style="color:red">Wrong username or password</div>');
  }
}

// Delete page
if (isset($_GET['delete'])) {
  $user = $entityManager->find('Model\Page', $_GET['delete']);
  $entityManager->remove($user);
  $entityManager->flush();
  header('Location: /' . $appName . '/admin');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">    
  <!-- <link rel="stylesheet" href="css/main.css"> -->
  <title>Admin page</title>
</head>

<body style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', 'sans-serif';">
<?php
  if (!isset($_SESSION['logged_in'])) {
    echo '<div class="login-form-placeholder">
          <form action="" method="post">
              <input type="text" name="username" placeholder="username = Gurgutis" required autofocus></br>
              <input type="password" name="password" placeholder="password = 1234" required><br>
              <button class="btn login-btn" type="submit" name="login">Login</button>
          </form>
        </div>';
  } else {
  ?>
  
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" >
                <!-- <img src="dbsm3.png" style="height: 60px" alt="icon"> -->
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
          <div class="col-md-10" >
            <div class="table-placeholder">
                  <?php
                    $pages = $entityManager->getRepository('Model\Page')->findAll();
                    echo '<table class="table table-info table-striped table-bordered border-dark">
                      <thead>
                        <tr>
                          <th scope="col" style="width: 70%;">Title</th>
                          <th scope="col" style="width: 20%; text-align:center">Action</th>
                        </tr>
                      </thead>
                      <tbody>';
                          foreach ($pages as $page) {
                            $buttons = '';
                            if ($page->getId() === 1) {
                              $buttons = '<a class="btn btn-warning" href="?edit=' . $page->getId() . '">Edit</a>';
                            } else {
                              $buttons = '<a class="btn btn-warning" href="?edit=' . $page->getId() . '">Edit</a>
                              <a class="btn btn-danger" href="?delete=' . $page->getId() . '">Delete</a>';
                            }
                            echo '<tr>
                              <td>' . $page->getPageName() . '</td>
                              <td style="text-align:center">
                                  ' . $buttons . '
                              </td>
                            </tr>';
                            }
                          echo '</tbody></table>';
                  ?>
            </div>
            </div> 
            <div class="col-md-2 "> 
                   <a class="btn btn-success" href="?add">Add Page</a>
                            <?php if (isset($_SESSION['message'])) { ?>
                          <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show mt-3" role="alert">
                            <?= $_SESSION['message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?php unset($_SESSION['message']);?>
                          </div>
                          <?php 
                         } 
                ?>
            </div> 
         
      </div>
    </div>
  <?php } ?>
            
       
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>