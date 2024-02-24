<?php
include_once("./classi/Database.php");
$db = new Database();
$conn = $db->getConn();

$query = "SELECT path_img, nome FROM categorie";
$stmt = $conn->prepare($query);
$stmt->execute();

$catPath = $stmt->fetchAll(PDO::FETCH_ASSOC);

$db->chiudiConnessione();

session_start();
$utenteLoggato = isset($_SESSION['utenteLoggato']) && $_SESSION['utenteLoggato'] === true;
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
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap" />
          </svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Catalogo</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Carrello</a></li>
        </ul>

        <div class="text-end">
          <?php
          // Controlla se l'utente è loggato
          if ($utenteLoggato) {
            echo '<a href="logout.php" class="btn btn-warning">Logout</a>';
          } else {
            echo '<a href="login.php" class="btn btn-outline-light me-2">Login</a>';
            echo '<a href="signup.php" class="btn btn-warning">Sign-up</a>';
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
        echo '<img src="' . $row["path_img"] . '" class="d-block w-100" alt="' . $row["nome"] . '" style="object-fit: cover;">';
        echo '<div class="carousel-caption">';
        echo '<h2>' . $row["nome"] . '</h2>';
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
        <button class="btn btn-secondary rounded-pill px-3" type="button">dettagli</button>
      </div>
    </div>
    <div class="col-md-5">
      <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
      </svg>
    </div>
  </div>
  <hr class="featurette-divider">
  <div class="row featurette">
    <div class="col-md-5">
      <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
      </svg>
    </div>
    <div class="col-md-7">
      <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span class="text-body-secondary">It’ll blow your mind.</span></h2>
      <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
      <div class="d-flex gap-2 justify-content-center py-5">
        <button class="btn btn-secondary rounded-pill px-3" type="button">dettagli</button>
      </div>
    </div>
  </div>

  <!-- bottom button -->
  <div class="d-flex gap-2 justify-content-center py-5">
    <button class="btn btn-primary rounded-pill px-3" type="button">visualizza tutto</button>
  </div>

  <!-- footer -->
  <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
          <svg class="bi" width="30" height="24">
            <use xlink:href="#bootstrap" />
          </svg>
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
      </div>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#twitter" />
            </svg></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#instagram" />
            </svg></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#facebook" />
            </svg></a></li>
      </ul>
    </footer>
  </div>
</body>

</html>