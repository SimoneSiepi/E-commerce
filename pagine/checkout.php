<?php
session_start();
include_once '../classi/Prodotto.php';
include_once '../classi/Utente.php';
$quantita_prodotto = $_POST['quantita'];
$prodotto = new Prodotto();
$dettagliProdotto = $prodotto->getDettagliProdotto($_POST['id_prodotto']);
$prezzoTotale = $dettagliProdotto['prezzo'] * $quantita_prodotto;
if (!isset($_SESSION["indirizzo"])) {
    $utente = new Utente();
    $datiUtente = $utente->getUtente($_SESSION['utente']);
    $indirizzo = [
        "indirizzo" => $datiUtente["indirizzo"],
        "citta" => $datiUtente["citta"],
        "CAP" => $datiUtente["CAP"]
    ];

    // Salvare l'array associativo nella sessione
    $_SESSION["indirizzo"] = $indirizzo;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
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
                    if ($_SESSION['utenteLoggato']) {
                        echo '<a href="./logOut.php" class="btn btn-outline-light me-2">Log-out</a>';
                    } else {
                        echo '<a href="./pagine/login.php" class="btn btn-outline-light me-2">Login</a>';
                        echo '<a href="./pagine/registrazione.php" class="btn btn-warning">Sign-up</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <main>
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?php echo $dettagliProdotto['nome']; ?>(Quantità: <?php echo $quantita_prodotto; ?>)</h6>
                                <small class="text-body-secondary"><?php echo $dettagliProdotto['descrizione']; ?></small>
                            </div>
                            <span class="text-body-secondary"><?php echo '$' . number_format($dettagliProdotto['prezzo'], 2); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (Euro)</span>
                            <strong>$<?php echo number_format($prezzoTotale, 2); ?></strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Inserisci un indirizzo</h4>
                    <form class="needs-validation" action="./outputcheckout.php" method="post">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="indirizzo" class="form-label">Indirizzo</label>
                                <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="<?php echo $_SESSION["indirizzo"]["indirizzo"]; ?>" value="<?php echo $_SESSION["indirizzo"]["indirizzo"]; ?>" readonly>
                                <div class="invalid-feedback">
                                    Per favore inserisci un indirizzo.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="citta" class="form-label">Citta</label>
                                <input type="text" class="form-control" id="citta" name="citta" required placeholder="<?php echo $_SESSION["indirizzo"]["citta"]; ?>" value="<?php echo $_SESSION["indirizzo"]["citta"]; ?>" readonly>
                                <div class="invalid-feedback">
                                    Per favore inserisci una citta.
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="zip" class="form-label">CAP</label>
                                <input type="text" class="form-control" id="CAP" name="CAP" placeholder="<?php echo $_SESSION["indirizzo"]["CAP"]; ?>" required value="<?php echo $_SESSION["indirizzo"]["CAP"]; ?>" readonly>
                                <div class="invalid-feedback">
                                    Per favore inserisci il CAP.
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <input type="hidden" id="quantita" name="quantita" value="<?php echo $quantita_prodotto; ?>">
                        <input type="hidden" id="prezzoTotale" name="prezzoTotale" value="<?php echo $prezzoTotale; ?>">
                        <input type="hidden" id="idProdotto" name="idProdotto" value="<?php echo $_POST['id_prodotto']; ?>">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>