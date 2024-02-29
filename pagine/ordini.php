<?php
session_start();
include_once "../classi/Ordine.php";
include_once "../classi/Utente.php";

$utente = new Utente();
$ordine = new Ordine();
$dettagliUtente = $utente->getUtente($_SESSION["utente"]);

$ordini = $ordine->getOrdiniperUtente($dettagliUtente["id"]);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ordini</title>
    <link rel="stylesheet" href="../public/css/style.css">
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
          if (isset($_SESSION['utenteLoggato']) && $_SESSION['utenteLoggato'] === true) {
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
    <div class="container mt-5">
        <h2>Tabella Ordini</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome Prodotto</th>
                    <th>Categoria</th>
                    <th>Prezzo Singolo</th>
                    <th>Quantità</th>
                    <th>Prezzo Totale</th>
                    <th>Data Spedizione</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output dei dati nella tabella
                if (!empty($ordini)) {
                    foreach ($ordini as $row) {
                        echo "<tr>
                                <td>{$row['nome_prodotto']}</td>
                                <td>{$row['categoria']}</td>
                                <td>{$row['prezzo_singolo']}</td>
                                <td>{$row['qta']}</td>
                                <td>{$row['prezzo_totale']}</td>
                                <td>{$row['data_spedizione']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nessun dato disponibile</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
