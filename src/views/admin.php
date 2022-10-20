<?php
include_once "bootstrap.php";


// Getting app name
$appPathArray = explode('\\', getcwd());
$appName = strtolower(end($appPathArray));

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
  if ($_POST['username'] == 'Patestuojam' && $_POST['password'] == '1234') {
    $_SESSION['logged_in'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = 'Patestuojam';
  } else {
    print('<div style="color:red">Wrong username or password</div>');
  }
}

// Delete page
if (isset($_GET['delete'])) {
  $user = $entityManager->find('Model\Page', $_GET['delete']);
  $entityManager->remove($user);
  $entityManager->flush();
  $_SESSION['message'] = 'Removed successfuly';
  $_SESSION['message_type'] = 'success';
  header('Location: /' . $appName . '/admin');
  exit();
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

  <title>Admin page</title>
</head>

<body style="font-family:'Calibri', 'Trebuchet MS', 'sans-serif';">


  <?php
  if (!isset($_SESSION['logged_in'])) {
   echo '<nav class="navbar navbar-expand-lg navbar-light bg-info">
          <div class="container-fluid">
              <a class="navbar-brand" >

                  <h1 style="color: white ;"><b>Mini CMS</b></h1>
                  <a style="font-size: 30px; color: #6cb4df; font-weight:700; margin-right: 50px;">Login Page</a>
              </a>
              <div class="top-nav-placeholder">
                  <a class="btn btn-primary" href="./home" target="_blank">View website</a>
              </div>
          </div>
      </nav>';
   echo  '<div class="container p-4 " >
            <div class="edit-page-form-placeholder d-flex justify-content-center align-items-center" style="height:82vh;">
                <div class="login-form-placeholder">
                  <form action="" method="post" style="width: 30vw">
                      <div class="form-group">
                          <label style="font-size: 25px" for="exampleInputEmail1">User name</label>
                          <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required autofocus placeholder="Patestuojam">
                          <small id="emailHelp" class="form-text text-muted"></small>
                      </div>
                      <div class="form-group">
                        <label style="font-size: 25px" for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"  placeholder="1234" required>
                      </div>
                      <div style="text-align: center">
                        <button type="submit" style="width:25vw; " name="login" class="btn btn-primary mt-4">Login</button>
                      </div>
                    </form>
                </div>
            </div>
          </div>';
  } else {
  ?>

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
          <div class="col-md-10" >
            <div class="table-placeholder">
                  <?php
                    $pages = $entityManager->getRepository('Model\Page')->findAll();
                    echo '<table class="table table-info table-striped table-bordered border-dark">
                      <thead>
                        <tr>
                          <th scope="col" style="width: 70%; font-size:25px">Page Title</th>
                          <th scope="col" style="width: 20%; font-size:25px; text-align:center">Action</th>
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
                              <td style="font-size: 20px">' . $page->getPageName() . '</td>
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
                   <a class="btn btn-success" style="width: 12vw" href="?add">Add Page</a>
                            <?php if (isset($_SESSION['message'])) { ?>
                          <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show mt-3" role="alert">
                            <?= $_SESSION['message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?php unset($_SESSION['message']);?>
                          </div>
                          <?php } ?>
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