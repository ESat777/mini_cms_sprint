<?php
include_once "bootstrap.php";
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
          <style></style>   

  <title>CMS</title>
</head>

<body style="font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', 'sans-serif';">
  <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
     <a class="navbar-brand" >
        <span style="font-size: 30px; color: white; font-weight:700; margin-right: 50px;">Mini CMS</span>
     </a>
        <div class="d-flex justify-content-end">
            
                  <?php
                  $page = $entityManager->find('Model\Page',  1);
                  echo '<h2 style="color: #6cb4df; font-weight: bold; margin-right: 20vw">' . $page->getPageName() . '</h2>';
                  $pages = $entityManager->getRepository('Model\Page')->findAll();
                  
                  foreach ($pages as $page) {
                    echo '<a class="btn btn-success m-1" style="width: 100px; align" href="?id='
                     . $page->getId() . '">' . $page->getPageName() . '</a>';
                  }
                  ?>
            
        </div>
    </div>
  </nav>
</header>

  <main>
    <div class="container p-3 d-flex justify-content-center"  style="min-height:80.7vh; justify-content: end;">
        <?php
        if (!isset($_GET['id'])){
          $page = $entityManager->find('Model\Page',  1);
          
          echo '<div>' . $page->getPageContent() . '</div>';
        } else {
          $page = $entityManager->find('Model\Page',  $_GET['id']);
          echo '<h3>' . $page->getPageName() . '</h3>';
          echo '<div>' . $page->getPageContent() . '</div>';
        }
        ?>
    </div>
  </main>
  <footer class="bg-light text-center text-lg-start container-fluid" style="bottom: 0px; padding:0; position: block; width: 100%; height: 10px;">
    <div class="text-center p-3 bg-info" style="color: white; ">
            © 2022 Copyright:
            <a style="text-decoration: none; color: white;" >EDISON</a>
    </div>
  </footer>
</body>

</html>