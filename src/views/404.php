<?php
$appPathArray = explode('\\', getcwd());
$appName = strtolower(end($appPathArray));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">    
  <title>404 error</title>
</head>

<body>
  <div class="container p-4 d-flex justify-content-center bg-light" style="height: 100vh;">
    <div style="width: 800px;	text-align: center;">
        <h1 style="font-size: 160px; color: #f8c471;">404</h1>
        <div>Looks like this page is missing. Don't worry tough, our best main is on the case.</div>
        <div>Meanwhile, why don't try again by going</div><br>
        <?php
        echo '<a class="btn btn-primary" href="/' . $appName . '">Back home</a>';
        ?>
    </div>
  </div>
</body>
