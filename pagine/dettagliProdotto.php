<?php
session_start();
include_once '../classi/Prodotto.php';
if (isset($_GET['id'])) {
  // Ora puoi utilizzare $idProdotto per ottenere i dettagli del prodotto desiderato
  $prodotto = new Prodotto();
  $dettagliProdotto = $prodotto->getDettagliProdotto($_GET['id']);
  //print($dettagliProdotto['id']);
} else {
  echo 'ID del prodotto non specificato.';
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prodotto</title>
  <link rel="stylesheet" href="../public/css/style.css">
  <link rel="stylesheet" href="../public/bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <script src="../public/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</head>

<body>
<header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap" xmlns="http://www.w3.org/2000/svg">
                        <img src="./public/img/house-solid.svg" alt="">
                    </svg>
                </a>



                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="../index.php" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="./catalogo.php" class="nav-link px-2 text-white">Catalogo</a></li>
                    <li><a href="./ordini.php" class="nav-link px-2 text-white">Ordini</a></li>
                </ul>

                <div class="text-end">
                    <?php
                    // Controlla se l'utente è loggato
                    if ($_SESSION['utenteLoggato']) {
                        echo '<a href="./logOut.php" class="btn btn-outline-light me-2">Log-out</a>';
                    } else {
                        echo '<a href="./login.php" class="btn btn-outline-light me-2">Login</a>';
                        echo '<a href="./registrazione.php" class="btn btn-warning">Sign-up</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

  <main>
    <div class="container py-4">

      <div class="row align-items-md-stretch">
        <div class="col-md-6">
          <!-- Carousel with product image -->
          <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php echo '<img src="' . $dettagliProdotto['percorso'] . '" class="d-block w-100" alt="Product Image">'; ?>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <!-- Product details on the right side -->
          <div class="h-100 p-5 bg-body-tertiary rounded-3">
            <h2 class="display-5 fw-bold"><?php echo $dettagliProdotto['nome']; ?></h2>
            <p class="col-md-8 fs-4"><?php echo $dettagliProdotto['descrizione']; ?></p>
            <p class="fs-5"><?php echo '$' . number_format($dettagliProdotto['prezzo'], 2); ?></p>

            <!-- Aggiunto il pulsante di acquisto e il contatore della quantità -->
            <form action="./checkout.php" method="post">
              <div class="d-flex align-items-center">
                <button class="btn btn-primary btn-md me-2" type="submit">acquista</button>
                <input type="hidden" name="id_prodotto" id="id_prodotto" value="<?php echo $dettagliProdotto['id']; ?>">
                <div class="input-group">
                  <span class="input-group-text" id="quantita">Quantità</span>
                  <input type="number" name="quantita" id="quantita" class="form-control" aria-describedby="quantityLabel" value="1" min="1">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </main>
</body>

</html>