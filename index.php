<?php
session_start();
include_once("./classi/Database.php");
$db = new Database();
$conn = $db->getConn();

$query = "SELECT path_img, nome_categoria FROM categorie";
$stmt = $conn->prepare($query);
$stmt->execute();

$catPath = $stmt->fetchAll(PDO::FETCH_ASSOC);

$db->chiudiConnessione();

$utenteLoggato=isset($_SESSION['utenteLoggato']) && $_SESSION['utenteLoggato'] === true;
?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/css/style.css">
  <script src="./public/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
  <title>E-commerce</title>
</head>

<body>
  <!-- header -->
  <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap" xmlns="http://www.w3.org/2000/svg">
            <img src="./public/img/house-solid.svg" alt="">
          </svg>
        </a>



        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="./index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="./pagine/catalogo.php" class="nav-link px-2 text-white">Catalogo</a></li>
        </ul>

        <div class="text-end">
          <?php
          // Controlla se l'utente è loggato
          if ($utenteLoggato) {
            echo '<a href="./pagine/logOut.php" class="btn btn-outline-light me-2">Log-out</a>';
          } else {
            echo '<a href="./pagine/login.php" class="btn btn-outline-light me-2">Login</a>';
            echo '<a href="./pagine/registrazione.php" class="btn btn-warning">Sign-up</a>';
          }
          ?>
        </div>
      </div>
    </div>
  </header>
  <!-- Carousel -->
  <div id="myCarousel" class="carousel slide mb-6 fixed-height" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <?php
      $index = 0;
      foreach ($catPath as $row) {
        echo '<button type="button" data-bs-target="#myCarousel" data-bs-slide-to="' . $index . '" ' . ($index === 0 ? 'class="active"' : '') . ($index === 0 ? 'aria-current="true"' : '') . '" aria-label="Slide ' . ($index + 1) . '"></button>';
        $index++;
      }
      ?>
    </div>
    <div class="carousel-inner">
      <?php
      $index = 0;
      foreach ($catPath as $row) {
        echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
        echo '<img src="' . $row["path_img"] . '" class="d-block w-100" alt="' . $row["nome_categoria"] . '" style="object-fit: cover;">';
        echo '<div class="carousel-caption">';
        echo '<h2>' . $row["nome_categoria"] . '</h2>';
        echo '</div>';
        echo '</div>';
        $index++;
      }
      ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- featurette -->
  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span class="text-body-secondary">It’ll blow your mind.</span></h2>
      <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
      <div class="d-flex gap-2 justify-content-center py-5">
        <?php 
          if (!$utenteLoggato) {
            echo '<a href="./pagine/login.php"><button class="btn btn-secondary rounded-pill px-3" type="button">dettagli</button></a>';
          }else{
            echo '<button class="btn btn-secondary rounded-pill px-3" type="button">dettagli</button>';
          }
        ?>
        <!-- <button class="btn btn-secondary rounded-pill px-3" type="button">dettagli</button> -->
      </div>
    </div>
    <div class="col-md-5">
      <img src="./public/img/prodotti/divanoBello.jpeg" alt="un divano bello" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
    </div>
  </div>
  <hr class="featurette-divider">
  <div class="row featurette">
    <div class="col-md-5">
      <div class="col-md-6">
        <img src="./public/img/prodotti/lavaboBello.jpeg" alt="un lavabo bello" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
      </div>
    </div>
    <div class="col-md-7">
      <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span class="text-body-secondary">It’ll blow your mind.</span></h2>
      <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
      <div class="d-flex gap-2 justify-content-center py-5">
      <?php 
          if (!$utenteLoggato) {
            echo '<a href="./pagine/login.php"><button class="btn btn-secondary rounded-pill px-3" type="button">dettagli</button></a>';
          }else{
            echo '<button class="btn btn-secondary rounded-pill px-3" type="button">dettagli</button>';
          }
        ?>
      </div>
    </div>
  </div>

  <!-- bottom button -->
  <div class="d-flex gap-2 justify-content-center py-5">
    <?php 
      if (!$utenteLoggato) {
        echo '<a href="./pagine/login.php"><button class="btn btn-primary rounded-pill px-3" type="button">visualizza tutto</button></a>';
      }else{
        echo '<a href="./pagine/catalogo.php"><button class="btn btn-primary rounded-pill px-3" type="button">visualizza tutto il catalogo</button></a>';
      }
    ?>
  </div>
</body>

</html>